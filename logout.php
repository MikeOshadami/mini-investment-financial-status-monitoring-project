<?php
	session_start();
	unset($_SESSION['user_session']);
    unset($_SESSION['user_role']);
	
	if(session_destroy())
	{
		header("Location: index.php");
	}
?>