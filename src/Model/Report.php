<?php 
namespace App\Model;

use App\Interface\Response;
use Exception;

class Report
{
	public function generate(Response $response, $company=NULL)
	{
		$error = false;
		$message = '';
		$data = [];

		try{

			$source = new Statistic();

			$databaseSource = $source->getDataFromSource(new DatabaseSource);
			$xmlSource = $source->getDataFromSource(new XmlSource);
			$serviceSource = $source->getDataFromSource(new ServiceSource);
			
			$data = sumArraysByKey($databaseSource, $xmlSource, $serviceSource);

		}catch(Exception $e){

			$error = true;	
			$message = $e->getMessage();

		}

		$array = [
			'error'=>$error, 
			'message'=>$message,
			'data' => $data
		];

		if($company)
		{
			if(array_key_exists($company, $data))
			{
				$array['company'] = $company;
				$array['data'] = $data[$company];
			}
			else
			{
				error();
			}
		}

		return $response->render($array);
	}
}