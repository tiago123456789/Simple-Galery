<?php
namespace App;

use myframes\Init\Bootstrap;

class Route extends Bootstrap
{
	
	protected function initRoutes()
	{
		$routes["GET"]['home'] = array('route'=>'/home','controller'=>"postController",'action'=>'index');
		$routes["GET"]['form_upload'] = array('route'=>'/upload','controller'=>"postController",'action'=>'new');
		$routes["POST"]['upload'] = array('route'=>'/posts','controller'=>"postController",'action'=>'create');
		$routes["GET"]['likes'] = array('route'=>'/posts/([0-9a-zA-Z])+/like', 'controller'=>"postController",'action'=>'like');
		$routes["GET"]['disLikes'] = array('route'=>'/posts/([0-9a-zA-Z])+/dislike', 'controller'=>"postController",'action'=>'disLike');
		$routes["GET"]['download'] = array('route'=>'/posts/([0-9a-zA-Z])+/download', 'controller'=>"postController",'action'=>'download');
		
		$this->setRoutes($routes);
	}

}
