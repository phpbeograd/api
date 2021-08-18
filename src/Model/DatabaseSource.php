<?php
namespace App\Model;

use Exception;

class DatabaseSource implements \App\Interface\Source
{
	public function getData()
	{
		$error = false;

		if(!$error)
		{
			return [
				'Google Analytics' => 1600,
				'Positive Guys' => 500,
				'Something else' => 123
			];
		}
		else
		{
			throw new Exception('Something went wrong with the Database source!');
		}
	}
}