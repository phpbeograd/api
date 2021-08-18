<?php 
namespace App\Model;

use App\Interface\Source;

class Statistic
{
	public function getDataFromSource(Source $source)
	{
		return $source->getData();
	}
}