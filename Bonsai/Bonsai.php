<?php

require '\Bonsai\Router.php';

class Bonsai 
{

    protected $router;

    protected $routes = array();

	public function __construct()
	{
        $this->router = new Router();
	}

    public function map($rule, $callback, $conditions = array())
    {
        $this->routes[$rule] = $this->router->map($rule, $callback, $conditions);

        return $this;
    }

    public function render($template, $templateVars = array())
    {
        $path = '/views' . '/' . $template . '.php';
       
        // Load variables
        foreach ($templateVars as $key => $value)
        {
            $$key = $value;
        }

        include ($path);    
    }

    public function execute()
    {
        foreach ($this->routes as $route) {
            if ($route->isMatched) {
                call_user_func($route->callback, reset($route->params));
                $this->router->setRoute($route);
                break;
            }
        }
    }
}