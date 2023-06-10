<?php
const REDIRECT_PREFIX = 'R:';

class Dispatcher
{
	private $model;	
	private $view;

	private function render()
	{
		extract($this->model);
		include_once '../views/' . $this->view;
	}

	function respond()
	{
		if(strpos($this->view, REDIRECT_PREFIX) === 0)
		{
			$resource_url = substr($this->view, strlen(REDIRECT_PREFIX));
			header('Location: ' . $resource_url);
			exit;
		}
		$this->render();
	}

	function __construct($controller)
	{
		$this->model = [];
		$controller_class = new Controllers;
		$this->view = $controller_class->$controller($this->model);
	}
}
?>