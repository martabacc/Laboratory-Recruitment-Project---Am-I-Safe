<?php 
    
    class User {
        private $username,$password,$fname,$lname,$point,$pictureurl;
        protected $db;
        
	    public function __construct(){
	    	$hostname='localhost';
	    	$username='root';
	    	$password='';
	    	$dbname='poi';
	    	
	    	try{
	    		$pdo = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password,
	    				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));

	    		$this->db = $pdo;
	    	}
	    	catch (PDOException $e){
	    		echo "koneksi gagal".$e->getMessage();
	    		die();
	    	}
	    }
	    
	    //--------------------------INITIATE
	    public function initiate($username){
	    	$db = $this->db;
	    	$query =$db->query("select * from user where username='$username'", PDO::FETCH_ASSOC);
	    	$result = $query->fetch();
	    	$query->closeCursor();
	    	
	    	$this->username=$result['Username'];
	    	$this->password=$result['Password'];
	    	$this->fname=$result['Firstname'];
	    	$this->lname=$result['Lastname'];
	    	$this->point=$result['Points'];
	    	$this->pictureurl=$result['PictureUrl'];
	    }
	    
	    //--------CHECK USERNAME
	    public function checkUsername($username){
	    	$db = $this->db;
	    	$query = $db->query("select * from user where username='$username'", PDO::FETCH_ASSOC);
	    	$result = $query->fetch();
	    	$affected = $query->rowCount();
	    	
	    	$query->closeCursor();
	    	
	    	if($affected) 
	    		return $result;
	    	else 
	    		return false;
	    }
	    
	    //--------LOGIN-USER
	    public function loginUser(){
	    	$username = $_POST['username'];
	    	$password = $_POST['password'];
	    	
	    	$row = $this->checkUsername($username);
	    
	    	if(!$row){
	    		echo '<script languange="javascript">
				            	alert("ERROR : USERNAME DOESNT EXIST");
								document.location="index.php"
					  </script>';
	    	}
	    	else{
	    		if($row['Password']!=$password){
	    			echo '<script languange="javascript">
				            	alert("ERROR : WRONG PASSWORD");
								document.location="index.php"
							</script>';
	    		}
			    else{
			    	session_start();
					$_SESSION['user']=$username;
						
					echo '<script languange="javascript">
					       alert("WELCOME");
						   document.location="session/index.php"
						   </script>';
	    		}
	    	}
	    	
	    
	    }
	    
	    public function uploadPP($username){
	    	
	    	$ext = substr($_FILES['photo']['type'], 6);
	    	$dir = 'userdata/'.$username .'.'. $ext;
	    	
	    	$temp = $_FILES['photo']['tmp_name'];
	    
	    	if(move_uploaded_file($temp,$dir)){
	    		$result = $this->db->query("Update user set pictureurl='$dir' where username='$username'");
	    		if($result->rowCount())
	    			return true;
	    		else return false;
	    		}
	    	else return false;
	    }
	    
	    protected function matchPassword($char){
	    	if($this->password==$char)
	    		return true;
	    	else return false;
	    }
	    
	    public function createUser(){
	    	
	    	$fname = $_POST['fname'];
	    	$lname = $_POST['lname'];
	    	$username = $_POST['username'];
	    	$pass = $_POST['pass'];
	    	
	    	
	        if(!($this->checkUsername($username)))
	        {
		    	$result = $this->db->query("Insert into user values ('$username','$pass','$fname','$lname',0,'')");
		        $rows = $result -> rowCount();
		        if($rows){
		        	if($_FILES!=NULL){
		        		$this->uploadPP($username);
			        	echo '<script languange="javascript">
							            	alert("Registrate Success! PHOTO UPLOADED || You should log in first");
											document.location="index.php"
								  </script>';
		        	}
		        	else{
			        	echo '<script languange="javascript">
							            	alert("Registrate Success! PHOTO IS NOT UPLOADED || You should log in first");
											document.location="index.php"
								  </script>';
		        	}
			    		
			        		
		        }
		        	
	        }
	        else throw new Exception("Username already exist");
	      }

	    public function editUser(){
	    	
	      	$fname = $_POST['fname'];
	      	$lname = $_POST['lname'];
	      	$newpass = $_POST['newpass'];
	      	$oldpass = $_POST['oldpass'];
	      
	      	if(($this->checkUsername($this->username)))
	      	{
	      		if($this->password==$oldpass && $newpass!=NULL ){
			      		$result = $this->db->query("Update user set password='$newpass', 
		      													firstname='$fname',
		      													lastname= '$lname'
		      									where username='$this->username'");
			      		$result->closeCursor();
			      		$this->initiate($this->username);
			      		
	    		}
	      	}			
  		 }	
	}
   
   //---------------------------------------class FRAME------------------------------
   class Frame extends User{
   	
	   	public function timeline(){
	   		$result = $this->db->query("select f_lat, f_long, f_user,f_time, kategori, (user.pictureurl)pictureurl
											from frame,user
											where frame.f_user = user.username
											order by f_time desc");
	   		$kirim = $result->fetchAll();
	   		$result->closeCursor();
	   		return $kirim;
	   	}
	   	public function addMarker($username){
	   		$validating = $_POST['password'];
	   		$this->initiate($username);
	   		if($this->matchPassword($validating)){
	   			
	   			date_default_timezone_set('Asia/Jakarta');
	   			$date =  date('d-m-Y H:i:s');
	   		}
	   		else 			
					echo '<script languange="javascript">
					       alert("FRAME IS NOT ADDED");
						   document.location="index.php"
						   </script>';
	   	}
   
   }
    

?>