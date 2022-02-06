<?php 
session_start();
	include("dbconfig.php");
	include("functions.php");
	
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);
			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);					
					if($user_data['password'] === $password)
					{
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: admin_index.php");
						die;
					}
				}
			}
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<style type="text/css">
	body{
		background-image: url('image.jpg');
		background-repeat: no-repeat;
		background-attachment: fixed;
		background-size:100% 100%;

	}
	#text{
		font-size:1.5rem;
		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}	
	.btn-grad {
		background-image: linear-gradient(to right, #314755 0%, #26a0da  51%, #314755  100%);
        padding: 15px 45px;
	    text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;            
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        display: block;
    }
    .btn-grad:hover {
        background-position: right center; 
        color: #fff;
        text-decoration: none;
    }
	#box{
		margin-top:50px;
		background-image: radial-gradient( circle farthest-corner at 16.5% 28.1%,  rgba(15,27,49,1) 0%, rgba(0,112,218,1) 90% );
		margin: 10%;
		margin-left:35%;
		width: 400px;
		padding: 20px;
		color:white;
		border-radius:12px;
		box-shadow: 5px 10px #888888;
	}
	a{
		color: white;
		text-decoration:none;
	}

	</style>
	
	<div id="box">
				<form method="post">
			<center>
			<div style="font-size: 30px;margin: 10px;color: white;">LOGIN</div>
			<label>Username: </label><br>
			<input id="text" type="text" name="user_name" placeholder ="Enter Username"><br><br>
			<label>Password: </label><br>
			<input id="text" type="password" name="password"placeholder ="Enter password"><br><br>
			<input class="btn-grad" type="submit" value="Login"><br><br>
		    </form>
			<button class="btn-grad " style="padding-bottom= 0" ><a href="../index.php">Home</a><br></button>
            </center>
	</div>

</body>
</html>