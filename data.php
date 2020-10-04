<?php 
session_start();

$host='localhost';
$user='root';
$password="";
$db='todolist';

$info="";
$id=0;
$type=0;
$update= false;	

$mysqli=new mysqli($host,$user,$password,$db) or die(mysql_error($mysqli));


if(isset($_POST["add"])){
	$info=$_POST['list'];
	$type=0;
	$mysqli->query("INSERT INTO listtable(info) VALUES ('$info')") or die($mysqli->error());

	$_SESSION['message']="Added to the List";
	$_SESSION['msg_type']="success";

	header("location: index.php");
	
}

if(isset($_GET["delete"])){
	$id=$_GET['delete'];
	
	$mysqli->query("DELETE FROM listtable WHERE id=$id") or die($mysqli->error());

	$_SESSION['message']="Deleted from the List!!";
	$_SESSION['msg_type']="danger";

	header("location: index.php");
}

if(isset($_GET['edit'])){
	$id=$_GET['edit'];
	$update=true;
	$result=$mysqli->query("SELECT * FROM listtable WHERE id=$id") or die($mysqli->error());

	if($result->num_rows){
  	$row = $result->fetch_array();
		$info=$row['info'];
	}

}
if(isset($_POST['update'])){
	$id=$_POST['id'];
	$info=$_POST['list'];

	$result=$mysqli->query("UPDATE listtable SET info='$info' WHERE id=$id") or die($mysqli->error());

	$_SESSION['message']="Updated Successfully!";
	$_SESSION['msg_type']="success";

	header("location: index.php");
}
if(isset($_GET['favourite'])){
	$id=$_GET['favourite'];
	$type=1;
	$result=$mysqli->query("UPDATE listtable SET type='$type' WHERE id=$id") or die($mysqli->error());

	$_SESSION['message']="Added to the Favourites!";
	$_SESSION['msg_type']="success";

	header("location: index.php");
}
if(isset($_GET['notfavourite'])){
	$id=$_GET['notfavourite'];
	$type=0;
	$result=$mysqli->query("UPDATE listtable SET type='$type' WHERE id=$id") or die($mysqli->error());

	$_SESSION['message']="Removed from Favourites!";
	$_SESSION['msg_type']="danger";

	header("location: index.php");
}

?>