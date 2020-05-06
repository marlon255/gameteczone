<?php
if((!isset($_SESSION['login']) == true)):
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header('location: ../index.php');
endif;
?>