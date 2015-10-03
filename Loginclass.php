<?php 
    
    class User {
        private $username,$password,$fname,$lname,$point, $pictureid, $secret;
        protected $db;
        
	    public function __construct(){

	    	date_default_timezone_set('Asia/Jakarta');
	    	$hostname='localhost';
	    	$username='root';
	    	$password='';
	    	$dbname='poi';
	    	$secret = 'spinach';
	    	try{
	    		$this->db = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password,
	    				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
	    		$this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
	    	}
	    	catch (PDOException $e){
	    		echo "koneksi gagal".$e->getMessage();
	    		die();
	    	}
	    }
	    
	    //------------------INITIATE
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
	    	$this->pictureid=$result['PictureID'];
	    }
        
        
	    public function getimageid($username){
	    	$result =$this->db->query("select pictureid from user where username='$username' limit 1", PDO::FETCH_BOTH);
	    	$row = $result->fetch();
	    	$result->closeCursor();
	    	return $row['0'];
	    }

	    protected function matchPassword($char){
	    	if($this->password==$char)
	    		return true;
	    	else return false;
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
	    
	    protected function cookieLogout(){
	    	setcookie('login','',time()-3600,'/');
	    	echo '<script languange="javascript">
					       alert("Cookie expired. Logout succeded.");
						   document.location="../index.php"
						   </script>';
	    }

	    protected function cookieLogin(){
	    	list($cookuser, $cookverify) = split(',', $_COOKIE['login']);
	    	if(md5($cookuser.$this->secret)==$cookverify){
	    		session_start();
	    		$_SESSION['user']=$cookuser;
	    		echo '<script languange="javascript">
					       alert("Cookie login");
						   document.location="session/index.php"
						   </script>';
	    	}
	    	else
	    	{
	    		echo '<script languange="javascript">
					       alert("Cookies fault.");
						   document.location="index.php"
						   </script>';
	    	}
	    	
	    }
	     
	    //--------LOGIN-USER
	    protected function loginUser(){
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
	    		if($this->matchPassword($password)){
	    			echo '<script languange="javascript">
				            	alert("ERROR : WRONG PASSWORD");
								document.location="index.php"
							</script>';
	    		}
			    else{
					$_SESSION['user']=$username;
			    	$date = strtotime('+2 day');
			    	if(isset($_POST['keeplogged'])){
			    		setcookie('login', $username.','.md5($username.$this->secret),$date,'/');
			    		echo '<script languange="javascript">
					       alert("Cookie set until '. date(DATE_RFC850,$date) .'");
						   document.location="session/index.php"
						   </script>';
			    	}
			    	else echo '<script languange="javascript">
					      		 alert("Cookie is not set");
						  		 document.location="session/index.php"
						  	 	 </script>';
	    		}
	    	}
	    	
	    
	    }

		
	    protected function getlastimageid(){
	    	$query = $this->db->query("SELECT id FROM  images ORDER BY id DESC LIMIT 1",PDO::FETCH_BOTH);
	    	$row= $query->fetch();
	    	$query ->closeCursor();
	    	return $row[0];
	    }
	    
	    protected function getlastframeid(){
	    	$query = $this->db->query("SELECT f_id FROM  frame ORDER BY f_id DESC LIMIT 1",PDO::FETCH_BOTH);
	    	$row= $query->fetch();
	    	$query ->closeCursor();
	    	return $row[0];
	    }
	    
	    public function getimage($balik){
	    	$data = $this->db->query($balik);
	    	$data = $data->fetch(PDO::FETCH_ASSOC);
	    	return $data;
	    }

	    public function createUser(){
	    	
	    	$fname = $_POST['fname'];
	    	$lname = $_POST['lname'];
	    	$username = $_POST['username'];
	    	$pass = $_POST['pass'];
	    	

	    	
	        if(!($this->checkUsername($username)))
	        {	
	        	$this->db->beginTransaction();
		    	$result = $this->db->query("Insert into user values ('$username','$pass','$fname','$lname',0,'')");
		        $rows = $result -> rowCount();
		        if($rows){
		        	if($_FILES['photo']['name']!=NULL){
		        		$file_name = $_FILES['photo']['name'];
		        		$file_tmpname = $_FILES['photo']['tmp_name'];
		        		$file_size = $_FILES['photo']['size'];
		        		$file_mimetype = $_FILES['photo']['type'];
		        		$file = fopen($file_tmpname, 'r');
		        		$file_content = fread($file, $file_size)  or die ("tidak bisa baca source file");
		        		$file_content = mysql_real_escape_string($file_content)  or die ("tidak bisa baca source file");
		        		
		        		$query = $this->db->query("insert into images values(DEFAULT,'$file_name','$file_mimetype','$file_size','$file_content','$username')");
		        		
		        		$id = $this->getlastimageid();
		        		
		        		fclose($file);
		        		
		        		if(!$query){
							$this->db->rollback();
							echo '<script languange="javascript">
							            	alert("photo is not inserted , login failed");
											document.location="register.php"
								  </script>';
		        		}
		        		else {
			        		$quela = $this->db->query("update user set pictureid='$id' where username='$username'");
			        		$row=$quela->rowCount(); 					
			        		$this->db->commit();
				        	echo '<script languange="javascript">
								            	alert("Registrate Success! PHOTO UPLOADED || You should log in first");
												document.location="index.php"
									  </script>';
		        		}
		        	}
		        	else{
		        		$this->db->commit();
		        		echo '<script languange="javascript">
							            	alert("You choose to not upload the photo, right?");
											document.location="index.php"
								  </script>';
		        	}
			    		
			        		
		        }
		        else {
		        		$this->db->rollback();
		        		echo '<script languange="javascript">
							            	alert("Inserting query failed");
											document.location="registrasi.php"
								  </script>';
		        }
		        	
	        }
	        else echo '<script languange="javascript">
							            	alert("Username already exist");
											document.location="registrasi.php"
								  </script>';
	      }

	    public function editUser(){
	    	
	      	$fname = $_POST['fname'];
	      	$lname = $_POST['lname'];
	      	$newpass = $_POST['newpass'];
	      	$oldpass = $_POST['oldpass'];
	      	$username = $this->username;

	      	
	      	
	      	if(($this->checkUsername($username)))
	      	{
	      		if($this->password==$oldpass && $newpass!=NULL ){
			      		$result = $this->db->query("Update user set password='$newpass', 
		      													firstname='$fname',
		      													lastname= '$lname'
		      									where username= '$username'");
			      		$this->initiate($username);
			      		
			      		if($_FILES['photo']['name']!=NULL){
			      			$result->closeCursor();
			      			$file_name = $_FILES['photo']['name'];
			      			$file_tmpname = $_FILES['photo']['tmp_name'];
			      			$file_size = $_FILES['photo']['size'];
			      			$file_mimetype = $_FILES['photo']['type'];
			      			$file = fopen($file_tmpname, 'r');
			      			$file_content = fread($file, $file_size)  or die ("tidak bisa baca source file");
			      			$file_content = mysql_real_escape_string($file_content)  or die ("tidak bisa baca source file");
			      			$file_error = $_FILES['photo']['error'];
			      			
			      			$lala=$this->db->query("select * from images where owner ='$username'");
			      			$lala=$lala->fetchAll();
			      			
			      			if($lala){
				      			$pid  = $this->pictureid;
				      			$query = $this->db->query("update images 
				      									   set name ='$file_name',
				      										   type ='$file_mimetype',
				      										   size = '$file_size',
				      										   data = '$file_content'
				      									   where id='$pid'");
			      			}
				      		else {
								$query = $this->db->query("insert into images values(DEFAULT,'$file_name','$file_mimetype','$file_size','$file_content','$username')", PDO::FETCH_ASSOC);
								
								if($query){
									$id = $this->getlastimageid();
			        				$query = $this->db->query("update user set pictureid='$id' where username='$username'");
								}
								else 	
								{		echo '<script languange="javascript">
										alert("ERROR : PHOTO CANNOT BE UPATED");
										document.location="editprofile.php"
										</script>';
								}
			      			}
			      			
			      			fclose($file);
			      			
			      			if(!$query->rowCount()){
			      				echo '<script languange="javascript">
							            	alert("ERROR : PHOTO CANNOT BE UPATED");
											document.location="editprofile.php"
								  </script>';
			      			}
			      			else 
			      				echo '<script languange="javascript">
								            	alert("Edit profil Success");
												document.location="editprofile.php"
									  </script>';
	      				  
			      		}	
			      		else
			      			echo '<script languange="javascript">
							            	alert("You choose to not upload the photo, right?");
											document.location="editprofile.php"
								  </script>';
				      		
		    			}
		      	else{
		      		echo '<script languange="javascript">
							            	alert("ERROR : PASSWORD FALSE");
											document.location="editprofile.php"
								  </script>';
		  		 }	
			}
	    }  
    
	    
    }
    
   //---------------------------------------class FRAME------------------------------
   class Frame extends User{
   	
	   	public function timeline(){
	   		$result = $this->db->query("SELECT f_id, f_user, f_lat, f_long, kategori, f_time, pictureid , attachmentid , deskripsi , alamat
										FROM frame LEFT JOIN user
										ON frame.f_user=user.username
	   									order by f_time desc
	   									Limit 10");
	   		$kirim = $result->fetchAll();
	   		return $kirim;
	   	}
	   	
	   	public function profile($username){
	   		$result = $this->db->query("SELECT f_id, f_lat, f_long, kategori, f_time, pictureid, attachmentid , deskripsi , alamat
										FROM frame LEFT JOIN user
										ON frame.f_user=user.username
	   									where username='$username'
	   									order by f_time desc
	   									limit 30");
	   		$kirim = $result->fetchAll();
	   		return $kirim; 
	   	}
	   	
	   	public function addMarker($username){
	   		
	   		$validating = $_POST['password'];
	   		$lat = $_POST['latitude'];
	   		$long = $_POST['longitude'];
	   		$kategori = $_POST['category'];
	   		$deskripsi = $_POST['deskripsi'];
	   		$alamat = $_POST['alamat'];
	   		
	   		$this->initiate($username);
	   		
	   		if($this->matchPassword($validating)){
	   			$this->db->beginTransaction();
	   			$result = $this->db->exec("insert into frame (f_id, f_lat, f_long,f_user,kategori,f_time,deskripsi, attachmentid,alamat)
	   										values ( DEFAULT, $lat ,$long,'$username','$kategori',now(),'$deskripsi','','$alamat')");
	   			$userpoint = $this->db->exec("update user set points=points+1 where username='$username'");
	   			
		        if($result && $userpoint){
		        	if($_FILES['attachment']['name']!=NULL){
		        		$file_name = $_FILES['attachment']['name'];
		        		$file_tmpname = $_FILES['attachment']['tmp_name'];
		        		$file_size = $_FILES['attachment']['size'];
		        		$file_mimetype = $_FILES['attachment']['type'];
		        		$file = fopen($file_tmpname, 'r');
		        		$file_content = fread($file, $file_size)  or die ("tidak bisa baca source file");
		        		$file_content = mysql_real_escape_string($file_content)  or die ("tidak bisa baca source file");
		        		
		        		$query = $this->db->query("insert into images values(DEFAULT,'$file_name','$file_mimetype','$file_size','$file_content','$username')");
		        		
		        		$id = $this->getlastimageid();
		        		$fid = $this->getlastframeid();
		        		
		        		fclose($file);
		        		
		        		if(!$query){
							$this->db->rollback();
							echo '<script languange="javascript">
							            	alert("LOGIN FAILED : UPLOAD ERROR");
											document.location="addframe.php"
								  </script>';
		        		}
		        		else {
			        		$quela = $this->db->query("update frame set attachmentid='$id' where f_id='$fid'");
			        		$row=$quela->rowCount(); 					
			        		$this->db->commit();
				        	echo '<script languange="javascript">
								            	alert("FRAME ADD SUCCESS & PHOTO UPLOADED ");
												document.location="index.php"
							      </script>';
		        		}
		        	}
		        	else{
		        		$this->db->commit();
		        		echo '<script languange="javascript">
							            	alert("You choose to not upload an attachment");
											document.location="index.php"
								  </script>';
		        	}
		        }
		        else {
		        		$this->db->rollback();
		        		echo '<script languange="javascript">
							            	alert("Inserting query failed");
											document.location="addframe.php"
								  </script>';
		        }
	   		}
	   		else 			
					echo '<script languange="javascript">
					       alert("Password invalid");
						   document.location="addframe.php"
						   </script>';
	   	}
	   	
	   	public function checkNode($fid){
	   		$query = $this->db->query("select * from frame where f_id='$fid'", PDO::FETCH_ASSOC);
	   		$result = $query->fetch();
	   		$affected = $query->rowCount();
	   		 
	   		$query->closeCursor();
	   		 
	   		if($affected)
	   			return $result;
	   		else
	   			return false;
	   	}
	   	
	   	public function editMarker($fid){
	   	
	   		$kategori = $_POST['category'];
	   		$deskripsi = $_POST['deskripsi'];
	   	
	   		
	   		
	   		$result = $this->db->exec("update frame set kategori='$kategori',deskripsi='$deskripsi'
	   									 where f_id='$fid'");
	   			 
	   		if($result){
	   					echo '<script languange="javascript">
							            	alert("Edit frame sukses");
											document.location="myprofile.php"
								  </script>';
	   				}
	   			
	   			else {
	   				echo '<script languange="javascript">
							            	alert("Inserting query failed");
											document.location="myprofile.php"
								  </script>';
	   			}
		   	
   		}
	  
	   	public function forMaps(){
	   		$query = $this->db->query("SELECT * FROM frame");
	   		return $query->fetchAll(PDO::FETCH_ASSOC);
	   		
	   	}
   
	   	public function delf($id,$username){
	   		$query = $this->db->query("select * from frame where f_id='$id'", PDO::FETCH_ASSOC);
	   		$row=$query->fetch();
	   		$query->closeCursor();
	   		if($row['F_User']==$username){
	   			$quela = $this->db->exec("delete from frame where f_id='$id'");
	   			
	   			if($quela) echo '<script languange="javascript">
					       alert("Delete sukses.");
						   document.location="index.php"
						   </script>';
	   			else echo '<script languange="javascript">
					       alert("ERROR : EKSEKUSI QUERY GAGAL.");
						   document.location="myprofile.php"
						   </script>';
	   		}
	   		else{
	   			echo '<script languange="javascript">
					       alert("Yang berhk menghapus record ini hanya user atau administrator.");
						   document.location="index.php"
						   </script>';
	   		}
	   	}
	   	
	   	public function getframepicid($fid){
	   		$result = $this->db->query("select attachmentid from frame where f_id='$fid'", PDO::FETCH_ASSOC);
	   		if($result->rowCount()){
	   			$attachid=$result->fetch();
	   			$result->closeCursor();
	   			return $attachid['attachmentid'];
	   		}
	   		else
	   			return -999;
	   	}
	   	
	   	public function checkOwner($fid,$username){
	   		$result = $this->db->query("select f_user from frame where f_id='$fid'", PDO::FETCH_ASSOC);
	   		if($result->rowCount()){
	   			$result=$result->fetch();
	   			$nama = $result['f_user'];
	   			if($nama!=$username)
	   				return false;
	   			else
	   				return $result;
	   		}
	   		else
	   			return -9999;
	   	}
   
       public function render($lat,$long){
           
           $query = " SELECT * , p.distance_unit
                                     * DEGREES(ACOS(COS(RADIANS(p.lat_now))
                                     * COS(RADIANS(f_lat))
                                     * COS(RADIANS(p.long_now) - RADIANS(f_long))
                                     + SIN(RADIANS(p.lat_now))
                                     * SIN(RADIANS(f_lat)))) AS jarak
                      FROM ( SELECT f_id, f_user, f_lat, f_long, kategori, f_time, pictureid , attachmentid , deskripsi , alamat
										FROM frame LEFT JOIN user
										ON frame.f_user=user.username
	   									order by f_time desc ) as frame
                      JOIN (   /* latnow dan longnow isinya lokasi si user , distance unit -> kilometer bumi*/
                            SELECT  '$lat'  AS lat_now, '$long' AS long_now,
                                    10.0 AS batas,      111.045 AS distance_unit
                        ) AS p ON 1=1
                      WHERE frame.f_lat
                         BETWEEN p.lat_now  - (p.batas / p.distance_unit)
                             AND p.lat_now  + (p.batas / p.distance_unit)
                        AND frame.f_long
                         BETWEEN p.long_now - (p.batas / (p.distance_unit * COS(RADIANS(p.lat_now))))
                             AND p.long_now + (p.batas / (p.distance_unit * COS(RADIANS(p.lat_now))))
                      ORDER BY jarak
                      LIMIT 5";
           $result = $this->db->query($query,PDO::FETCH_ASSOC);
           $kirim = $result->fetchAll();
           
           return $kirim;
           
       }

}
    
   
   class Log extends User{
   	
   	public function loginbasic(){
   		$this->loginUser();
   	}
   	
   	public function logincookie(){
   		$this->cookieLogin();
   	}
   	
   	public function logoutcookie(){
   		$this->cookieLogout();
   	}
   }
?>