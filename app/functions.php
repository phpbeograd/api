<?php
function redirect($url)
{
	header("HTTP/1.1 301 Moved Permanently");
	header("Status: 301 Moved Permanently");
	header("Location: {$url}");
	die();
}

function error()
{
	redirect('/error');
}

function logError($message="Somethings wrong!", $file = __FILE__, $line = __LINE__)
{
	\App\Classes\Error::log("", $message, $file, $line);
}

function view($file, $data=[])
{
	extract($data, EXTR_PREFIX_SAME, "wddx");
	include 'public/'.$file.'.php';
}

function dd($value)
{
	echo "<pre style='background:black; color:white'>".var_export($value, true)."</pre>";
	die();
}

function sumArraysByKey() 
{
	$arrays = func_get_args();
	$keys = array_keys(array_reduce($arrays, function ($keys, $arr) { return $keys + $arr; }, array()));
	$sums = array();

	foreach ($keys as $key) 
	{
		$sums[$key] = array_reduce($arrays, function ($sum, $arr) use ($key) { 
			if(array_key_exists($key, $arr)){
				return $sum + $arr[$key]; 
			}else{
				return $sum;
			}
		});
	}

	return $sums;
}