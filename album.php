<?php
	        		
	include('config.txt');

	//CURL Function which gets the data from FB
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
		
	//If the Album ID is set in the URL, get it and get  the data from facebook
	if(isset($_GET['id'])){
			$fields = "count,created_time,description,link,name";
			$id = $_GET['id'];
			$json_link = "https://graph.facebook.com/".$_GET['id']."/?access_token={$access_token}&fields={$fields}";
			
			$album = json_decode(curl_get_contents($json_link));
	}
	else{
		//If there's no ID set, DIE
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">		
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="css/fb-gallery-style.css">
		<!-- STYLESHEET for BOOTSTRAP LIGHTBOX -->
		<link href="css/ekko-lightbox.min.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="css/fb-gallery-style.css">
		<title> <?php echo $album->name; ?> Photos - Facebook API Gallery </title>


		<script type="text/javascript">
			
			function getAlbum(param){

				$.ajax({
			        type: 'post',
			        url: 'scripts/loadAlbum.php',
			        data: {
			        	id: '<?php echo $id;?>',
			           	extra_params: param,
			           	album_name: '<?php echo $album->name;?>'
			        },
			        success: function( data ) {
			            document.getElementById("spinner").style.display = "none";
			            document.getElementById("galleryDiv").innerHTML = data;
			        }
			    });
			}
		</script>

	</head>
	<?php 

		/*
			Pagination
		*/
		if(isset($_GET['position']) && isset($_GET['ref']))
		{
			if($_GET['position'] == "a"){
				$quer = "&after=".$_GET['ref'];
			}
			else{
				$quer = "&before=".$_GET['ref'];
			}
		}
		else{
			$quer = "";
		}

	?>
	<body onload="getAlbum('<?php echo $quer; ?>')">


			

			<!-- Page Content -->
    <div class="container">

	        <!-- Page Heading -->
	        <div class="row" >
	            <div class="col-lg-12">
	                <h1 class="page-header"><?php echo $album->name; ?>
	                    <a href="index.php"><small>Gallery</small></a>
	                </h1>
	            </div>
	        </div>
	        <!-- /.row -->

	        <!-- Projects Row -->
	    <div id="galleryDiv">
			<div class="row">
	        		<div class="col-xs-2 col-xs-offset-5" id="spinner">
	        			<div class="loader" >Loading Albums...</div>
	        		</div>
	        </div> <!--End Row -->

	        
	    </div>
    </div>		
<script src="//code.jquery.com/jquery-latest.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script src="js/ekko-lightbox.min.js"></script>
		<!-- Javascript to Initialise the Lightbox -->
        <script type="text/javascript">
            $(document).ready(function ($) {
                // delegate calls to data-toggle="lightbox"
                $(document).delegate('*[data-toggle="lightbox"]:not([data-gallery="navigateTo"])', 'click', function(event) {
                    event.preventDefault();
                    return $(this).ekkoLightbox({
                        onShown: function() {
                            if (window.console) {
                                return console.log('Checking our the events huh?');
                            }
                        },
						onNavigate: function(direction, itemIndex) {
                            if (window.console) {
                                //return console.log('Navigating '+direction+'. Current item: '+itemIndex);
                            }
						}
                    });
                }); 
				// navigateTo
                $(document).delegate('*[data-gallery="navigateTo"]', 'click', function(event) {
                    event.preventDefault();

                    var lb;
                    return $(this).ekkoLightbox({
                        onShown: function() {

                            lb = this;

							$(lb.modal_content).on('click', '.modal-footer a', function(e) {

								e.preventDefault();
								lb.navigateTo(2);

							});

                        }
                    });
                });


            });
        </script>
</body>

</html>