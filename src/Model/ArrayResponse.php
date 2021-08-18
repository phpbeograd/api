<?php
namespace App\Model;

use App\Interface\Response;

class ArrayResponse implements Response
{
	public function render($data)
	{
		return $data;
	}
}