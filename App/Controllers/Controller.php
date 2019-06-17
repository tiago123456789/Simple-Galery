<?php

namespace App\Controllers;

abstract class Controller {

    public function render($action, $views)
	{
		$current = get_class($this);
		$singleClassName = strtolower((str_replace("Controller","",str_replace("App\\Controllers\\","",$current))));
		// Pega a somente a pasta onde a view estará
		// As pastas dentro das view são as que fazem referência a esse controller (indexController, por exemplo)
		include_once "../App/Views/".$singleClassName."/".$action.".phtml";
	}
}