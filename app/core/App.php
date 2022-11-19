<?php

namespace app\core;

use app\core\App;

class App
{
	protected $routes = [];
	protected $params = [];

	public function get($url, $callback)
	{
		$this->routes['get'][$url]= $callback;
	}

	public function post($url, $callback)
	{
		$this->routes['post'][$url]= $callback;
	}
	/**
	 * 
	 * extract controller,methods, parameters
	 * @return void
	 * */

	public function prepareUrl()
	{
		$url = $_SERVER['REQUEST_URI'] ?? '/';

		if (!empty($url)) {
			$position = strpos($url, '?');
			if ($position) {
				$url= substr($url, 0, $position);
			} else {
				$url;
			}
			$link = explode("/", $url);

			if (!empty($link) && count($link) >3) {
				$url = '/'.$link[1].'/'. $link[2];
				unset($link[1],$link[2]);
			}
			$this->params = !empty($link) ? array_values($link):[];
			$params = $this->params;
			$method = strtolower($_SERVER['REQUEST_METHOD']);
			$callback = $this->routes[$method][$url];

			if (!$callback) {
				header('Location: /');
			} elseif (is_string($callback)){
				return $this->renderView($callback,$params);
			} else {
				return call_user_func($callback,$params);
			}
		}
	}

	public static function renderView($view, $params=[])
	{
		foreach ($params as $key => $value) {
            $$key = $value;
        }
		ob_start();
		include dirname(__DIR__). "/views/$view.php";
		$content = ob_get_clean();
		include_once dirname(__DIR__). "/views/layouts/main.php";
	}
}
