
		<div class="row">
<?php
	        		
		include('../config.txt');

		$extra_params = $_POST['extra_params'] . "&limit=" . $albums_per_page;

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

		//Get Albums
		$fields = "id,count,cover_photo,created_time,description,link,name";
		$json_link = "https://graph.facebook.com/{$fb_page_id}/albums/?access_token={$access_token}&fields={$fields}". $extra_params;

		$json = json_decode(curl_get_contents($json_link));
		$count = 0;
		for($i=1; $i<= sizeof($json->data) ; $i++): 
				$album = $json->data[$i-1];
				//var_dump($album);
				if(isset($album->cover_photo) && (($album->name != "Cover Photos" && $album->name != "Profile Pictures"  && $album->name != "Timeline Photos" ) || $show_all)):

				
					$fields="id,height,images,width,link,name,picture";
					$album_link = "https://graph.facebook.com/{$album->cover_photo->id}/?access_token={$access_token}&fields={$fields}";
					$album_json = json_decode(curl_get_contents($album_link));
					//var_dump($album_json);
					if(isset($album_json->images[3]->source)){
						$cover_ind = 3;
						$cover = $album_json->images[$cover_ind]->source;
					}
					else {
						$cover_ind = 0;
						$cover =  $album_json->images[0]->source;
					}
						if($album_json->images[$cover_ind]->height < $album_json->images[$cover_ind]->width){
							$orientation = "landscape";
						}
						else{
							$orientation = "portrait";
						}
					$count++;
		?>

					 <div class="col-sm-5 col-sm-offset-1 col-md-offset-0 col-md-3 album-cover">
					 	<div class="portfolio-item">
			                <a href="album.php?id=<?php echo $album->id ?>">
			                    <img class="img-responsive <?php echo $orientation;?>" src="<?php echo $cover; ?>" alt="<?php echo $album->name; ?>">
			                   
			                </a>
			            </div>
			             <div class="img-label"><?php echo $album->name; ?></div>
		            </div>
		            <?php if($count%4 == 0) : ?>
		            	</div>
		            	<div class="row">
		            <?php endif;?>
		        <?php endif;?>
        <?php endfor; ?>
        </div> <!-- End of Row -->
        <hr>

        <?php 
        	//Pagination
        	$pagination = $json->paging;
        	if(isset($pagination->previous))
        		$prev = "index.php?b=".$pagination->cursors->before ;
        	else
        		$prev = "#";

        	if(isset($pagination->next))
        		$next = "index.php?a=".$pagination->cursors->after;
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
