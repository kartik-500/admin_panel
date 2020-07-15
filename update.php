<?php
session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Form</title>
</head>
<?php 
$id=$_GET['id'];
$query="SELECT * FROM info WHERE id='".$id."'";
$result = $db->query($query);
$followingdata = $result->fetch_assoc();
$title=$followingdata['title'];
$description=$followingdata['description'];
$Category=$followingdata['category'];
$keywords=$followingdata['keywords'];
?>
<body>
<form method="post" action="" enctype="multipart/form-data">
<div class="outline">
<div class="r1">
  <h4><i class="fa fa-id-badge" style="font-size:24px">  </i> Add Info</h4><br>
  <div class="r2">Title:-
   <input type="text" name="title" placeholder="Enter your title" class="form-control" value="<?= $title?>">
  </div>
  <div class="form-group">  Description :-
      <textarea class="form-control" name="description" placeholder="Enter Description"><?php echo"$description";?></textarea>
    </div>
      <div class="form-group">Select Category :-
      <select name="Category" class="form-control" value="<?= $category?>">
        <option value="OPEN" selected>OPEN</option>
        <option value="OBC">OBC</option>
        <option value="NT">NT</option>
        <option value="OTHER">SC/ST</option>
      </select>
  </div>
    <br>
    <input type="file" name="image" id="image">
    <br>Keywords:-
  <input type="text" name="keywords" placeholder="Enter Keywords" class="form-control" value="<?= $keywords?>"><br>
    <input type="submit" name="submit" value="UPDATE">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <?php 
  if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $Category=$_POST['Category'];
    $keywords=$_POST['keywords'];
    $image = $_FILES['image']['name'];
    $file = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $sql = "UPDATE info SET title='".$title."',description='".$description."',category='".$Category."',keywords='".$keywords."',image='".$file."' WHERE id='".$id."'";
    $res1=mysqli_query($db,$sql);
    header('location:info.php');
  }
  ?>
<hr>
</div>