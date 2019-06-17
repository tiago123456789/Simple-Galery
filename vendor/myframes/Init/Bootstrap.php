<?php
namespace myframes\Init;

abstract class Bootstrap
{
	private $routes;
	
	public function __construct()
	{
		$this->initRoutes();
		$this->run($this->getUrl());
	}
	
	abstract protected function initRoutes();

	protected function run($url)
	{

		$routes = $this->routes[$this->getMethodHttp()];
		// Essa função simplesmente executa a ação da url passada caso exista.
		array_walk($routes, function($route) use ($url) {
				$route["route"] = str_replace("/", "\/", $route["route"]);
				if(preg_match("/{$route['route']}/", $url)) {
					$paramDynamic = $this->extractParamDynamic($route["route"], $url);

					// Se existir essa rota - digitada pelo usuário
					$class = "App\\Controllers\\".ucfirst($route['controller']);
					// Pega o valor do array passado na posição controller e colocar a primeira
					// letra maiuscula (para que se consiga instanciar a classe do controller)
					$controller = new $class;
					// Instancia um controlador para aquela rota - existindo e claro
					$action = $route['action'];
					// Identifica a action desta rota
					$controller->$action($paramDynamic);
					// chama a action (acao) que esta dentro do controlador
				}
			});
	}

	private function extractParamDynamic($route, $routeAccess) {
		$routeSplited = explode("\/", $route);
		$routeAccessSplited = explode("/", $routeAccess);
		$positionParamDynamic = array_search('([0-9a-zA-Z])+', $routeSplited);
		return $routeAccessSplited[$positionParamDynamic];
	}

	protected function setRoutes(array $routes)
	{
		$this->routes = $routes;
	}

	protected function getMethodHttp() {
		return $_SERVER['REQUEST_METHOD'];
	}

	protected function getUrl()
	{
		return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
	}
}
