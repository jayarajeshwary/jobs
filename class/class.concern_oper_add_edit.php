<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Kolkata');
require_once('class.dbconfig.php');
//require_once('class.logger.php');
 
class config_app_add_edit 
{
	private $conn;private $log_obj;private $log_text;
	public function __construct()
	{
		try{
		$instance = Database::getInstance();
		$this->conn = $instance->getConnection();
		}
		catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
   		}
		
    }
	public function __destruct() {
         $this->conn=null;
    }
	public function runQuery($sql)
	{
		/*LOG CODE*/
			$this->log_text="Class GD : rq : ".$sql;
			$this->writelog("q_log",$this->log_text);
		/*LOG CODE*/
		
		//echo($sql);
		$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		return $stmt;
	}
	public function runInsQuery($sql)
	{
		/*LOG CODE*/
			$this->log_text="Class GD : rq : ".$sql;
			$this->writelog("q_log",$this->log_text);
		/*LOG CODE*/
		//$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		$stmt = $this->conn->prepare($sql);
		//var_dump($stmt);
		return $stmt;
	}
	public function runUpdQuery($sql)
	{
		/*LOG CODE*/
			$this->log_text="Class GD : rq : ".$sql;
			$this->writelog("q_log",$this->log_text);
		/*LOG CODE*/
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function closeConnection() 
	{
        $this->conn=null;
    }



    public function ins_upd_user_config($fname,$lname,$email,$pword,$emp_id,$usr_adid,$ldap_id) 
	{
		try
			{
				$query_sql = "CALL sp_update_user_config(?,?,?,?,?,?,?);";
				$query_stmt = $this->conn->prepare($query_sql);
				
				//$query_stmt->bindParam(1, $task_stage_id, PDO::PARAM_INT);
				$query_stmt->bindParam(1, $fname, PDO::PARAM_STR);
				$query_stmt->bindParam(2, $lname, PDO::PARAM_STR);
				$query_stmt->bindParam(3, $email, PDO::PARAM_STR);
				$query_stmt->bindParam(4, $pword, PDO::PARAM_STR);
				$query_stmt->bindParam(5, $emp_id, PDO::PARAM_INT);
				$query_stmt->bindParam(6, $usr_adid, PDO::PARAM_INT);
				$query_stmt->bindParam(7, $ldap_id, PDO::PARAM_INT);
				//$query_stmt->bindParam(9, $user_key, PDO::PARAM_INT);
				

				$query_stmt->execute();
				$output = $query_stmt->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e){
				print($e->getMessage());
			} 
			return $output;
	}
 
	
	public function ins_upd_pallet_config($pallet_id,$pallet_code,$avl_status,$isactive,$isvisible,$facility_id,$user_key) 
	{
		try
			{
				if(trim($pallet_id)=='')
				{
					$pallet_id=0;
				}
				
				$query_sql = "CALL sp_update_pallet_config(?,?,?,?,?,?,?);";
				$query_stmt = $this->conn->prepare($query_sql);
				$query_stmt->bindParam(1, $facility_id, PDO::PARAM_INT);
				$query_stmt->bindParam(2, $pallet_id, PDO::PARAM_INT);
				$query_stmt->bindParam(3, $pallet_code, PDO::PARAM_STR);
				$query_stmt->bindParam(4, $avl_status, PDO::PARAM_STR);
				$query_stmt->bindParam(5, $isactive, PDO::PARAM_INT);
				$query_stmt->bindParam(6, $isvisible, PDO::PARAM_INT);
				$query_stmt->bindParam(7, $user_key, PDO::PARAM_INT);
				

				$query_stmt->execute();
				$output = $query_stmt->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e){
				print($e->getMessage());
			} 
			return $output;
	}

	public function ins_upd_dock_config($dock_id,$dock_code,$dock_name,$ul_direction,$compatability,$dock_leveler,
	$dock_status,$isactive,$isvisible,$facility_id,$user_key) 
	{
		try
			{
				if(trim($dock_id)=='')
				{
					$dock_id=0;
				}
				
				$query_sql = "CALL sp_update_dock_config(?,?,?,?,?,?,?,?,?,?,?);";
				$query_stmt = $this->conn->prepare($query_sql);
				$query_stmt->bindParam(1, $facility_id, PDO::PARAM_INT);
				$query_stmt->bindParam(2, $dock_id, PDO::PARAM_INT);
				$query_stmt->bindParam(3, $dock_code, PDO::PARAM_STR);
				$query_stmt->bindParam(4, $dock_name, PDO::PARAM_STR);
				$query_stmt->bindParam(5, $ul_direction, PDO::PARAM_INT);
				$query_stmt->bindParam(6, $compatability, PDO::PARAM_INT);
				$query_stmt->bindParam(7, $dock_leveler, PDO::PARAM_INT);
				$query_stmt->bindParam(8, $dock_status, PDO::PARAM_INT);
				$query_stmt->bindParam(9, $isactive, PDO::PARAM_INT);
				$query_stmt->bindParam(10, $isvisible, PDO::PARAM_INT);
				$query_stmt->bindParam(11, $user_key, PDO::PARAM_INT);
				

				$query_stmt->execute();
				$output = $query_stmt->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e){
				print($e->getMessage());
			} 
			return $output;
	}
	
	
	

	public function ins_upd_pickup_config($pickup_id,$pickup_code,$pickup_name,$associated_rack,$seq_no,$isactive,
	$isvisible,$facility_id,$user_key) 
	{
		try
			{
				if(trim($pickup_id)=='')
				{
					$pickup_id=0;
				}
				
				$query_sql = "CALL sp_update_pickup_config(?,?,?,?,?,?,?,?,?);";
				$query_stmt = $this->conn->prepare($query_sql);
				$query_stmt->bindParam(1, $facility_id, PDO::PARAM_INT);
				$query_stmt->bindParam(2, $pickup_id, PDO::PARAM_INT);
				$query_stmt->bindParam(3, $pickup_code, PDO::PARAM_STR);
				$query_stmt->bindParam(4, $pickup_name, PDO::PARAM_STR);
				$query_stmt->bindParam(5, $associated_rack, PDO::PARAM_INT);
				$query_stmt->bindParam(6, $seq_no, PDO::PARAM_INT);
				$query_stmt->bindParam(7, $isactive, PDO::PARAM_INT);
				$query_stmt->bindParam(8, $isvisible, PDO::PARAM_INT);
				$query_stmt->bindParam(9, $user_key, PDO::PARAM_INT);
				

				$query_stmt->execute();
				$output = $query_stmt->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e){
				print($e->getMessage());
			} 
			return $output;
	}
	public function ins_upd_rack_config($rack_id,$rack_code,$rack_name,$isactive,$isvisible,$facility_id,$user_key) 
	{
		try
			{
				if(trim($rack_id)=='')
				{
					$rack_id=0;
				}
				
				$query_sql = "CALL sp_update_rack_config(?,?,?,?,?,?,?);";
				$query_stmt = $this->conn->prepare($query_sql);
				$query_stmt->bindParam(1, $facility_id, PDO::PARAM_INT);
				$query_stmt->bindParam(2, $rack_id, PDO::PARAM_INT);
				$query_stmt->bindParam(3, $rack_code, PDO::PARAM_STR);
				$query_stmt->bindParam(4, $rack_name, PDO::PARAM_STR);
				$query_stmt->bindParam(5, $isactive, PDO::PARAM_INT);
				$query_stmt->bindParam(6, $isvisible, PDO::PARAM_INT);
				$query_stmt->bindParam(7, $user_key, PDO::PARAM_INT);
				

				$query_stmt->execute();
				$output = $query_stmt->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e){
				print($e->getMessage());
			} 
			return $output;
	}
	public function ins_upd_droppoint_config($droppoint_id,$droppoint_code,$droppoint_name,$associated_rack,$seq_no,$isactive,
	$isvisible,$facility_id,$user_key) 
	{
		try
			{
				if(trim($droppoint_id)=='')
				{
					$droppoint_id=0;
				}
				
				$query_sql = "CALL sp_update_droppoint_config(?,?,?,?,?,?,?,?,?);";
				$query_stmt = $this->conn->prepare($query_sql);
				$query_stmt->bindParam(1, $facility_id, PDO::PARAM_INT);
				$query_stmt->bindParam(2, $droppoint_id, PDO::PARAM_INT);
				$query_stmt->bindParam(3, $droppoint_code, PDO::PARAM_STR);
				$query_stmt->bindParam(4, $droppoint_name, PDO::PARAM_STR);
				$query_stmt->bindParam(5, $associated_rack, PDO::PARAM_INT);
				$query_stmt->bindParam(6, $seq_no, PDO::PARAM_INT);
				$query_stmt->bindParam(7, $isactive, PDO::PARAM_INT);
				$query_stmt->bindParam(8, $isvisible, PDO::PARAM_INT);
				$query_stmt->bindParam(9, $user_key, PDO::PARAM_INT);
				

				$query_stmt->execute();
				$output = $query_stmt->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e){
				print($e->getMessage());
			} 
			return $output;
	}
	public function ins_upd_receiver_config($receiver_id,$receiver_code,$receiver_name,$associated_droppoint,$isactive,
	$isvisible,$facility_id,$user_key) 
	{
		try
			{
				if(trim($receiver_id)=='')
				{
					$receiver_id=0;
				}
				
				$query_sql = "CALL sp_update_receiver_config(?,?,?,?,?,?,?,?);";
				$query_stmt = $this->conn->prepare($query_sql);
				$query_stmt->bindParam(1, $facility_id, PDO::PARAM_INT);
				$query_stmt->bindParam(2, $receiver_id, PDO::PARAM_INT);
				$query_stmt->bindParam(3, $receiver_code, PDO::PARAM_STR);
				$query_stmt->bindParam(4, $receiver_name, PDO::PARAM_STR);
				$query_stmt->bindParam(5, $associated_droppoint, PDO::PARAM_INT);
				$query_stmt->bindParam(6, $isactive, PDO::PARAM_INT);
				$query_stmt->bindParam(7, $isvisible, PDO::PARAM_INT);
				$query_stmt->bindParam(8, $user_key, PDO::PARAM_INT);
				

				$query_stmt->execute();
				$output = $query_stmt->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e){
				print($e->getMessage());
			} 
			return $output;
	}
	
	public function ins_upd_rackmodule_config($facility_id,$rackmodule_id,$sel_rack_code,$sel_rack,$rnum,$cnum,$avl_status,$isactive,$isvisible,$user_key)
	{
		try
		{
			if(trim($rackmodule_id)=='')
			{
				$rackmodule_id=0;
			}
			$rackmodule_code="RK-".str_pad($facility_id,3,"0", STR_PAD_LEFT)."-".str_pad($sel_rack,2,"0", STR_PAD_LEFT)."G".$rnum.str_pad($cnum,2,"0", STR_PAD_LEFT);
			
			$query_sql = "CALL sp_add_rack_module(?,?,?,?,?,?,?,?,?,?);";
			$query_stmt = $this->conn->prepare($query_sql);
			
			
			$query_stmt->bindParam(1, $rackmodule_id, PDO::PARAM_INT);
			$query_stmt->bindParam(2, $rackmodule_code, PDO::PARAM_STR);
			$query_stmt->bindParam(3, $sel_rack, PDO::PARAM_INT);
			$query_stmt->bindParam(4, $rnum , PDO::PARAM_STR);
			$query_stmt->bindParam(5, $cnum, PDO::PARAM_INT);
			$query_stmt->bindParam(6, $avl_status, PDO::PARAM_INT);
			$query_stmt->bindParam(7, $isactive, PDO::PARAM_INT);
			$query_stmt->bindParam(8, $isvisible, PDO::PARAM_INT);
			$query_stmt->bindParam(9, $user_key, PDO::PARAM_INT);
			$query_stmt->bindParam(10, $facility_id, PDO::PARAM_INT);
			

			$query_stmt->execute();
			$output = $query_stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
			print($e->getMessage());
		} 
		return $output;
	}

	public function deactivate_rackmodule_config($sel_rack,$user_key)
	{
		try
		{
			$query_sql = "CALL sp_deactivate_rack_module(?,?);";
			$query_stmt = $this->conn->prepare($query_sql);
			$query_stmt->bindParam(1, $sel_rack, PDO::PARAM_INT);
			$query_stmt->bindParam(2, $user_key, PDO::PARAM_INT);
			$query_stmt->execute();
			$output = $query_stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
			print($e->getMessage());
		} 
		return $output;
	}
	public function edit_rackmodule_config($ed_rackmodule_id,$ed_avl_status,$ed_isactive,$ed_isvisible,$user_key)
	{
		try
		{
			$query_sql = "update rack_module_detail set available_status=:ed_avl_status,isactive=:ed_isactive,isvisible=:ed_isvisible,mod_date=now(),mod_user=:user_key where rack_module_id=:ed_rackmodule_id";
			$query_stmt = $this->conn->prepare($query_sql);
			$query_stmt->bindParam('ed_avl_status', $ed_avl_status, PDO::PARAM_INT);
			$query_stmt->bindParam('ed_isactive', $ed_isactive, PDO::PARAM_INT);
			$query_stmt->bindParam('ed_isvisible', $ed_isvisible, PDO::PARAM_INT);
			$query_stmt->bindParam('ed_rackmodule_id', $ed_rackmodule_id, PDO::PARAM_INT);
			$query_stmt->bindParam('user_key', $user_key, PDO::PARAM_INT);
			$status=$query_stmt->execute();
			if ($status) {

				$query_sqlupd = "update rack_module_availability set alloted_status=:ed_isactive where rack_module_id=:ed_rackmodule_id";
				$query_stmt1 = $this->conn->prepare($query_sqlupd);
				$query_stmt1->bindParam('ed_isactive', $ed_isactive, PDO::PARAM_INT);
				$query_stmt1->bindParam('ed_rackmodule_id', $ed_rackmodule_id, PDO::PARAM_INT);
				$status=$query_stmt1->execute();

				return "success";
			 } else {
				return "failure";
			 }
		}
		catch(PDOException $e){
			print($e->getMessage());
		} 
		return $output;
	}

	public function ins_upd_pallet_track_config($pallet_track_id,$pallet_id,$doc_id,$doc_type,$type_of_sp,$dock_id,
	$no_of_boxes,$priority,$facility_id,$user_key)
	{
		try
		{
			if(trim($pallet_track_id)=='')
			{
				$pallet_track_id=0;
			}
			
			
			$query_sql = "CALL sp_add_pallet_track(?,?,?,?,?,?,?,?,?,?);";
			$query_stmt = $this->conn->prepare($query_sql);
			
			
			$query_stmt->bindParam(1, $pallet_track_id, PDO::PARAM_INT);
			$query_stmt->bindParam(2, $pallet_id, PDO::PARAM_STR);
			$query_stmt->bindParam(3, $doc_id, PDO::PARAM_STR);
			$query_stmt->bindParam(4, $doc_type , PDO::PARAM_INT);
			$query_stmt->bindParam(5, $type_of_sp, PDO::PARAM_INT);
			$query_stmt->bindParam(6, $dock_id, PDO::PARAM_STR);
			$query_stmt->bindParam(7, $no_of_boxes, PDO::PARAM_INT);
			$query_stmt->bindParam(8, $priority, PDO::PARAM_INT);
			$query_stmt->bindParam(9, $facility_id, PDO::PARAM_INT);
			$query_stmt->bindParam(10,$user_key, PDO::PARAM_INT);
			

			$query_stmt->execute();
			$output = $query_stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
			print($e->getMessage());
		} 
		return $output;
	}
	
 
  public function writelog($logtype,$logtext)
	{
		try 
		{
			if (!is_object($this->log_obj)) {
				$this->log_obj = new Logger();
			}
			$this->log_obj->putLog($logtype,$logtext);
		}
		catch(Exception $e) { 	}
	}	
}	
?>
