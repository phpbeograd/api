<?php
namespace App\Controller;

use App\Model\ArrayResponse;
use App\Model\JsonResponse;
use App\Model\Report;
use App\Model\XmlResponse;

class ReportController
{
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
}