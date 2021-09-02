<?php 
session_start(); 
 require_once('../class/class.logger.php');
 require_once('../star_tok_gen.php');
 $log_text="";$log_obj;
//echo('success');die;
//$form_data = '{"status":false,"message":"Invalid Details comment"}'; 
//print_r($_POST);die;
if (startokgen::validate_token($_POST['star_token']))
{
	if(hash_equals($_SESSION['logtok'],$_POST['logtok']))
	{
			if (isset($_POST['uname']) && $_POST['uname'] != '' && isset($_POST['pword']) && $_POST['pword'] != '') 
			{
				$para_uname = trim(strip_tags($_POST['uname']));
				$para_pword = trim(strip_tags($_POST['pword']));
				if ($para_uname != "" && $para_pword != "") 
				{
					
				
					require_once('../class/class.auth.php');
						$obj = new auth();
						$resmsg = $obj->check_auth($para_uname,$para_pword); 
						$obj->closeConnection();
						//$resmsg = "ok";
						//echo("Return Msg :".$resmsg);
						
						print_r($resmsg);
					
				}
				else 
				{
					echo(False);
				}
			} 
			

			else
			{
				$form_data = '{"status":false,"message":"Invalid Details , Cant Process Now.. "}'; 
				print_r($form_data);
			}
	}
	else
	{
		$form_data = '{"status":false,"message":"Invalid token Details , Cant Process Now.. "}'; 
		print_r($form_data);
	}
}
else
{
	$form_data = '{"status":false,"message":"Invalid star token Details , Cant Process Now.. "}'; 
		print_r($form_data);
}


function writelog($logtype,$logtext)
	{
		try 
		{
		$log_obj = new Logger();
		//$log_obj->putLog($logtype,$logtext);
		$log_obj = null;
		}
		catch(Exception $e) { 	
		}
	}	
?>
