    <?php 
        		include 'akses.php';
				include 'proses.php';
        		
                $lat = $_REQUEST['lat'];
                $lng = $_REQUEST['lng'];
        		$frame = new Frame();
        		$datamap = $frame->render($lat,$lng);
        		
        		foreach($datamap as $titik){

        			echo '<div class="postingan">';
        			
        			if($titik['pictureid']==NULL || !$titik['pictureid']){
        				$src="../userdata/default.jpg";
        				echo "		<img class='pp' src='$src'>";
        			}
        			else{
        				$id = $titik['pictureid'];
        				echo "<img class='pp' src='viewimage.php?id=$id'>";
        			}
        			
        			settype($titik['jarak'], "float");
        			
        			$jarak =$titik['jarak'];
        			
        			$satuan = " km";
        			
        			if($jarak>0 && $jarak<1)
        			{
        				$jarak = $jarak * 1000;
        				$satuan = " meter";
        				
        			}
        			
        			$jarak = number_format($jarak, 2, ',', '.');
        			$titik['jarak']= $jarak . $satuan;
        			echo " <input type='hidden' value= ".$titik['f_lat']." class='lat'>";
        			echo " <input type='hidden' value= ".$titik['f_long']." class='long'>";
					echo " <input type='hidden' value= '".$titik['alamat']."' class='address'>";

		        	$waktu = time_since(strtotime($titik['f_time']));

		        	$titik['kategori'] = strtoupper($titik['kategori']);
		        	
		        	if( $titik['alamat']!=NULL || $titik['alamat']!='' || !$titik['alamat'] )
		        		echo "	<h2 class='alamat'> " . $titik['kategori'] . "   -  " . $waktu ." ( ".$titik['f_user']." ) <br> di ".$titik['alamat']."  </h2> ";
		        	else
		        		echo "	<h2 class='alamat'> " . $titik['kategori'] . "   -  " . $waktu ." ( ".$titik['f_user']." ) <br> di </h2> ";
		        	
		        	
		        	echo " <div class='clearfix'></div> ";
		        	
		        	$attachid=$titik['attachmentid'];
				    echo "		<div class='bukti'> ";
				    if($attachid){
    	        		echo "      	<img class='descimg' src='viewimage.php?id=$attachid'>";
    	        		echo "      	<p class='descwdimg'> ".$titik['deskripsi']."</p>";
    	        		echo "			<a href='download.php?id=".$attachid."'>
                    					<button class='linkdonlot'> Download bukti kejadian </div>
                    					</a> ";
        			}
		        	else
		        		echo "      	<p class='descnoimg'> ".$titik['deskripsi']."</p>";
			        
                    echo '			</div>';
        			echo '			</div>';
        		}
        		
        		echo '<script src="../js/fungsi.js"></script>';
        	?>