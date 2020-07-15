<?php
session_start();
include "connection.php";
?>
<html>
 <head>
 	<link rel="stylesheet" type="text/css" href="style.css">
 <style>
   .error{
    color: red;
   }
 </style>
 </head>
<?php
$idErr = $passErr = "";
$id = $pass = $res = "";
 $db = mysqli_connect('localhost','root','','kartik')
 or die('Error connecting to MySQL server.');
	if(isset($_POST['submit'])){
	if (empty($_POST['pass'])) {
		$passErr="Password can't be Empty";
	}
	if (!empty($_POST['id'])) {
		$id=$_POST['id'];
		$pass=$_POST['pass'];
        $sql_query = "select count(*) as cntUser from login where id='".$id."' and pass='".$pass."'";
		$result = mysqli_query($db,$sql_query);
		$row = mysqli_fetch_array($result);
	    $count = $row['cntUser'];
	    if($count > 0){
            $_POST['id'] = $id;
            $res= "Login Successful";
            header('location:info.php');
        }else{
            $res="Invalid username and password";
        }
}
	else{
		$idErr="ID can not be Empty.";
	}}
?>
 <body>
 	<div class="login-page">
  <div class="form">
    <form class="login-form" method="post">
      <span class="error"><?php echo"*".$res."*";?></span>
      <input type="text" placeholder="username" name="id" value="<?= $id?>" >
    <span class="error"><?php echo"*".$idErr."*";?></span>
      <input type="password" placeholder="password" name="pass" value="<?= $pass?>">
    <span class="error"><?php echo"*".$passErr."*";?></span>      
      <button name="submit">login</button>
    </form>
  </div>
</div>
</body>
</html>