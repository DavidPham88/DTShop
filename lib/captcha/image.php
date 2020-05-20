<?php	
	session_start(); // important
	
	//Create Random Function ( include number and char )
	function rand_string( $length ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
	@$str .= $chars[ rand( 0, $size - 1 ) ];
	}
	return $str;
	}
	
	$captcha_text = rand_string(5); // create random numbers

	$_SESSION['captcha'] = $captcha_text; // save random numbers inside captcha session
	

	// Create Image

	$image = imagecreate( 100, 32 ); // create new image, width is 100, and height is 32

	$background_color = imagecolorallocate( $image, 0, 0, 0 ); // background color RGB, black: 0, 0, 0

	$text_color = imagecolorallocate( $image, 255, 255, 255 ); // text color RGB, white: 255, 255, 255

	imagestring( $image, 4, 25, 8, $captcha_text, $text_color ); // font size is 4, and position from left is 25, and position from top is 8


	// Display Image

	header( "Content-type: image/png" );

	imagepng( $image );

	imagecolordeallocate( $text_color );

	imagecolordeallocate( $background_color );

	imagedestroy( $image );

?>