<?php
use MongoDB\BSON\ObjectId;

const WORKING_DIRECTORY = '/var/www/prod/src/images/';
const WATERMARK_FOLDER = '/var/www/prod/src/images/watermarked/';
const DOWNSCALE_FOLDER = '/var/www/prod/src/images/downscaled/';

class UserManagementEngine
{
	private $db;
	private $login;
	private $password;
	private $visit_status;

	function check_for_user()
	{
		$query = [
			'login' => $this->login,
		];
		return $this->db->users->findOne($query);
	}

	function register($email)
	{
		$new_user = [
			'login' => $this->login,
			'email' => $email,
			'password' => password_hash($this->password, PASSWORD_DEFAULT),
		];
		$database_response = $this->db->users->insertOne($new_user);
		$id = $database_response->getInsertedId();
		$new_user['_id'] = $id;
		$this->visit_status->set_login_in_session($new_user);
		$this->visit_status->set_session_value('page', 1);
	}

	function authorize()
	{
		$user = $this->check_for_user();
		if(empty($user))
		{
			return 'login';
		}
		if(password_verify($this->password, $user['password']))
		{
			$this->visit_status->set_login_in_session($user);
			return 'ok';
		}
		else
		{
			return 'password';
		}
	}
	
	function __construct($login, $password)
	{
		$this->password = $password;
		$this->login = $login;
		$this->db = prepare_database();
		$this->visit_status = new UserStatusEngine;
	}
}

class ImageSavingEngine
{
	private $db;
	private $watermark;
	private $extention;

	private function prepare_image($directory)
	{
		if($this->extention === 'png')
		{
			$image = imagecreatefrompng($directory);
		}
		else
		{
			$image = imagecreatefromjpeg($directory);
		}
		return $image;
	}

	private function dump_image($image, $directory)
	{
		if($this->extention === 'png')
		{
			imagepng($image, $directory);
		}
		else
		{
			imagejpeg($image, $directory);
		}
	}

	private function add_watermark($name)
	{
		$image = $this->prepare_image(WORKING_DIRECTORY . $name);
		$color = imagecolorallocate($image, 150, 150, 150);
		if($this->extention === 'png')
		{
			$background = imagecreatefrompng(WORKING_DIRECTORY . 'transparent_background.png');
			$image_info = getimagesize(WORKING_DIRECTORY . $name);
			$width = $image_info[0];
			$height = $image_info[1];
			$new_image = imagecreatetruecolor($width, $height);
			imagecopyresized($new_image, $background, 0, 0, 0, 0, $width, $height, 200, 125);
			imagecopyresized($new_image, $image, 0, 0, 0, 0, $width, $height, $width, $height);
			$image = $new_image;
			imagedestroy($background);
		}
		$font_size = (imagesx($image)/strlen($this->watermark))/2;
		imagettftext($image, $font_size, 0, 0, imagesy($image)-($font_size/2), $color, WATERMARK_FOLDER . 'arial.ttf', $this->watermark);
		$this->dump_image($image, WATERMARK_FOLDER . $name);
		imagedestroy($image);
	}

	private function downscale($name)
	{
		$image = $this->prepare_image(WORKING_DIRECTORY . $name);
		$image_info = getimagesize(WORKING_DIRECTORY . $name);
		$width = $image_info[0];
		$height = $image_info[1];
		if($this->extention === 'png')
		{
			$new_image = imagecreatefrompng(WORKING_DIRECTORY . 'transparent_background.png');
		}
		else
		{
			$new_image = imagecreatetruecolor(200, 125);
		}
		imagecopyresized($new_image, $image, 0, 0, 0, 0, 200, 125, $width, $height);
		$this->dump_image($new_image, DOWNSCALE_FOLDER . $name);
		imagedestroy($image);
		imagedestroy($new_image);
	}
	
	function save_image($title, $author, $location)
	{
		if(empty($this->db))
		{
			return 'database_error';
		}
		if($this->status === 'private')
		{
			$this->status = $_SESSION['user'];
		}
		$file_data = [
			'title' => $title,
			'author' => $author,
			'extention' => $this->extention,
			'owner' => $this->status,
		];
		$database_response = $this->db->images->insertOne($file_data);
		$new_image_id = $database_response->getInsertedId();
		$image_name = basename($new_image_id . '.' . $this->extention);
		if(move_uploaded_file($location, WORKING_DIRECTORY . $image_name))
		{
			$this->add_watermark($image_name);
			$this->downscale($image_name);
			return 'ok';
		
		}
		else
		{
			$query = [
				'_id' => new ObjectId($new_image_id),
			];
			$this->db->images->deleteOne($query);
			return 'internal_server_error';
		}
	}
	
	function __construct($watermark, $extention, $status)
	{
		$this->watermark = $watermark;
		$this->extention = $extention;
		$this->status = $status;
		$this->db = prepare_database();
	}
}

class ImageSearchEngine
{
	private $db;
	private $status;

	private function encode($source, $extention)
	{
		$raw_contents = file_get_contents($source);
		$base64 = base64_encode($raw_contents);
		$full_format = 'data:' . 'image/' . $extention . ';charset=utf-8;base64, ' . $base64;
		return $full_format;
	}
	
	private function image_access_query()
	{
		$accepted_values = ['public'];
		if(access())
		{
			array_push($accepted_values, $_SESSION['user']);
		}
		$query = [
			'owner' => [
				'$in' => $accepted_values,
			],
		];
		return $query;
	}

	private function prepare_image_data($record, $directory)
	{
		$checked = false;
		$chosen = $this->status->get_session_value([], 'chosen');
		if(!(array_search($record['_id'], $chosen) === false))
		{
			$checked = true;
		}
		$extention = $record['extention'];
		$name = $record['_id'] . '.' . $extention;
		$image_data = [
			'id' => $record['_id'],
			'title' => $record['title'],
			'author' => $record['author'],
			'owner' => $record['owner'],
			'checked' => $checked,
			'source' =>$this->encode($directory . $name, $extention),
		];
		return $image_data;
	}

	function get_image($id)
	{
		$query = [
			'_id' => new ObjectId($id),
		];
		$record = $this->db->images->findOne($query);
		return $this->prepare_image_data($record, WATERMARK_FOLDER);
	}

	function get_images_by_query($query, $opts, $directory)
	{
		$images = array();
		$image_records = $this->db->images->find($query, $opts);
		foreach($image_records as $record)
		{
			array_push($images, $this->prepare_image_data($record, $directory));
		}
		return $images;
	}

	function get_downscaled_images($page_size)
	{
		$page = $this->status->get_session_value(1, 'page')[0];
		if($page < 1)
		{
			$page = 1;
		}
		$opts = [
			'skip' => $page_size * ($page - 1),
			'limit' => $page_size,
		];
		$query = $this->image_access_query();
		return $this->get_images_by_query($query, $opts, DOWNSCALE_FOLDER); 
	}

	function get_chosen_images()
	{
		
		$chosen = $this->status->get_session_value([], 'chosen');
		$images = array();
		foreach($chosen as $id)
		{
			$query = [
				'_id' => new ObjectId($id),
			];
			$record = $this->db->images->findOne($query);
			array_push($images, $this->prepare_image_data($record, WATERMARK_FOLDER));
		}
		return $images;
	}

	function get_images_by_regex($regex)
	{
		$query = $this->image_access_query();
		if(strlen($regex))
		{
			$query['title'] = ['$regex' => $regex, '$options' => 'i'];
		}
		return $this->get_images_by_query($query, [], WATERMARK_FOLDER);
	}

	function __construct()
	{
		$this->db = prepare_database();
		$this->status = new UserStatusEngine;
	}
}

class UserStatusEngine
{
	private $db;

	private function get_user_value($index)
	{
		$query = [
			'_id' => new ObjectId($_SESSION['user']),
		];
		$user = $this->db->users->findOne($query);
		if(isset($user[$index]))
		{
			return (array) $user[$index];
		}
		else
		{
			return false;
		}
	}

	private function set_user_value($index, $value)
	{
		$query = [
			'_id' => new ObjectId($_SESSION['user']),
		];
		$user = $this->db->users->findOne($query);
		$user[$index] = $value;
		$this->db->users->replaceOne($query, $user);
	}
	
	function set_session_value($value, $index)
	{
		if(access())
		{
			$this->set_user_value($index, $value);
		}
		else
		{
			$_SESSION[$index] = $value;
		}
	}

	function get_session_value($initial_value, $index)
	{
		if(access())
		{
			$value = self::get_user_value($index);
			if(!($value === false))
			{
				return $value;
			}
			else
			{
				$this->set_user_value($index, $initial_value);
				return $initial_value;
			}
		}
		else
		{
			if(isset($_SESSION[$index]))
			{
				return (array) $_SESSION[$index];
			}
			else
			{
				$_SESSION[$index] = $initial_value;
				return (array) $_SESSION[$index];
			}
		}
	}
	
	function set_login_in_session($user)
	{
		if($user === 'null')
		{
			unset($_SESSION['user']);
			unset($_SESSION['login']);
			session_destroy();
		}
		else
		{
			$_SESSION['user'] = $user['_id'];
			$_SESSION['user_login'] = $user['login'];
			
			unset($_SESSION['page']);
			if(!($this->get_user_value('chosen') === false) && isset($_SESSION['chosen']))
			{
				$this->set_user_value('chosen', array_unique(array_merge($_SESSION['chosen'], $this->get_user_value('chosen'))));
			}
			else if(isset($_SESSION['chosen']))
			{
				$this->set_user_value('chosen', $_SESSION['chosen']);
			}
		}
	}

	function change_page($value)
	{
		$current_page = $this->get_session_value(1, 'page')[0];
		if(($current_page + $value) > 0 )
		{	
			$this->set_session_value([$current_page + $value], 'page');
		}
	}

	function update_checked($new_checked)
	{
		$current_checked = $this->get_session_value([], 'chosen');
		$checked = array_unique(array_merge($new_checked, $current_checked));
		$this->set_session_value($checked, 'chosen');
	}

	function delete_checked($to_be_deleted)
	{
		$current_checked = $this->get_session_value([], 'chosen');
		$checked =  array_diff($current_checked, $to_be_deleted);
		$this->set_session_value($checked, 'chosen');
	}

	function __construct()
	{
		$this->db = prepare_database();
	}
}

class AdminEngine
{
	private $db;
	
	function delete_image_records()
	{
		$this->db->images->drop();
	}

	function delete_user_records()
	{
		$this->db->users->drop();
	}
	
	function __construct()
	{
		$this->db = prepare_database();
	}
}
?>