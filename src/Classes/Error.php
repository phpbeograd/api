<?php
// ***********************************************************************//
// ***********************************************************************//
//
// ** Error		error handler
// **
// ** @author   PhP Beograd <php.beograd@gmail.com>
// ** @access   public
// ** @version 	7.0
// ** require	Email 4.0, File 5.0
// **
// ***********************************************************************//
// ***********************************************************************//

namespace App\Classes;

use App\Classes\File;
use App\Classes\Email;

class Error
{
	// create error file
	public static function load()
	{
		$doctype =
			'
			<?php
			if(isset($_POST["izbrisi"]))
			{
				unlink("'.DIR.ERROR_FILE.'");
				header("Location: '.URL.'");
			}
			?>
			<?php
			if(isset($_POST["login"]))
			{
				if($_POST["user"]!="php" || $_POST["password"]!="beograd")
				{
					die("Error");
				}
			}
			else
			{
				?>
				<!DOCTYPE html>
				<html lang="sr">
				<head>
				<meta charset="UTF-8">
				<title>Greške sajta</title>
				<style type="text/css">
				body{
					background-color: silver;
					font-family:Verdana, Arial, Helvetica, sans-serif;
					color:white;
					text-shadow:1px 1px 2px black;
					font-size:1em;
				}

				h2{
					margin:0px;
				}

				.login{
					margin-top:10%;
				}

				#btnLogin{
					background:white;
					border:solid black 0px;
					padding:5px;
					color:silver;
					width:305px;
					font-weight:bold;
					height:50px;
				}

				.inputtext{
					width:300px;
					border:solid white 2px;
					height:30px;
				}
				</style>
				</head>
				<body>

				<form action="" method="post" >
				<table width="100%" align="center" class="login" cellspacing="20px">

				<tr>
					<td align="center">
						<h2 align="center">Greške sajta</h2>
					</td>
				</tr>

				<tr>
					<td align="center">
						<input name="user" type="text" placeholder="Korisničko ime" size="30" class="inputtext">
					</td>
				</tr>

				<tr>
					<td align="center">
						<input name="password" type="password" placeholder="Lozinka" size="30" class="inputtext">
					</td>
				</tr>

				<tr>
					<td align="center">
						<input name="login" type="submit" id="btnLogin" value="Login" >
					</td>
				</tr>
				</table>
				</form>

				</body>
				</html>
				<?php
				die();
			}
			?>
			';

		$doctype.=
			'
			<form action="" method="post">
				<input style="position:absolute; top:5px; right:10px; font-size:20px; " type="submit" value="Delete" name="izbrisi" />
			</form>
			';

		$doctype.= "<!DOCTYPE html><html lang='sr'><head><meta charset='UTF-8'><title>Greške sajta</title></head><body>";

		if(ENVIRONMENT=="production")
		{
			if(File::create(ERROR_FILE, $doctype, "a", 0777))
			{
				$message = "There was an error on ".SITE_NAME." !<br/>";
				$message.= "Link to error file: <a href='".ERROR_FILE."'>".ERROR_FILE."</a>";
			}
		}
	}

	// error in php code
	// $code - php error code
	// $msg - message of the error
	// $file - file with error
	// $line - line of error
	public static function log($code, $msg, $file, $line)
	{
		$page = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$ip = $_SERVER['REMOTE_ADDR'];

		$date = date("d.m.Y - H:i:s");

		$ferror  = "<fieldset style='border-color:red'>";
			$ferror .= "<legend style='color:red'>ERROR</legend>";
			$ferror .= "<strong>Day</strong>: ".$date."<br/>";
			$ferror .= "<strong>Page</strong>: <a target='blank' href='{$page}'>".$page."</a><br/>";
			$ferror .= "<strong>File:</strong> ".$file."<br/>";
			$ferror .= "<strong>Error code:</strong> ".$code."<br/>";
			$ferror .= "<strong>Line code:</strong> ".$line."<br/>";
			$ferror .= "<strong>IP:</strong> ".$ip."<br/>";
			$ferror .= "<strong>Reason:</strong> $msg ";
		$ferror .= "</fieldset> <br/>";

		if(ENVIRONMENT=="development")
		die($ferror);

		self::load();

		File::write(ERROR_FILE, $ferror, "a");
	}
}
?>
