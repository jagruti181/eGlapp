<html>
<head>

    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    
    <link rel="stylesheet" type="text/css" href="../lib/css/bootstrap.min.css" />
</head>
<body>


<!--div >error</div>
<div class="row">
    <div class="col-md-3">img width:50px height:50px;</div>
    <div class="col-md-3">input</div>
    <div class="col-md-3">submit</div>
</div-->

<form method="POST" enctype="multipart/form-data">
<?php
if(isset($_POST['reg']))
{
$fname=$_FILES['a']['name'];
$fsize=$_FILES['a']['size'];
$ftype=$_FILES['a']['type'];
$ftmp=$_FILES['a']['tmp_name'];
$randno=rand();
$storage_path="../img/".$_GET['id'].$randno.".jpg";
    ?>
    <div class="row pad">
    <div><center>
    <?php
if(move_uploaded_file($ftmp,$storage_path))
{
//echo "file uploaded";
echo "<img src=".$storage_path." width='250px' height='250'>";
}
}
?>
</center>
</div>
<div><center><input type="file" name="a"/></center></div>
<div><center><input type="submit" class="btn btn-info" name="reg" value="Save Image"/></center></div>
</div>
</form>

</body>
</html>
