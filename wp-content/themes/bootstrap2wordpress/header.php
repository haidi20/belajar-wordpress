<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Bootstrap to WordPress
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="  http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- Bootstrap core CSS -->
<link href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/bootstrap.min.css" rel="stylesheet">

<!-- custom css -->
<!-- <link href="<?php bloginfo('stylesheet_directory'); ?>/style.css" rel="stylesheet"> -->


<!-- FontAwesome Icons -->
<link href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>

<?php wp_head(); ?>

<!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
	h1.entry-title{
		display:none;
	}
	.navbar-brand>img{
		width: 150px;
	}
	.navbar-collapse{
		min-height: 100px;
	}
	#hero {
		background: url('<?php bloginfo('stylesheet_directory'); ?>/assets/img/bg-kubar-orangg.jpg') 50% 50% no-repeat fixed;
		min-height: 500px;
		padding: 90px 0;
		background-size: 1500px;
		color: white;
		-webkit-font-smoothing: antialiased;
		text-rendering: optimizelegibility;
	}

	#hero article {
		width: 100%;
		text-align: center;
	}

	#hero .hero-text {
		margin-top: 30px;
	}

</style>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<!-- <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'bootstrap2wordpress' ); ?></a> -->
	
	<!-- HEADER
	================================================== -->
	<header class="site-header" role="banner">
		
		<!-- NAVBAR
		================================================== -->
		<div class="navbar-wrapper">
			
			<div class="navbar navbar-default  navbar-fixed-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="/"><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/img/logo-bawaslu.png" alt=""></a>
					</div>

					<?php 
						// wp_nav_menu( array(
						// 	'theme_location' => 'primary',
						// 	'container' => 'nav',
						// 	'container_class' => 'navbar-collapse collapse',
						// 	'menu_class' => 'nav navbar-nav navbar-right',
						// ));

						$after = array('dropdown', 'dropdown-menu', 'class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"');
						$before = array('menu-item-has-children', 'sub-menu', 'href="#"');

						echo str_replace($before, $after, wp_nav_menu( array(
						    'echo' => false,
						    'theme_location' => 'primary',
							'container' => 'nav',
							'container_class' => 'navbar-collapse collapse',
							'menu_class' => 'nav navbar-nav navbar-right',
						  ) )
						);
					?>

					<!-- <div class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right">
							<li class="active"><a href="/">Home</a></li>
							<li><a href="blog.html">Blog</a></li>
							<li><a href="resources.html">Resources</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</div> -->
				</div>
			</div>
		
		</div>
	</header>
	
	<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
	<script>
		$(function(){
			var ahref = $('.dropdown a').attr('href', 'coba');
			// ahref.attr('href', 'coba')
			console.log(ahref)
		});
	</script>