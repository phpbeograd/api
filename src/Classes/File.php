<?php
// ***********************************************************************//
// ***********************************************************************//
//
// ** File		work with files
// **
// ** @author   PhP Beograd <php.beograd@gmail.com>
// ** @access   public
// ** @version 	6.1
// ** require	none
// **
// ***********************************************************************//
// ***********************************************************************//

namespace App\Classes;

class File
{
	// download a file
	// $file - file to download
	public static function download($file)
	{
		if (!self::exists($file)){return false;}

		$fileName = basename($file);
		$fileSize = filesize($file);
		$fileType = mime_content_type($file);

		// Output headers.
		header("Cache-Control: private");
		header("Content-Length: ".$fileSize);
		header("Content-Disposition: attachment; filename=".$fileName);
		header("Content-type: $fileType");
		header("Content-Transfer-Encoding: binary");
		header("Pragma: no-cache");
		header("Expires: 0");

		// Output file.
		readfile ($file);
		return true;
	}

	// create a file
	// $file - path
	// $content - set content into a new file
	// $type - a or w
	// $mod - chmod setting
	public static function create($file, $content="", $type="a", $mod=0777)
	{
		if(!self::exists($file))
		{
			$f = fopen($file, $type);
			fwrite($f, $content);
			fclose($f);
			self::permission($file, $mod);

			return true;
		}
		else
		{
			return false;
		}
	}

	// if exists
	// $file - path
	// $type = local - ona a local dir or external on a external server
	public static function exists($file, $type="local")
	{
		if($type=="local")
		{
			return file_exists($file);
		}
		else
		if($type=="external")
		{
			if(@get_headers($file)[0] == 'HTTP/1.1 200 OK'){return true;}else{return false;};
		}
	}

	// set permission
	// $file - path
	// $mod - chmod setting
	public static function permission($file, $mod=0777)
	{
		if (!self::exists($file)){return false;}

		if(!chmod($file, $mod)){return false;};

		return true;
	}

	// write into a file
	// $file - path
	// $content - write content
	// $type = a or w
	public static function write($file, $content, $type="w")
	{
		if (!self::exists($file)){return false;}

		$f = fopen($file, $type);
		fwrite($f, $content);
		fclose($f);

		return true;
	}

	// read a file
	// $file - path
	public static function read($file)
	{
		if (!self::exists($file)){return false;}

		return file_get_contents($file);
	}

	// size of a file
	// $file - path
	public static function size($file)
	{
		if (!self::exists($file)){return false;}

		$bytes=filesize($file);
		if ($bytes >= 1073741824)
		{
			$bytes = number_format($bytes / 1073741824, 2) . ' gb';
		}
		elseif ($bytes >= 1048576)
		{
			$bytes = number_format($bytes / 1048576, 2) . ' mb';
		}
		elseif ($bytes >= 1024)
		{
			$bytes = number_format($bytes / 1024, 2) . ' kb';
		}
		elseif ($bytes > 1)
		{
			$bytes = $bytes . ' bytes';
		}
		elseif ($bytes == 1)
		{
			$bytes = $bytes . ' byte';
		}
		else
		{
			$bytes = '0 bytes';
		}

		return $bytes;
	}

	// get extension of a file
	// $file - path
	public static function extension($file)
	{
		if (!self::exists($file)){return false;}

		$i = strrpos($file,".");

		if (!$i)
		{
			return "";
		}

		$l = strlen($file) - $i;
		$ext = substr($file,$i+1,$l);

		return $ext;
	}

	// get create date and time of a file
	// $file - path
	// $format - set date format
	public static function date($file, $format="d.m.Y H:i:s")
	{
		if (!self::exists($file)){return false;}

		return date ($format, filemtime($file));
	}

	// delete file
	// $file - path
	public static function delete($file)
	{
		if (!self::exists($file)){return false;}

		unlink($file);

		return true;
	}

	// remove extension from a file name
	// $file - path
	public static function name($file)
	{
		return preg_replace('/\\.[^.\\s]{3,4}$/', '', $file);
	}

	public static function getExtension($file)
	{
		$i = strrpos($file,".");
		if (!$i)
		{
			return "";
		}
	
		$l = strlen($file) - $i;
		$ext = substr($file,$i+1,$l);
		
		return $ext;
	}	
}
?>
