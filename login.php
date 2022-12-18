<?php include("includes/header.php"); ?>
<div class="container mlogin">
	<div id="login">
		<h1>Вход</h1>
		<form action="" id="loginform" method="post"name="loginform">
			<p><label for="user_login">Имя опльзователя<br>
				<input class="input" id="username" name="username"size="20"
				type="text" value=""></label></p>
				<p><label for="user_pass">Пароль<br>
					<input class="input" id="password" name="password"size="20"
					type="password" value=""></label></p> 
					<p class="submit"><input class="button" name="login"type= "submit" value="Log In"></p>
					<p class="regtext">Еще не зарегистрированы?<a href= "register.php">Регистрация</a>!</p>
				</form>
			</div>
		</div>
		
		<?php
		session_start();
		?>

		<?php require_once("includes/connection.php"); ?>
		<?php include("includes/header.php"); ?>	 
		<?php

		if(isset($_SESSION["session_username"])){
	// вывод "Session is set"; // в целях проверки
			header("Location: intropage.php");
		}

		if(isset($_POST["login"])){

			if(!empty($_POST['username']) && !empty($_POST['password'])) 
			{
				$username=htmlspecialchars($_POST['username']);
				$password=htmlspecialchars(md5($_POST['password']));
				$query =mysqli_query($con, "SELECT * FROM client WHERE username='".$username."' AND password='".$password."'");
				$numrows=mysqli_num_rows($query);
				if($numrows!=0)
				{
					
					while($row=mysqli_fetch_assoc($query))
					{
						if($row['blackList']==1)
						{
							echo "this account has been blocked!";
							$GLOBALS['ban'] = 1;
						}
						
						$dbusername=$row['username'];
						$dbpassword=$row['password'];
						$bdadmin=$row['admin'];
						$_SESSION['cl_id']=$row['id'];

					}
					if ($GLOBALS['ban']!=1) 
					{
						if($username == $dbusername && $password == $dbpassword && $bdadmin==NULL)
						{
							$_SESSION['session_username']=$username;	 
							/* Перенаправление браузера */
							header("Location: intropage.php");
						}

						elseif ($username == $dbusername && $password == $dbpassword && $bdadmin!=NULL) 
						{
							$_SESSION['session_username']=$username;

							header("Location: main.php");
						}
					}
				} 
				else 
				{
					echo  "Invalid username or password!";
				}
			} 
			else 
			{
				$message = "All fields are required!";
			}
		}
		?>

		<?php include("includes/footer.php"); ?>