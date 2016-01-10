
		<div class="row">
<?php
	        		
		
		include('../config.txt');

		$id = $_POST['id'];
		$extra_params = $_POST['extra_params'] . "&limit=" . $pics_per_page;
		$album_name= $_POST['album_name'];

		

		 function curl_get_contents($url)
		{
		  $ch = curl_init($url);
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		  $data = curl_exec($ch);
		  curl_close($ch);
		  return $data;
		}

		//Get Album Photos
		//$fields = "id,count,cover_photo,created_time,description,link,name";
		$json_link = "https://graph.facebook.com/{$id}/photos/?access_token={$access_token}". $extra_params;
		//echo $json_link;

		$json = json_decode(curl_get_contents($json_link));
		$count = 0;
		//var_dump($json);
		for($i=1; $i<= sizeof($json->data) ; $i++): 
				$photo = $json->data[$i-1];
				//var_dump($album);
				

					
					$fields="id,height,images,width,link,name,picture";
					$album_link = "https://graph.facebook.com/{$photo->id}/?access_token={$access_token}&fields={$fields}";
					$album_json = json_decode(curl_get_contents($album_link));
					//var_dump($album_json);
					if(isset($album_json->images[4]->source)){
						$cover_ind = 4;
						$pic = $album_json->images[$cover_ind]->source;
					}
					else {
						$cover_ind = 0;
						$pic =  $album_json->images[0]->source;
					}
						if($album_json->images[$cover_ind]->height < $album_json->images[$cover_ind]->width){
							$orientation = "landscape";
						}
						else{
							$orientation = "portrait";
						}

					if(isset($album_json->images[1])){
						$large = $album_json->images[1]->source;
					}
					else{
						$large = $album_json->images[0]->source;
					}

					$count++;
		?>

					 <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-offset-0 col-md-3 album-cover" >
					 	<a href="<?php echo $pic; ?>"  data-toggle="lightbox" data-title="<?php echo  $count ."/". sizeof($json->data) . " ".$album_name; ?>" data-footer="FB API Gallery - Created By <a href='darraghmckay.com' target='_blank'>Darragh Mc Kay</a>"  data-gallery="popupgallery">
						 	<div class="portfolio-item" >
				                
				                    <img class="img-responsive <?php echo $orientation;?>" src="<?php echo $pic; ?>" >
				                   
				                
			            	</div>
			            </a>
		            </div>
		            <?php if($count%4 == 0) : ?>
		            	</div>
		            	<div class="row">
		            <?php endif;?>
		        
        <?php endfor; ?>
        </div> <!-- End of Row -->
        <hr>

        <?php 
        	//Pagination
        	$pagination = $json->paging;
        	if(isset($pagination->previous))
        		$prev = "album.php?id=$id&position=b&ref=".$pagination->cursors->before ;
        	else
        		$prev = "#";

        	if(isset($pagination->next))
        		$next = "album.php?id=$id&position=a&ref=".$pagination->cursors->after;
        	else
        		$next = "#";
        ?>
	        <!-- Pagination -->
	        <div class="row text-center">
	            <div class="col-lg-12">
	                <ul class="pagination">
	                    <li>
	                        <a href="<?php echo $prev; ?>">&laquo;</a>
	                    </li>
	                    <li class="" id="page_num">
	                       <a href="#"> &nbsp; &nbsp;</a>
	                    </li>
	                    <li>
	                        <a href="<?php echo $next; ?>">&raquo;</a>
	                    </li>
	                </ul>
	            </div>
	        </div>
