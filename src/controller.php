<?php 

require_once '../../vendor/autoload.php';
require_once 'buisness.php';
require_once 'utilities.php';

const PAGE_SIZE = 10;

class Controllers
{
	function index(&$model)
	{
		return 'index.php';
	}

	function classes(&$model)
	{
		return 'classes.php';
	}

	function contact(&$model)
	{
		return 'contact.php';
	}

	function favourites(&$model)
	{
		return 'favourites.php';
	}

	function view_image(&$model)
	{
		$source = $_GET['source'];
		if($_GET['static']==='no')
		{
			$searcher = new ImageSearchEngine;
			$image = $searcher->get_image($source);
			$source = $image['source'];
			$title = $image['title'];
		}
		else
		{
			$title = $_GET['title'];
		}
		$model = [
			'source' => $source,
			'title' => $title ,
		];
		return 'view_image.php';
	}

	function gallery(&$model)
	{
		$searcher = new ImageSearchEngine;
		$images = $searcher->get_downscaled_images(PAGE_SIZE);
		$model = [
			'logged_in' => access(),
			'images' => $images,
			'method' => 'ok',
		];
		if(!empty($_GET['prompt']))
		{
			$model['prompt'] = $_GET['prompt'];
		}
		return 'gallery.php';
	}

	function chosen(&$model)
	{
		$searcher = new ImageSearchEngine;
		$model = [
			'images' => $searcher->get_chosen_images(),
			'logged_in' => access(),
			'method' => 'ok',
		];
		return 'chosen.php';
	}

	function search_engine(&$model)
	{
		$model = [
			'logged_in' => access(),
			'method' => 'ok',
		];
		return 'search_engine.php';
	}

	function log_in_form(&$model)
	{
		$model = [
			'password' => 'ok',
			'login' => 'ok',
			'method' => 'ok',
		];
		return 'log_in_form.php';
	}

	function sign_up_form(&$model)
	{
		$model = [
			'password' => 'ok',
			'login' => 'ok',
			'email' =>'ok',
			'method' => 'ok',
		];
		return 'sign_up_form.php';
	}	

	function image_form(&$model)
	{
		$model = [
			'logged_in' => access(),
			'database_status' => 'ok',
		];
		if(access())
		{
			$model['login'] = $_SESSION['user_login'];
		}
		else
		{
			$model['login'] = 'nologin';
		}
		$model['input_data_status'] = [
			'method' => 'ok',
			'title' => 'ok',
			'author' => 'ok',
			'watermark' => 'ok',
			'file' => 'ok',
			'file_size' => 'ok',
		];
		return 'image_form.php';
	}

	function search(&$model)
	{
		$searcher = new ImageSearchEngine;
		if(!empty($_GET['phrase']))
		{
			$model['images'] = $searcher->get_images_by_regex($_GET['phrase']);
		}
		return 'search.php';
	}

	function next_page(&$model)
	{
		$status = new UserStatusEngine;
		$status->change_page(1);
		return REDIRECT_PREFIX . 'gallery.php';
	}

	function previous_page(&$model)
	{
		$status = new UserStatusEngine;
		$status->change_page(-1);
		return REDIRECT_PREFIX . 'gallery.php';
	}

	function submit_image(&$model)
	{
		$model = [
			'database_status' => 'ok',
			'logged_in' => access(), 
		];
		if(access())
		{
			$model['login'] = $_SESSION['user_login'];
		}
		else
		{
			$model['login'] = 'nologin';
		}
		$model['input_data_status'] = [
			'method' => 'ok',
			'title' => 'ok',
			'author' => 'ok',
			'watermark' => 'ok', 
			'file' => 'ok',
			'file_size' => 'ok',
		];
	
		$all_ok = true;
		$file_type = '.';
	
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			if(empty($_POST['tytul']))
			{
				$model['input_data_status']['title'] = 'empty';
				$all_ok = false;
			}
			if(empty($_POST['autor']))
			{
				$model['input_data_status']['author'] = 'empty';
				$all_ok = false;
			}
			if(empty($_POST['znak']))
			{
				$model['input_data_status']['watermark'] = 'empty';
				$all_ok = false;
			}
			if($_FILES['obraz']['size']>1000000)
			{
				$model['input_data_status']['file_size'] = 'size';
				$all_ok = false;
			}
			if(!(file_exists($_FILES['obraz']['tmp_name'])))
			{
				$model['input_data_status']['file'] = 'empty';
				$all_ok = false;
			}
			else
			{
				$checker_instance = finfo_open(FILEINFO_MIME_TYPE);
				$file_type = finfo_file($checker_instance, $_FILES['obraz']['tmp_name']);
				if(!($file_type === 'image/jpeg') && !($file_type === 'image/png'))
				{
					$model['input_data_status']['file'] = 'type';
					$all_ok = false;
				}
			}
			if($all_ok === true)
			{ 
				$status = 'public';
				if(!empty($_POST['privacy']))
				{
					$status = $_POST['privacy'];
				}
				$file_extention = substr($file_type, strlen('image/'));
				$saver = new ImageSavingEngine($_POST['znak'], $file_extention, $status);
				$model['database_status'] = $saver->save_image($_POST['tytul'], $_POST['autor'], $_FILES['obraz']['tmp_name']);
				if($model['database_status'] == 'ok')
				{
					return REDIRECT_PREFIX . 'gallery.php?prompt=' . urlencode('Zdjęcie zostało umieszone na stronie');
				}
			}
		}
		else
		{
			$model['input_data_status'['method']] = 'error';
		}
		return 'image_form.php';
	}

	function log_in(&$model)
	{
		$model = [
			'password' => 'ok',
			'login' => 'ok',
			'method' => 'ok'
		];
	
		$all_ok = true;
	
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			if(empty($_POST['haslo']))
			{
				$all_ok = false;
				$model['password'] = 'empty';
			}
			if(empty($_POST['login']))
			{
				$all_ok = false;
				$model['login'] = 'empty';
			}
		}
		else
		{
			$all_ok = false;
			$model['method'] = 'error';
		}
		if($all_ok === true)
		{
			$manager = new UserManagementEngine($_POST['login'], $_POST['haslo']);
			$response = $manager->authorize();
			if($response === 'ok')
			{
				return REDIRECT_PREFIX . 'gallery.php?prompt=' . urlencode('Witaj ' . $_POST['login'] . '. Logowanie powiodło się.');
			}
			else
			{
				$model[$response] = 'incorrect';
			}
		}
		return 'log_in_form.php';
	}	

	function sign_up(&$model)
	{
		$manager = new UserManagementEngine($_POST['login'], $_POST['haslo']);
	
		$model = [
			'password' => 'ok',
			'login' => 'ok',
			'email' =>'ok',
			'method' => 'ok'
		];
	
		$all_ok = true;
	
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			if(empty($_POST['haslo']) || empty($_POST['haslo2']))
			{
				$all_ok = false;
				$model['password'] = 'empty';
			}
			else if(!($_POST['haslo'] === $_POST['haslo2']))
			{
				$all_ok = false;
				$model['password'] = 'different';
			}
			if(empty($_POST['login']))
			{
				$all_ok = false;
				$model['login'] = 'empty';
			}
			else if(!(empty($manager->check_for_user($_POST['login']))))
			{
				$all_ok = false;
				$model['login'] = 'taken';
			}
			if(empty($_POST['email']))
			{
				$all_ok = false;
				$model['email'] = 'empty';
			}
			else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			{
				$all_ok = false;
				$model['email'] = 'invalid';
			}
		}
		else
		{
			$all_ok = false;
			$model['method'] = 'error';
		}
		if($all_ok === true)
		{
			$manager->register($_POST['email']);
			return REDIRECT_PREFIX . 'gallery.php?prompt=' . urlencode('Użykownik został zarejestrowany');
		}
		else
		{
			return 'sign_up_form.php';
		}
	}

	function log_out(&$model)
	{
		$status = new UserStatusEngine;
		$status->set_login_in_session('null');
		$model = [
			'logged_in' => access(),
		];
		return REDIRECT_PREFIX . 'gallery.php?prompt=' . urlencode('Wylogowano poprawnie');
	}

	function save_chosen(&$model)
	{
		$model = [
			'method' => 'ok',
		];
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			if(isset($_POST['chosen']))
			{
				$status = new UserStatusEngine;
				$status->update_checked($_POST['chosen']);
			}
			return REDIRECT_PREFIX . 'chosen.php';
		}
		else
		{
			$model['method'] = 'error';
			return 'gallery.php';
		}
	}

	function delete_chosen(&$model)
	{
		$model = [
			'method' => 'ok',
		];
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			if(isset($_POST['chosen']))
			{
				$status = new UserStatusEngine;
				$status->delete_checked($_POST['chosen']);
			}
			return REDIRECT_PREFIX . 'chosen.php';
		}
		else
		{
			$model['method'] = 'error';
			return 'chosen.php';
		}
	}
		
	function admin(&$model)
	{
		if($_GET['haslo'] === 'ADMIN')
		{
			$admin = new AdminEngine;
			if($_GET['act'] === 'CLEAR_IMAGE_DATABASE')
			{
				$admin->delete_image_records();
				return REDIRECT_PREFIX . 'gallery.php?prompt=' . urlencode('USUNIĘTO METADANE ZDJĘĆ');
			}
			if($_GET['act'] === 'CLEAR_USER_DATABASE')
			{
				$admin->delete_user_records();
				return REDIRECT_PREFIX . 'gallery.php?prompt=' . urlencode('USUNIĘTO DANE UŻYTKOWNIKÓW');
			}
		}
		return 'index.php';
	}
}
?>