

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Business Casual - Start Bootstrap Theme</title>

	<!-- Bootstrap Core CSS -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style.css">

	<!-- Custom CSS -->
	<link href="../css/business-casual.css" rel="stylesheet">

	<!-- Fonts -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<?php


?>
<body>

<div class="brand">Not Important</div>
<!---<div class="address-bar">3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890</div>--->

<!-- Navigation -->
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
			<a class="navbar-brand" href="indexnew.php">Business Casual</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li>
					<a href="../indexnew.php">Home</a>
				</li>
				<li>
					<a href="../about.html">Ingredients</a>
				</li>
				<li>
					<a href="../login.php">Login</a>
				</li>
				<li>
					<a href="/CS411Project/dashboard/users.php">Dashboard</a>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>


<div class="container">



	<?php
	$content = file_get_contents("http://abujaba2.web.engr.illinois.edu/cs411project/api/getRecipe.php?limit=30&&page=1", true);
	$array = json_decode($content);
	/*
        echo '<pre>';
        print_r($array);
        echo '</pre>';

    */



	?>

	<div class="body">
		<div>
			<!---
			<div class="header">
				<ul>
					<li>
						<a href="index.html">Home</a>
					</li>
					<li>
						<a href="recipes.html">A to Z Recipes</a>
					</li>
					<li class="current">
						<a href="featured.html">Featured Recipes</a>
					</li>
					<li>
						<a href="videos.html">Videos</a>
					</li>
					<li>
						<a href="about.html">About</a>
					</li>
					<li>
						<a href="blog.html">Blog</a>
					</li>
				</ul>
			</div>
			--->
			<div class="body">
				<div id="content">
					<div>
						<div>
							<h3>This is just a place holder, so you can see what the site would look like.</h3>
							<p>
								This website template has been designed by <a href="http://www.freewebsitetemplates.com/">Free Website Templates</a> for you, for free. You can replace all this text with your own text. You can remove any link to our website from this website template, you&#39;re free to use this website template without linking back to us. If you&#39;re having problems editing this website template, then don&#39;t hesitate to ask for help on the <a href="http://www.freewebsitetemplates.com/forums/">Forums</a>.
							</p>
							<a href="index.html"><img src="images/pork-barbeque.jpg" alt="Image"></a>
							<h5>INGREDIENTS</h5>
							<ol class="ingredients">
								<li>
									10 grms This is just a place holder
								</li>
								<li>
									5 slices This is just a place holder
								</li>
								<li>
									12 pcs. This is just a place holder
								</li>
								<li>
									1 liter This is just a place holder
								</li>
								<li>
									3/4 cup This is just a place holder
								</li>
								<li>
									1/4 cup This is just a place holder
								</li>
							</ol>
							<h5>DIRECTIONS</h5>
							<ol class="directions">
								<li>
									You can remove any link to our website from this website template.
								</li>
								<li>
									You&#39;re free to use this website template without linking back to us.
								</li>
								<li>
									This is just a place holder, so you can see what the site would look like.
								</li>
								<li>
									You can remove any link to our website from this website template.
								</li>
								<li>
									You&#39;re free to use this website template without linking back to us.
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div>

			<div>
				<h3>Cooking Video</h3>
				<a href="videos.html"><img src="images/cooking-video.png" alt="Image"></a>
				<span>Vegetable &amp; Rice Topping</span>
			</div>
			<div>
				<h3>Featured Recipes</h3>
				<ul id="featured">
					<li>
						<a href="recipes.html"><img src="images/sandwich.jpg" alt="Image"></a>
						<div>
							<h2><a href="recipes.html">Ham Sandwich</a></h2>
							<span>by: Anna</span>
						</div>
					</li>
					<li>
						<a href="recipes.html"><img src="images/biscuit-and-coffee.jpg" alt="Image"></a>
						<div>
							<h2><a href="recipes.html">Biscuit &amp; Sandwich</a></h2>
							<span>by: Sarah</span>
						</div>
					</li>
					<li>
						<a href="recipes.html"><img src="images/pizza.jpg" alt="Image"></a>
						<div>
							<h2><a href="recipes.html">Delicious Pizza</a></h2>
							<span>by: Rico</span>
						</div>
					</li>
				</ul>
			</div>
			<div>
				<h3>Blog</h3>
				<ul id="blog">
					<li>
						<a href="blog.html">This is just a place holder, so you can see what the site would look like.</a>
						<span class="date">Jan 9, by Liza</span>
					</li>
					<li>
						<a href="blog.html">This is just a place holder, so you can see what the site would look like.</a>
						<span class="date">Feb 16, by Myk</span>
					</li>
					<li>
						<a href="blog.html">This is just a place holder, so you can see what the site would look like.</a>
						<span class="date">March 15, by Xaxan</span>
					</li>
				</ul>
			</div>
			<div>
				<h3>Get Updates</h3>
				<a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" id="facebook">Facebook</a>
				<a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" id="twitter">Twitter</a>
				<a href="http://freewebsitetemplates.com/go/youtube/" target="_blank" id="youtube">Youtube</a>
				<a href="http://freewebsitetemplates.com/go/flickr/" target="_blank" id="flickr">Flickr</a>
				<a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" id="googleplus">Google&#43;</a>
			</div>

		</br>
		</br>
		</div>

	</div>


</div>




</div>





<!-- /.container -->

<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<p>Copyright &copy; Your Website 2014</p>
			</div>
		</div>
	</div>
</footer>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Script to Activate the Carousel -->
<script>
	$('.carousel').carousel({
		interval: 5000 //changes the speed
	})
</script>

</body>

</html>