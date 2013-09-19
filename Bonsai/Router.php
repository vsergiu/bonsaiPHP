<?php 

require 'Bonsai\Route.php';

class Router 
{
	protected $requestUri;

	protected $routes = array();

	protected $id;

	protected $params;

	protected $routeFound = false;

	public function __construct()
	{
		$uri = $_SERVER['REQUEST_URI'];
		$pos = strpos($uri, '?');
		
		if ($pos) $uri = substr($uri, 0, $pos);
		
		$this->requestUri = $uri;
	}

	public function map($rule, $callback, $conditions = array())
	{
		return new Route($rule, $this->requestUri, $callback, $conditions);
	}

	public function setRoute($route)
	{
		$this->routeFound = true;
		$params = $route->params;
	}
}