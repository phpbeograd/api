<?php
namespace App\Controller;

use App\Model\ArrayResponse;
use App\Model\Report;

class HomeController
{
	public function index()
	{
		$report = new Report;

		$array = $report->generate(new ArrayResponse);

		$data['companies'] = $array['data'];

		return view('home', $data);
	}
}