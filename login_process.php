<?php
	session_start();
	require_once 'dbconfig.php';

	if(isset($_POST['btn-login']))
	{
        $user_email = trim($_POST['email_address']);
		$user_password = trim($_POST['password']);
		
		$password = md5($user_password);
		
		try
		{	
		
			$stmt = $db_con->prepare("SELECT * FROM users WHERE emailAddress=:email");
			$stmt->execute(array(":email"=>$user_email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			if($row['password']==$password){
				
				echo "ok"; // log in
				$_SESSION['user_session'] = $row['id'];
                $_SESSION['user_role'] = $row['role'];
			}
			else{
				
				echo "email address or password does not exist."; // wrong details
			}
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>