<?php


	// $homepageEvents = new WP_Query(array(
	// 	'posts_per_page' => 2,
	// 	'post_type' => 'event'
	// ));

	// while($homepageEvents->have_posts()){
	// 	the_post();	
	// }

	$connect 	= mysqli_connect('localhost', 'root', '', 'wordpress');
	$nama 		= $_POST['nama'];

	echo $query = "INSERT INTO wp_coba (nama) VALUES ('".$nama."')";
	$insert = mysqli_query($connect, $query);

	if($insert){
		echo 'masuk';
	}else{
		echo 'tidak masuk';
	}

	// Redirection to the success page
	header("Location:");	
?>