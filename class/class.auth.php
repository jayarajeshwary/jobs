<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Kolkata');
require_once('class.dbconfig.php');
require_once('class.logger.php');
require_once("../star_app_token.php");
class auth 
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
			$this->log_text="Class Auth : rq : ".$sql;
			//$this->writelog("q_log",$this->log_text);
		/*LOG CODE*/	
		
		$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		return $stmt;
	}
	public function runInsQuery($sql)
	{
		/*LOG CODE*/
			$this->log_text="Class Auth : riq : ".$sql;
			//$this->writelog("q_log",$this->log_text);
		/*LOG CODE*/	
		
		//$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		$stmt = $this->conn->prepare($sql);
		//var_dump($stmt);
		return $stmt;
	}
	public function runUpdQuery($sql)
	{
		/*LOG CODE*/
			$this->log_text="Class Auth : ruq : ".$sql;
			//$this->writelog("q_log",$this->log_text);
		/*LOG CODE*/	
		
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function closeConnection() 
	{
        $this->conn=null;
    }
	
	
	public function doLogout()
	{
		$this->logout_history();
		$this->add_user_availability($_SESSION['star']['sess_user_key'],1);
		
		session_destroy();
		session_unset();
		//unset($_SESSION['star']['user_session']);
		return true;
	}



	public function check_auth($para_uname,$para_pword)
	{
		$response = array();
		echo $response["status"] = FALSE;
		//echo " Jp";
		//exit;
	try{	
	
		$para_uname = $para_uname;
		$para_pword = $para_pword;
		
		$this->log_text="Class Auth : Login Attempt for ".$para_uname; $this->writelog("c_log",$this->log_text);
		
		//$query_stmt = "select u.*,s.site_name , ar.role_name , ar.role_hierarchy,ar.role_id from app_users u left outer join site s on u.default_site_id = s.site_id ";
		$query_stmt = "select u.*,s.facility_name , ar.role_name , ar.role_hierarchy,ar.role_id from app_users u left outer join location s on u.default_site_id = s.loc_id ";

		

		$query_stmt = trim($query_stmt) . " left outer join app_role ar on u.approle_id = role_id ";
		$query_stmt = trim($query_stmt) . " where (u.emp_id='".$para_uname."' or u.ad_id='".$para_uname."' or ";
		$query_stmt = trim($query_stmt) . " u.ldap_id='".$para_uname."' or u.email_id='".$para_uname."' ) ";
		$query_stmt = trim($query_stmt) . " and   1=1 ";
      $exec_stmt = $this->runQuery($query_stmt);
      //$exec_stmt->bindParam('bind_uname', $para_uname, PDO::PARAM_STR);
      //$exec_stmt->bindValue('bind_pword', $para_pword, PDO::PARAM_STR);
      $exec_stmt->execute();
      $count = $exec_stmt->rowCount();
      $row   = $exec_stmt->fetch(PDO::FETCH_ASSOC);

      $response["message"] = "Login Valid";

      /*if($count == 1 && !empty($row)) 
	  {
			
			if ($row['isactive'] == 0 )
			{
				$this->log_text="Class Auth : Not Active user ".$para_uname; $this->writelog("c_log",$this->log_text);
				$response["status"] = FALSE;
				$response["message"] = "Account is Not Active , Contact Admin";
				$response["action"] = "";
				$response["navigateto"]="/main/default.php";
			}
			else if ( $row['pword_locked'] == 1 )
			{
				$this->log_text="Class Auth : Password Locked ".$para_uname; $this->writelog("c_log",$this->log_text);
				$response["status"] = FALSE;
				$response["message"] = "Your Account is Locked , Contact Admin";
				$response["action"] = "";
				$response["navigateto"]="/main/default.php";
			}
			else if (password_verify($para_pword, $row['pword']))	
			{
				$this->log_text="Class Auth : Auth Success ".$para_uname; $this->writelog("c_log",$this->log_text);
				$this->writelog("c_log",implode('*',$row));
				$_SESSION['star']['sess_user_key']   = $row['user_key'];
				$_SESSION['star']['sess_user_fname'] = $row['fname'];
				$_SESSION['star']['sess_user_lname'] = $row['lname'];
				$_SESSION['star']['sess_user_site_id'] = $row['default_site_id'];
				//$_SESSION['star']['sess_user_lang_id'] = $row['default_lang_id'];
				//$_SESSION['star']['sess_user_site_ids'] = $row['site_ids'];
				$_SESSION['star']['sess_user_type'] = $row['user_type'];
				$_SESSION['star']['sess_user_site_name'] = $row['facility_name'];
				$_SESSION['star']['sess_timeout'] = time();

				$_SESSION['star']['sess_default_lang'] = $row['default_lang_id'];
				$_SESSION['star']['sess_default_site'] = $row['default_site_id'];
				$_SESSION['star']['sess_current_site'] = $row['default_site_id'];
				$_SESSION['star']['sess_allowed_site'] = $row['site_ids'];

				$_SESSION['star']['sess_approle_id'] = $row['approle_id'];
				$_SESSION['star']['sess_approle_name'] = $row['role_name'];
				$_SESSION['star']['sess_approle_hierarchy'] = $row['role_hierarchy'];
				
				$this->create_permissions_json($row['approle_id'],$row['user_key']);
				
				$_SESSION['star']['sess_change_pword'] = $row['change_pword'];
				$_SESSION['star']['lock_screen'] = 0;
				starapptoken::create_token($row['user_key']); 
				$this->login_history($row['user_key']);
				$this->add_user_availability($row['user_key']);
				$response["status"] = TRUE;
				$response["message"] = "Login Valid";
				$response["outout"] = $_SESSION['star'];
				$response["change_pword"] = $row['change_pword'];

				if($row['role_hierarchy']==50)
				{
					$response["navigateto"]="./operations/pallet_tracking.php";
				}
				else if($row['role_hierarchy']==51 or $row['role_hierarchy']==52 or $row['role_hierarchy']==54
				|| $row['role_hierarchy']==55 or $row['role_hierarchy']==56 or $row['role_hierarchy']==57
				)
				{
					$response["navigateto"]="./mytasks/mytasks.php";
				}
				else if($row['role_hierarchy']==53)
				{
					$response["navigateto"]="./mytasks/receivertask.php";
				}
				else
				{
					$response["navigateto"]="./main/default.php";
				}
				//$response["active"] = $row['isactive'];
				
				//unset($_SESSION['star'];



			}
			else
			{
				$this->log_text="Class Auth : Auth Failed".$para_uname; $this->writelog("c_log",$this->log_text);
				$response["status"] = FALSE;
				$response["message"] = "InValid Password";
				//$response["active"] = $row['isactive'];
			}	

      }
	  else
	  { 
		$response["status"] = FALSE;
		$response["message"] = "Login InValid";
		$response["action"] = "";
		
	   }*/
	   
	}
       // Catch any errors
       catch(PDOException $e){
		   $response["error"]=$e->getMessage();

           //exit;
       }      
	  return json_encode($response); 
	}
	
	
	public function unlock_password($user_key,$lockscreen_pp)
	{
		$response = array();
		$response["status"] = FALSE;
		$val_lockscreen_pp = trim($lockscreen_pp);
		$val_user_key = $user_key;
		$query_stmt = "select pword as 'pp' from app_users u where u.user_key = $val_user_key and isactive=1 and 1=1";
		$exec_stmt = $this->runQuery($query_stmt);
		$exec_stmt->execute();
		$count = $exec_stmt->rowCount();
		$row   = $exec_stmt->fetch(PDO::FETCH_ASSOC);
		if($count == 1 && !empty($row)) 
			{
				if (password_verify($lockscreen_pp, $row['pp']))	
					{
						$response["status"] = TRUE;
						$response["message"] = "Login PassPhrase Valid";
						$_SESSION['star']['lock_screen'] = 0;
					}
					else
					{
						$response["status"] = FALSE;
						$response["message"] = "Password InCorrect";
					}
			}
		else
			{ 
				$response["status"] = FALSE;
				$response["message"] = "Password InValid";
			}

	  return json_encode($response); 
	}
	
	
	
	public function create_permissions_json($role_id,$user_key)
	{
		$query_stmt = "select appmodule_id,access_view,access_insert,access_edit,access_delete from app_role_module 
		where approle_id = $role_id  and isactive = 1 and block_status = 0 and  1=1 ";
		$exec_stmt = $this->runQuery($query_stmt);
		$exec_stmt->execute();
		//$row   = $exec_stmt->fetch(PDO::FETCH_ASSOC);
		$output = $exec_stmt->fetchAll(PDO::FETCH_ASSOC);
		//return json_encode($output);
		$uniq_session_id = session_id();
		$sessfile_name = $user_key."_".$uniq_session_id."_".date('Y-m-d').".json";
		$_SESSION['star']['sess_rights'] ="../files/session/".$sessfile_name;
		if (!file_exists($_SESSION['star']['sess_rights'])) {
        $fh1 = fopen($_SESSION['star']['sess_rights'], 'wb') or die("Can't create file");
        fclose($fh1);
		}	 
		file_put_contents($_SESSION['star']['sess_rights'],  json_encode($output) );
		return true;
	}
	
	
	public function reset_password($user_key,$reset_old,$reset_new,$reset_newretype)
	{
		$date_val = date('Y-m-d H:i:s');		
		$response = array();
		$response["status"] = FALSE;
		if ($reset_new != $reset_newretype)
		{
			$response["message"] = "New password and Retyped did not match ";
			return json_encode($response);  
		}
		
		if ($reset_old == $reset_new)
		{
			$response["message"] = "Old and New Password are Same ";
			return json_encode($response);  
		}
		
		$query_stmt = "select * from app_users where user_key = $user_key and 1=1 ";
		$exec_stmt = $this->runQuery($query_stmt);
		$exec_stmt->execute();
		$count = $exec_stmt->rowCount();
		$row   = $exec_stmt->fetch(PDO::FETCH_ASSOC);
		if($count == 1 && !empty($row)) 
		{
			if (password_verify($reset_old, $row['pword']))	
			{
				$new_password = password_hash($reset_new, PASSWORD_DEFAULT);
				$query_stmt = " update app_users set change_pword = 0 , pword_change_date = '$date_val' , pword = '$new_password' where user_key = $user_key and 1=1 ";
				$exec_stmt = $this->runUpdQuery($query_stmt);	
				$exec_stmt->execute();	
				$response["status"] = TRUE;
				$response["message"] = "Password Updated , Relogin ";
				return json_encode($response);  
			}
			else
			{
				$response["message"] = "Old Password did not match ";
				return json_encode($response);  
			}
		
		//return json_encode($response);  
		}
	
	}
	
	
	
	public function logout_history()
	{

		if (  isset($_SESSION['star']['sess_user_key']) &&  isset($_SESSION['star']['sess_his_id']) )
		{
		$date = date('Y-m-d H:i:s');

		$argv_user_key=$_SESSION['star']['sess_user_key'];
		$argv_logout_dt="'".$date."'"; 
		$sess_his_id=$_SESSION['star']['sess_his_id'];

		$query_stmt = " update login_history set logout_dt = $argv_logout_dt where login_his_id = $sess_his_id and user_key = $argv_user_key and 1=1  ";
		$exec_stmt = $this->runUpdQuery($query_stmt);	
		$exec_stmt->execute();	

		

		 
		if (file_exists($_SESSION['star']['sess_rights'])) { unlink($_SESSION['star']['sess_rights']); }
		
		
		}	 
			
	}	
	

	public function login_history($user_key)
	{
		$uniq_session_id = session_id();
		$date = date('Y-m-d H:i:s');
		
		 $argv_user_key=(Int)$user_key;
		 $argv_session_id="'".$uniq_session_id."'";
		 $argv_login_dt="'".$date."'"; 
		 $argv_system_ip="'".$this->getUserIP()."'";
			
			$query_stmt = "insert into login_history (user_key,user_type,system_ip,login_dt,session_id) values ($argv_user_key,0,$argv_system_ip,$argv_login_dt , $argv_session_id) "; 
			$exec_stmt = $this->runInsQuery($query_stmt);	
			$exec_stmt->execute();
			$_SESSION['star']['sess_his_id']=$this->conn->lastInsertId();

			
	}	
	public function add_user_availability($user_key,$logoutflag=0)
	{
		$date = date('Y-m-d H:i:s');
		$stat=1;
		if($logoutflag==1)
		{
			$date=null;
			$stat=0;
		}
		$user_a_role=$_SESSION['star']['sess_approle_id'];
		$curr_site_id=$_SESSION['star']['sess_current_site'];
		$user_a_role_hi=$_SESSION['star']['sess_approle_hierarchy'];
		if($user_a_role_hi>=50)
		{
			$ua_argv_user_key=(Int)$user_key;
			$query_sql = "CALL sp_update_user_availabilty(?,?,?,?,?,?);";
			$currenttask=0;
			

			$query_stmt = $this->conn->prepare($query_sql);
			$query_stmt->bindParam(1,$currenttask, PDO::PARAM_INT);
			$query_stmt->bindParam(2, $date, PDO::PARAM_STR);
			$query_stmt->bindParam(3, $stat, PDO::PARAM_INT);
			$query_stmt->bindParam(4, $ua_argv_user_key, PDO::PARAM_INT);
			$query_stmt->bindParam(5, $curr_site_id, PDO::PARAM_INT);
			$query_stmt->bindParam(6, $user_a_role, PDO::PARAM_INT);
			$query_stmt->execute();
			$output = $query_stmt->fetch(PDO::FETCH_ASSOC);
		}
	}
	
	public function getUserIP()
	{
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];

		if(filter_var($client, FILTER_VALIDATE_IP))
		{
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}

		return $ip;
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
