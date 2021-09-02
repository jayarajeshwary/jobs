<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Kolkata');
//require_once("../include/validatetoken.php");
require_once("../class/class.user_oper_add_edit.php");
$obj = new config_app_add_edit();
$resmsg = "";
if ( isset($_POST['para_type']) )
{
	$type =  trim(strip_tags($_POST['para_type'])) ;
	//$para_user_key = $_SESSION["star"]["sess_user_key"];
	//$facility_id=$_SESSION['star']['sess_current_site'];
	$stat='success';
	$errMsg='';
	try 
    {
	switch($type){
			
			case "pallet_config":
				$para_pallet_id =  trim(strip_tags($_POST['para_pallet_id'])) ;
				$para_pallet_code =  trim(strip_tags($_POST['para_pallet_code'])) ;
				$para_avl_status =  trim(strip_tags($_POST['para_avl_status'])) ;
				$para_isactive =  trim(strip_tags($_POST['para_isactive'])) ;
				$para_isvisible =  trim(strip_tags($_POST['para_isvisible'])) ;
				$res = $obj->ins_upd_pallet_config($para_pallet_id,$para_pallet_code,$para_avl_status,$para_isactive,$para_isvisible,$facility_id,$para_user_key); 
				if(isset($res) && isset($res["response"]))
				{
					$resmsg=$res["response"];
				}
				break;	
			case "dock_config":
				$para_dock_id =  trim(strip_tags($_POST['para_dock_id'])) ;
				$para_dock_code =  trim(strip_tags($_POST['para_dock_code'])) ;
				$para_dock_name =  trim(strip_tags($_POST['para_dock_name'])) ;
				$para_ul_direction =  trim(strip_tags($_POST['para_ul_direction'])) ;
				$para_compatability =  trim(strip_tags($_POST['para_compatability'])) ;
				$para_dock_leveler =  trim(strip_tags($_POST['para_dock_leveler'])) ;
				$para_dock_status =  trim(strip_tags($_POST['para_dock_status'])) ;
				$para_isactive =  trim(strip_tags($_POST['para_isactive'])) ;
				$para_isvisible =  trim(strip_tags($_POST['para_isvisible'])) ;
				$res = $obj->ins_upd_dock_config($para_dock_id,$para_dock_code,$para_dock_name,$para_ul_direction,$para_compatability,$para_dock_leveler,
				$para_dock_status,$para_isactive,$para_isvisible,$facility_id,$para_user_key); 
				if(isset($res) && isset($res["response"]))
				{
					$resmsg=$res["response"];
				}
				break;	
				
			case "user_config":
			//print_r($_POST);
			//exit;
				//$concern_task_stage_id =  trim(strip_tags($_POST['para_task_stage_id'])) ;
				$fname =  trim(strip_tags($_POST['para_fname'])) ;
				$lname =  trim(strip_tags($_POST['para_lname'])) ;
				$email =  trim(strip_tags($_POST['para_email'])) ;
				$pword =  trim(strip_tags($_POST['para_pword'])) ;
				$emp_id = trim(strip_tags($_POST['para_emp_id']));
				$usr_adid = trim(strip_tags($_POST['para_usr_adid']));
				$ldap_id = trim(strip_tags($_POST['para_ldap_id']));

				//$para_user_key = $_SESSION["star"]["sess_user_key"];
				$res = $obj->ins_upd_user_config($fname,$lname,$email,$pword,$emp_id,$usr_adid,$ldap_id); //,$para_user_key
				if(isset($res) && isset($res["response"]))
				{
					$resmsg=$res["response"];
				}
				break;	

				case "pickup_config":
						$para_pickup_id =  trim(strip_tags($_POST['para_pickup_id'])) ;
						$para_pickup_code =  trim(strip_tags($_POST['para_pickup_code'])) ;
						$para_pickup_name =  trim(strip_tags($_POST['para_pickup_name'])) ;
						$para_associated_rack =  trim(strip_tags($_POST['para_associated_rack'])) ;
						$para_seq_no =  trim(strip_tags($_POST['para_seq_no'])) ;
						$para_isactive =  trim(strip_tags($_POST['para_isactive'])) ;
						$para_isvisible =  trim(strip_tags($_POST['para_isvisible'])) ;
						$res = $obj->ins_upd_pickup_config($para_pickup_id,$para_pickup_code,$para_pickup_name,$para_associated_rack,$para_seq_no,$para_isactive,
						$para_isvisible,$facility_id,$para_user_key); 
						if(isset($res) && isset($res["response"]))
						{
							$resmsg=$res["response"];
						}
						break;	
					case "rack_config":
						$para_rack_id =  trim(strip_tags($_POST['para_rack_id'])) ;
						$para_rack_code =  trim(strip_tags($_POST['para_rack_code'])) ;
						$para_rack_name =  trim(strip_tags($_POST['para_rack_name'])) ;
						$para_isactive =  trim(strip_tags($_POST['para_isactive'])) ;
						$para_isvisible =  trim(strip_tags($_POST['para_isvisible'])) ;
						$res = $obj->ins_upd_rack_config($para_rack_id,$para_rack_code,$para_rack_name,$para_isactive,$para_isvisible,$facility_id,$para_user_key); 
						if(isset($res) && isset($res["response"]))
						{
							$resmsg=$res["response"];
						}
						break;
					case "droppoint_config":
						$para_droppoint_id =  trim(strip_tags($_POST['para_droppoint_id'])) ;
						$para_droppoint_code =  trim(strip_tags($_POST['para_droppoint_code'])) ;
						$para_droppoint_name =  trim(strip_tags($_POST['para_droppoint_name'])) ;
						$para_associated_rack =  trim(strip_tags($_POST['para_associated_rack'])) ;
						$para_seq_no =  trim(strip_tags($_POST['para_seq_no'])) ;
						$para_isactive =  trim(strip_tags($_POST['para_isactive'])) ;
						$para_isvisible =  trim(strip_tags($_POST['para_isvisible'])) ;
						$res = $obj->ins_upd_droppoint_config($para_droppoint_id,$para_droppoint_code,$para_droppoint_name,$para_associated_rack,$para_seq_no,$para_isactive,
						$para_isvisible,$facility_id,$para_user_key); 
						if(isset($res) && isset($res["response"]))
						{
							$resmsg=$res["response"];
						}
						break;	
					case "receiver_config":
						$para_receiver_id =  trim(strip_tags($_POST['para_receiver_id'])) ;
						$para_receiver_code =  trim(strip_tags($_POST['para_receiver_code'])) ;
						$para_receiver_name =  trim(strip_tags($_POST['para_receiver_name'])) ;
						$para_associated_droppoint =  trim(strip_tags($_POST['para_associated_droppoint'])) ;
						$para_isactive =  trim(strip_tags($_POST['para_isactive'])) ;
						$para_isvisible =  trim(strip_tags($_POST['para_isvisible'])) ;
						$res = $obj->ins_upd_receiver_config($para_receiver_id,$para_receiver_code,$para_receiver_name,$para_associated_droppoint,$para_isactive,
						$para_isvisible,$facility_id,$para_user_key); 
						if(isset($res) && isset($res["response"]))
						{
							$resmsg=$res["response"];
						}
						break;	
					case "pallet_track":
							$para_pallet_track_id =  trim(strip_tags($_POST['para_pallet_track_id'])) ;
							$para_pallet_id =  trim(strip_tags($_POST['para_pallet_id'])) ;
							$para_doc_id =  trim(strip_tags($_POST['para_doc_id'])) ;
							$para_doc_type =  trim(strip_tags($_POST['para_doc_type'])) ;
							$para_type_of_sp =  trim(strip_tags($_POST['para_type_of_sp'])) ;
							$para_dock_id =  trim(strip_tags($_POST['para_dock_id'])) ;
							$para_no_of_boxes =  trim(strip_tags($_POST['para_no_of_boxes'])) ;
							$para_priority =  trim(strip_tags($_POST['para_priority'])) ;
							
							$res = $obj->ins_upd_pallet_track_config($para_pallet_track_id,$para_pallet_id,$para_doc_id,$para_doc_type,$para_type_of_sp,$para_dock_id,
							$para_no_of_boxes,$para_priority,$facility_id,$para_user_key); 
							if(isset($res) && isset($res["response"]))
							{
								$resmsg=$res["response"];
							}
							break; 
			default:
				$res = "";
				break;	
		}
	}
	catch(PDOException $e) {
            
		$obj->writelog("e_log","Error while updaing ops config details :".$e->getMessage());
		$stat="error";
		$errMsg="Error While updating configuration";
		
	} 
	finally
	{
		$obj->closeConnection(); 
		
	}

	
}
else
{
	$stat='error';
	$errMsg='Type of config is not defined';
}

$response = array(
    "status"=>$stat,
   "errmsg"=>$errMsg,
   "res"=> $resmsg
);
echo json_encode($response);
?>
