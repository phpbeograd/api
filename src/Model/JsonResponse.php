<?php
namespace App\Model;

use App\Interface\Response;

class JsonResponse implements Response
{
	public function render($data)
	{
		header("Content-type: text/json");
		return json_encode($data);
	}
}