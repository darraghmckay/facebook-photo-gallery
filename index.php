<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="css/fb-gallery-style.css">
		<title>Facebook API Gallery</title>

		<script type="text/javascript">

			function getAlbums(param){

				

				$.ajax({
			        type: 'post',
			        url: 'scripts/loadGallery.php',
			        data: {
			           extra_params: param
			        },
			        success: function( data ) {
			            document.getElementById("spinner").style.display = "none";
			            document.getElementById("galleryDiv").innerHTML = data;
			        }
			    });
			}
		</script>

	</head>
	<?php if(isset($_GET['b']))
		{
			$quer = "&before=".$_GET['b'];
		}
		else if(isset($_GET['a']))
		{
			$quer = "&after=".$_GET['a'];
		}
		else{
			$quer = "";
		}
		//if they've already been navigating
	?>
	<body onload="getAlbums('<?php echo $quer; ?>')">


		
			<!-- Page Content -->
    <div class="container">

	        <!-- Page Heading -->
	        <div class="row" >
	            <div class="col-lg-12">
	                <h1 class="page-header">Facebook Gallery
	                    <!--<small>Secondary Text</small>-->
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
</body>

</html>