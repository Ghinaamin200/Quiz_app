<!DOCTYPE html>
<html lang="en">
<?php require 'dbconfig.php';
session_start(); ?>
<head>
<title>Online Quiz Panel</title>
<style>
body {
  background: url("img3.png");
	background-size:100%;
	background-repeat: no-repeat;
	position: relative;
	background-attachment: fixed;
}
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #0093E9;
  background-image: linear-gradient(346deg, #0093E9 0%, #80D0C7 100%);
  border: 2px solid #2376DD;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 20px;
  width: 500px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}
a{
  text-decoration:none;
  color: white;
}
.button span {

  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}
.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}
.button:hover span {
  padding-right: 25px;
}
.button:hover span:after {
  opacity: 1;
  right: 0;
}
.title{
	background: #525252;
  background: -webkit-linear-gradient(to right, #3d72b4, #525252);  
  background: linear-gradient(to right, #3d72b4, #525252); 
	font-size: 2.5rem;
  padding: 20px;
  color: white;
  font-weight: bold;
  border: 6px solid #a8dadc;	
}
.button3 {
    border: none;
    color: white;
    padding: 10px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;
    cursor: pointer;
}
.button3 {
    background-image: linear-gradient( 135deg, #52E5E7 10%, #130CB7 100%);
    color: black; 
    border: 2px solid #3813C2;
}
.button3:hover {
     background-image: linear-gradient( 135deg, #97ABFF 10%, #123597 100%);
    color: Black;
}
</style>
</head>
<body><center>
<div class="title">Online Quiz Panel</div><br><br><br>
<button class="button  btn-grad" name="admin" float="left"><a href="admin/login.php" id ="link"><span>Admin Login</span></a></button> <br><br>
<?php 						
  $queryy = "select * from quiz";
  $resultt = mysqli_query($con, $queryy);
  $rowss = mysqli_num_rows($resultt);;									
	if (isset($_POST['click']) || isset($_GET['start'])) {
    @$_SESSION['clicks'] += 1 ;
    $c = $_SESSION['clicks'];
	if(isset($_POST['userans'])) { $userselected = $_POST['userans'];														
	    $fetchqry2 = "UPDATE `quiz` SET `userans`='$userselected' WHERE `id`=$c-1"; 
	    $result2 = mysqli_query($con,$fetchqry2);
	}
	} else {
		$_SESSION['clicks'] = 0;
	}
?>
<div class="bump"><br>
<form>
<?php 
if($_SESSION['clicks']==0){ 
?>
    
    <button class="button btn-grad" name="start" float="left"><span>START QUIZ</span></button> <br>
    <br>
<?php 
} 
?>
</form>
</div>
<form action="" method="post">  				
<table>
<?php 
    if(isset($c)) {   $fetchqry = "SELECT * FROM `quiz` where id='$c'";
      $result=mysqli_query($con,$fetchqry);
		  $num=mysqli_num_rows($result);
		  $row = mysqli_fetch_array($result,MYSQLI_ASSOC); }
?>
<tr><td><h3><br><?php echo @$row['que'];?></h3></td></tr> 
<?php 
    if($_SESSION['clicks'] > 0 && $_SESSION['clicks'] <= $rowss){ 
?>
  <tr><td><input required type="radio" name="userans" value="<?php echo $row['option_1'];?>">&nbsp;<?php echo $row['option_1']; ?><br>
  <tr><td><input required type="radio" name="userans" value="<?php echo $row['option_2'];?>">&nbsp;<?php echo $row['option_2'];?></td></tr>
  <tr><td><input required type="radio" name="userans" value="<?php echo $row['option_3'];?>">&nbsp;<?php echo $row['option_3']; ?></td></tr>
  <tr><td><input required type="radio" name="userans" value="<?php echo $row['option_4'];?>">&nbsp;<?php echo $row['option_4']; ?><br><br><br></td></tr>
  <tr><td><button class="button3" name="click" >Next</button></td></tr>
<?php 
  }  
?> 
  <form>
 <?php 
 if($_SESSION['clicks']>$rowss){ 
	$qry3 = "SELECT `ans`, `userans` FROM `quiz`;";
	$result3 = mysqli_query($con,$qry3);
	$storeArray = Array();
	while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
     if($row3['ans']==$row3['userans']){
		 @$_SESSION['score'] += 1 ;
	 }
}
 
 ?> 
 <h2>Result</h2>
 <span>Total Number of Questions:&nbsp;<?php echo $rowss.'<br>';?></span>
 <span>No. of Correct Answer:&nbsp;<?php echo $no = @$_SESSION['score']; 
 session_unset(); ?></><br>
 <span>Your Score:&nbsp;<?php echo nl2br($no*2); ?></span>
<?php } ?>
</center>
</body>
</html>