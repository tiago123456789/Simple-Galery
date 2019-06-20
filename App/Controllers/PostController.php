<?php

namespace App\Controllers;

use App\Bo\PostBo;
use App\Helpers\Http\Response;
use App\Helpers\Http\Request;
use App\Service\File;

class PostController extends Controller
{

	private $bo;

	public function __construct()
	{
		$this->bo = new PostBo();
	}

	public function new() {
		$this->render("novo", []);
	}

	public function create() {
		$file = $_FILES["file"];
		File::upload($file);
		$datas = Request::all();
		$this->bo->create([ "describe" => $datas["describe"], "path_image" => $file["name"] ]);
		Response::redirect("/home");
	}

	public function index()
	{
		$posts = $this->bo->findAll();
		$this->render("index", ["posts" => $posts]);
	}

	public function like($id) {
		$this->bo->like($id);
		Response::redirect("/home");
	}

	public function disLike($id) {
		$this->bo->disLike($id);
		Response::redirect("/home");
	}

	public function download($id) {
		$imageDownload = $this->bo->download($id);
		Response::download($imageDownload);
	}

}
