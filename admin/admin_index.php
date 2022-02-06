<?php 
session_start();
	include("dbconfig.php");
	include("functions.php");
	$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin side</title>
	<style>
	@import url('https://fonts.googleapis.com/css2?family=Acme&display=swap');
	</style>
	<style>
	body {
    background-color:#52b69a;
	background-image: radial-gradient( circle farthest-corner at 16.5% 28.1%,  rgba(15,27,49,1) 0%, rgba(0,112,218,1) 90% );
	color:white;
	}
	.container{
		display:flex;
		flex-direction: row;
		margin: 0;
		background-color: #1d3557;
		border: 6px solid #a8dadc;
		padding:0;
	}
	.title{
	font-size: 32px;
	padding-top:20px;
	padding-bottom:0px;
  	padding-left: 41%;
	padding-right:30%;
  	color: white;
  	font-weight: bold;	
	margin: 0;
	}
	.button-container{
		display: flex;
		flex-direction: row;
		justify-content:center;
	}
	button {
	color:white;
	background-color: #1e6091;
  	text-align: center;
  	padding: 10px;
  	width: 150px;
  	transition: all 0.5s;
  	cursor: pointer;
  	margin: 20px;
	border:none;
	background-image: linear-gradient(to right, #314755 0%, #26a0da  51%, #314755  100%);
    padding: 15px 45px;
	text-align: center;
    text-transform: uppercase;
    transition: 0.5s;
    background-size: 200% auto;       
    box-shadow: 0 0 20px #eee;
    border-radius: 10px;
    display: block;
	}
	legend{
		font-weight:bolder;
		font-size:38px;
	}
	a{
  	text-decoration:none;
	color:white;
	}
	table {
		font-family: 'Acme', sans-serif;
  		border-collapse: collapse;
  		width: 100%;
	}
	td{
  		border: 2px solid #edf6f9;
  		text-align: center;
  		padding: 8px;
	}
	tr:nth-child(even) {
  		background-color: #023e8a;
	}
	tr:nth-child(odd) {
  		background-color: #003049;
	}
    button:hover {
        background-position: right center; 
        color: #fff;
        text-decoration: none;
    }
	fieldset{
		text-align: center;
		border:3px solid white;
	}
	input{
		width:95%;
		font-size:24px;
		margin: 10px;
		font-family: 'Acme', sans-serif;
	}
	</style>

</head>
<body>
	<div class="container">
	<div class="title">Admin Panel</div><br>
	<button class="button"><a href="logout.php"><img src="../icon1.png" alt="" width="35px" height="25px">Logout</a></button>
	</div>
	<center><br>
	<h1>Hi, <?php echo $user_data['user_name']; ?></h1>
	</center>
	<br>
	<div class="button-container">
		<div class="btn-grad">
			<button><a href="#display">Display</a></button>
		</div>
		<div class="btn-grad">
			<button><a href="#insert">Insert</a></button>
		</div>
		<div class="btn-grad">
			<button><a href="#update">Update</a></button>
		</div>
		<div class="btn-grad">
			<button><a href="#delete">Delete</a></button>
		</div>
	</div>


	<!--Display qustion from quiz table-->
	<fieldset id="display"><legend> Display: </legend>
	<form  method ="POST">
        <button name="display">Display</button><br>
    </form>
	<?php
		if(array_key_exists('display', $_POST)){
			$query = "SELECT * from quiz";
    	$run = mysqli_query($con,$query);
	?>
	<table>
		<tr>
			<th>ID</th>
			<th>Question</th>
			<th>Option 1</th>
			<th>Option 2</th>
			<th>Option 3</th>
			<th>Option 4</th>
			<th>Answer </th>
		</tr>
	<?php
    	while($row=mysqli_fetch_assoc($run)){
			echo "<tr>";
			echo "<td>" .$row['id']. "</td>";
        	echo "<td>" .$row['que']. "</td>";
        	echo "<td>" .$row['option_1']. "</td>";
			echo "<td>" .$row['option_2']. "</td>";
			echo "<td>" .$row['option_3']. "</td>";
			echo "<td>" .$row['option_4']. "</td>";
        	echo "<td>" .$row['ans']. "</td>";
			echo "</tr>";
    	}
	}
	?>
	</table>
	</fieldset>


	<!--Insert questions in quiz table-->
	<fieldset id="insert"><legend> Insert: </legend>
	<form  method ="POST">
	<table>
	<tr>
		<td>Question:</td>
		<td><input type="text" name="question" placeholder="Enter Question"></td>
	</tr>
	<tr>
		<td>Option-1:</td>
		<td><input type="text" name="option1" placeholder="Enter Option 1"></td>
	</tr>
	<tr>
		<td>Option-2:</td>
		<td><input type="text" name="option2" placeholder="Enter Option 2"></td>
	</tr>
	<tr>
		<td>Option-3:</td>
		<td><input type="text" name="option3" placeholder="Enter Option 3"></td>
	</tr>
	<tr>
		<td>Option-4:</td>
		<td><input type="text" name="option4" placeholder="Enter Option 4"></td>
	</tr>
	<tr>
		<td>Answer:</td>
		<td><input type="text" name="answer" placeholder="Enter Answer"></td>
	</tr>
	</table>
        <button name="insert">Insert</button>
    </form>
	</fieldset>

	<!--Update qustion in quiz table-->
	<fieldset id="update"><legend> Update: </legend>
	<form  method ="POST">
    <table>
	<tr>
		<td>Question ID:</td>
		<td><input type="text" name="id" placeholder="Enter Question"></td>
	</tr>
	<tr>
		<td>Question:</td>
		<td><input type="text" name="question" placeholder="Enter Question"></td>
	</tr>
	<tr>
		<td>Option-1:</td>
		<td><input type="text" name="option1" placeholder="Enter Option 1"></td>
	</tr>
	<tr>
		<td>Option-2:</td>
		<td><input type="text" name="option2" placeholder="Enter Option 2"></td>
	</tr>
	<tr>
		<td>Option-3:</td>
		<td><input type="text" name="option3" placeholder="Enter Option 3"></td>
	</tr>
	<tr>
		<td>Option-4:</td>
		<td><input type="text" name="option4" placeholder="Enter Option 4"></td>
	</tr>
	<tr>
		<td>Answer:</td>
		<td><input type="text" name="answer" placeholder="Enter Answer"></td>
	</tr>
	</table>
        <button name="Update">Update</button><br>
    </form>
	</fieldset>

	<!--Delete qustion from quiz table-->
	<fieldset id="delete"><legend> Delete: </legend>
	<form  method ="POST">
	<table>
	<tr>
		<td>Question ID:</td>
		<td><input type="text" name="id" placeholder="Enter Question ID"></td>
	</tr>
	</table>
        <button name="delete">Delete</button><br>
    </form>
	</fieldset>

	
	<?php
    if(array_key_exists('insert', $_POST)) {
		$question =$_POST['question'];
    	$option1 = $_POST['option1'];
    	$option2 = $_POST['option2'];
    	$option3 = $_POST['option3'];
    	$option4 = $_POST['option4'];
    	$answer = $_POST['answer'];
    	$query = "INSERT INTO quiz(que,option_1,option_2,option_3,option_4,ans) VALUES
		('$question','$option1','$option2','$option3','$option4','$answer')";
    		$run = mysqli_query($con,$query);
    	if(!$run){
        	echo "Data not Inserted!";
    	}
    }
	if(array_key_exists('Update', $_POST)) {
		$id =$_POST['id'];
		$question =$_POST['question'];
    	$option1 = $_POST['option1'];
    	$option2 = $_POST['option2'];
    	$option3 = $_POST['option3'];
    	$option4 = $_POST['option4'];
    	$answer = $_POST['answer'];
    $query1 = "SELECT * from quiz WHERE id= '$id' ";
    $run = mysqli_query($con,$query1);
    while($row = mysqli_fetch_assoc($run)){
        $a = $row['id'];
    }
    if (isset($a)){
        echo "ID exists in Database!";
        $query2 = "UPDATE quiz SET que ='$question',option_1 ='$option1',
		option_2='$option2',option_3='$option3',option_4='$option4',
		ans='$answer' WHERE id ='$id'";
        $r = mysqli_query($con,$query2);
        if($r){
            echo "<br> Data Updated Successfully!";
        }else{
            echo "Something went wrong,Try Again!!";
        }
    }else{
        echo "ID doesnot exists in Database!";
    }
	}
	if(array_key_exists('delete', $_POST)) {
		$id = $_POST['id'];
		$query1 = "SELECT * from quiz where id ='$id' ";
		$run = mysqli_query($con,$query1);
		while($row = mysqli_fetch_assoc($run)){
			$a = $row['id'];
		}
		if (isset($a)){
			$query2 = "DELETE from quiz WHERE id ='$id'";
			$run1 = mysqli_query($con,$query2);
				if($run1){
             	echo "Data has been deleted!";
         	}
     	}else{
         	echo "No data found!";
     	}
	}
	?>



</body>
</html>