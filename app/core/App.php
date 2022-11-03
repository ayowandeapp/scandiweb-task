<?php

namespace app\core;
use app\core\App;


class App{
	protected $routes = [];
	protected $params = [];
	protected $link = [];
	// protected $controller = "UserController";
	// protected $action = "index";

	// protected $params = [];
	//public Router $router;
	public function get($url,$callback){
		$this->routes['get'][$url]= $callback;

		//var_dump($this->routes['get'][$url]); die;

	}
	public function post($url,$callback){
		$this->routes['post'][$url]= $callback;

	}

	/**
	 * 
	 * extract controller,methods, parameters
	 * @return void
	 * */
	public function prepareURL(){
		//var_dump($_SERVER); die;

		$url = $_SERVER['REQUEST_URI'] ?? '/';
		//var_dump($url); die;
		if (!empty($url)) {
			//$url = trim($url,"/");
			$position = strpos($url, '?');
			if($position){
				$url= substr($url, 0, $position);
				//var_dump($url); die;
			}else{
				$url;
				//var_dump($url); die;
			}
		$link = explode("/", $url);
		//var_dump(count($link)); die;
		if(!empty($link) && count($link) >3){
			$url = '/'.$link[1].'/'. $link[2];
			unset($link[1],$link[2]);
		}

		$this->params = !empty($link) ? array_values($link):[];
		//var_dump($this->params); die;
		$params = $this->params;
		//var_dump($params); die;
		$method = strtolower($_SERVER['REQUEST_METHOD']);
		//var_dump($method); die;
		$callback = $this->routes[$method][$url];
		//var_dump($callback); die;
		if(!$callback){

			header('Location: /');

		}elseif(is_string($callback)){
			return $this->renderView($callback,$params);
		}else{
			return call_user_func($callback,$params);
		}
		}

	}
	public static function renderView($view,$params=[]){
		//var_dump(dirname(__DIR__)); die;
		// $layout = App::viewLayout();
		// $viewContent = App::renderViewOnly($view,$params);
		foreach ($params as $key => $value) {
            $$key = $value;
        }
        //var_dump($params); die;
		ob_start();
		include dirname(__DIR__). "/views/$view.php";
		$content = ob_get_clean();
		include_once dirname(__DIR__). "/views/layouts/main.php";
	}
}