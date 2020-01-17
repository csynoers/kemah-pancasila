<?php
  	session_start();

 	// remove all session variables
	session_unset();

	// destroy the session
	session_destroy();
  	echo "<script>alert('Proses logout sukses!!'); window.location = '../'</script>";
?>
