    <?php 
        		include 'akses.php';

                $lat = $_REQUEST['lat'];
                $lng = $_REQUEST['lng'];
        		$frame = new Frame();
        		$datamap = $frame->render($lat,$lng);
        		
        		foreach($datamap as $titik){

        			echo ' <div class="postingan">';
        			
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
					
        			
		        	$waktu = date_create($titik['f_time']);
                    echo "	<h2> Radius ". $titik['jarak'] ." <strong>[".$titik['kategori']."]<strong>   |  ". date_format($waktu,'l, d M ( H:i )   | ') ."  </h2> ";
		        	
		        	
		        	echo "	<p> Ditambahkan oleh ".$titik['f_user']." </p> ";
		        	echo " <div class='clearfix'></div> ";
		        	$attachid=$titik['attachmentid'];
				        	echo "		<div class='bukti'> ";
				        	if($attachid){
				        		echo "      	<img class='descimg' src='viewimage.php?id=$attachid'>";
				        		echo "      	<p class='descwdimg'> ".$titik['deskripsi']."</p>";
				        		echo "			<a href='download.php?id=".$attachid."'>
	                        					<div class='linkdonlot'> Download bukti kejadian </div>
	                        					</a> ";
		        			}
		        			else
				        		echo "      	<p class='descnoimg'> ".$titik['deskripsi']."</p>";
			        		echo '			</div>';
        			
		        		echo '			</div>';
        		}
        	?>