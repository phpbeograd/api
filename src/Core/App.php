<?php
namespace App\Core;

class App
{
	public $controller = 'HomeController';
	public $method = 'index';
	public $params = [];

	public function __construct()
	{
		$requestString = ltrim($_SERVER['REQUEST_URI'], '/');
		$requestArray = explode('/', $requestString);

		// controller
		if($requestArray[0])
		{
			$this->controller = ucfirst($requestArray[0]).'Controller';
		}

		// method
		if(array_key_exists(1, $requestArray))
		{
			$this->method = $requestArray[1];
		}

		// params
		if(array_key_exists(2, $requestArray))
		{
			for($i=2; $i<count($requestArray); $i++)
			{
				array_push($this->params, $requestArray[$i]);
			}
		}

		$class = "\App\Controller\\".$this->controller;

		if(class_exists($class))
		{
			$instance = new $class;

			if(method_exists($instance, $this->method))
			{
				call_user_func_array(array($instance, $this->method), $this->params);
			}
			else
			{
				error();
			}
		}
		else
		{
			error();
		}
	}
}