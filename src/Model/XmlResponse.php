<?php
namespace App\Model;

use App\Interface\Response;
use Spatie\ArrayToXml\ArrayToXml;

class XmlResponse implements Response
{
	public function render($data)
	{
		header("Content-type: text/xml");
		echo ArrayToXml::convert($data);
	}
}