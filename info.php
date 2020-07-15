<?php 
session_start();
include "connection.php";
?>
<?php
$id=@$_GET['id'];
$query="DELETE FROM `info` WHERE id='".$id."'";//Delete Query coming from line no. 109
$result = $db->query($query);
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style1.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body><!-- Insert into database -->
<form method="post" action="" enctype="multipart/form-data">
<div class="outline">
<div class="r1">
  <h4><i class="fa fa-id-badge" style="font-size:24px">  </i> Add Info</h4><br>
  <div class="r2">Title:-
   <input type="text" name="title" placeholder="Enter your title" class="form-control">
  </div>
  <div class="form-group">  Description :-
      <textarea class="form-control" name="description" placeholder="Enter Description"></textarea>
    </div>
      <div class="form-group">Select Category :-
      <select name="Category" class="form-control">
        <option value="OPEN" selected>OPEN</option>
        <option value="OBC">OBC</option>
        <option value="NT">NT</option>
        <option value="OTHER">SC/ST</option>
      </select>
  </div>
    <br>
    <input type="file" name="image" id="image">
    <br>Keywords:-
  <input type="text" name="keywords" placeholder="Enter Keywords" class="form-control"><br>
    <input type="submit" name="submit" value="INSERT">
    <center><input type="submit" name="logout" value="logout"></center><!-- Destroy the session -->
  </div>
  <?php 
  @$Name=@$_FILES['image']['name'];
  if($Name!=''){
  if(isset($_POST['submit'])){//actual name of uploaded file
$Type=$_FILES['image']['type'];
  if (preg_match("/.(gif|jpg|png|jpeg|svg)$/i", $Name)){
  if(@$_POST['submit']=="INSERT"){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $Category=$_POST['Category'];
    $image = $_FILES['image']['name'];
    $file = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $keywords=$_POST['keywords'];//Taking required inputs from user & applying insert query
    $sql = "INSERT INTO `info`(`title`, `description`, `Category`, `image`,`keywords`) VALUES ('".$title."','".$description."','".$Category."','".$file."','".$keywords."')";
    @$res1=mysqli_query($db,$sql);
    header( "refresh:50;url=info.php" );//refreshing the page
  }
  }
  else{
        echo "file doesn't have correct format<br>It's ".$Type;
  }
}
}else{
  echo "* Image is needed.";
}
  if(isset($_POST['logout'])){
    session_destroy();//logout button
    header( 'location:login.php' );
  }
  ?>
</div>  <br>
<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Show Info</button>
  <div id="demo" class="collapse">
    <hr><!-- Displaying all database information -->
  <div class="row">
                  <div class="col-xs-12">
                    <div class="clearfix">
                      <div class="pull-right tableTools-container"></div>
                    </div>
                    <div>
                      <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th class="center">Sr. No</th>
        <th class="center">Title</th>
        <th class="center">Description</th>
        <th class="center">Category</th>
        <th class="center">Image</th>
        <th class="center">Keywords</th>
        <th class="center"></th>
        <th hidden="true"></th>
      </tr>
    </thead>
    <tbody>
      <?php
$title = $description = $Category = $image = $keywords = "";
$query="SELECT * FROM `info` WHERE 1 ";//taking out all enteries from db
@$res=mysqli_query($db,$query);
  $a=1;
  if(mysqli_num_rows($res)>0)
  {
        while($row=mysqli_fetch_row($res))//showing result sequentially
    {
      $id=$row[0];
      $title=$row[1];
      $description=$row[2];   
      $Category=$row[5]; 
      $keywords=$row[4];
      $i=1;
    ?>
            <tr>  
            <td class="center" ><?php echo $id; ?></td> <!-- Displaying information in tabular format -->
            <td class="center" ><?php echo $title; ?></td>  
            <td class="center" ><?php echo $description; ?></td> 
            <td class="center" ><?php echo $Category; ?></td> 
            <td class="center" ><?php echo $keywords; ?></td>  
            <td class="center"><?php echo'<img src="data:image/jpeg;base64,'.base64_encode($row[3] ).'" height="100" class="img-thumnail" />  ' ?></td>
            <td class="center"><div class="hidden-sm hidden-xs action-buttons">
                  <a href="update.php?id=<?php echo $row[0]; ?>"><i class="ace-icon fa fa-pencil bigger-130"> Update | </i></a><!-- Update Button -->
                  <a href="info.php?id=<?php echo $row[0]; ?>"><i class="ace-icon fa fa-pencil bigger-130">  Delete</i></a><!-- Delete Button -->
                </div>
      </td>
        <td hidden="true"></td>
        </tr>
        <?php
    $a++;
    $i++;
    }
  }
    ?>
    </tbody>
  </table>  
</div>
</form>
</body>
</html>