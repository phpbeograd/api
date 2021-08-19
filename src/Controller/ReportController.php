<?php
namespace App\Controller;

use App\Model\ArrayResponse;
use App\Model\JsonResponse;
use App\Model\Report;
use App\Model\XmlResponse;

class ReportController
{
	// get request to get all entities
	public function read($responseType='json')
	{
		$report = new Report;

		switch($responseType)
		{
			case 'json':
				echo $report->generate(new JsonResponse);
			break;

			case 'xml':
				echo $report->generate(new XmlResponse);
			break;

			case 'array':
				print_r($report->generate(new ArrayResponse));
			break;

			default:
				echo $report->generate(new JsonResponse);
			break;
		}
	}

	// get request to get one entity
	public function show($company)
	{
		if(!empty($company))
		{
			$company = htmlspecialchars($company);
			$company = urldecode($company);
			
			$report = new Report;
			
			echo $report->generate(new JsonResponse, $company);
		}
		else
		{
			error();
		}
	}

	// post request to add new entity
	public function create()
	{
		// create a new entity
	}

	// put request to update an existing entity
	public function update($id)
	{
		// update an existing entity
	}

	// delete request to delete an entity
	public function delete($id)
	{
		// delete an entity
	}
}