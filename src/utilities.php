<?php
function prepare_database()
{
	$mongo = new MongoDB\Client(
	"mongodb://localhost:27017/wai",
	    [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]
	);
	$database = $mongo->wai;
	return $database;
}

function access()
{
	
	$is_logged_in = false;
	if(isset($_SESSION['user']))
	{
		$is_logged_in = true;
	}
	return $is_logged_in;
}

?>