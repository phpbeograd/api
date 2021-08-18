<?php
namespace App\Model;

use Exception;

class XmlSource implements \App\Interface\Source
{
	public function getData()
	{
		$error = false;

		if(!$error)
		{
			return [
				'Google Analytics' => 256,
				'Positive Guys' => 321,
				'Something else' => 445
			];	
		}
		else
		{
			throw new Exception('Something went wrong with the Xml source!');
		}
	}
}