<?php
namespace App\Model;

use Exception;

class ServiceSource implements \App\Interface\Source
{
	public function getData()
	{
		$error = false;

		if(!$error)
		{
			return [
				'Google Analytics' => 5,
				'Positive Guys' => 10,
				'Something else' => 111,
				'Private' => 5,
				'Only in Service Source' => 225
			];
		}
		else
		{
			throw new Exception('Something went wrong with the Service source!');
		}
	}
}