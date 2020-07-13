<?php 
	require_once'database.php';
	session_start();
	// luon phai xu ly du lieu tu url  vi user hoan toan co the sua duoc
	if(!isset($_GET['id'])||!is_numeric($_GET['id']))  // neu id  ko ton tai hoac id ko phai la so thi bao loi
	{
		$_SESSION['error'] ="ID ko hop le";
		header('Location:index.php');
		exit();
	}

	$id = $_GET['id'];
	// thuc hien truy van xoa ban ghi theo id bat duoc tu url;
	//-tao truy van xoa
	$sql_delete = "DELETE FROM categories WHERE id = '$id'";

	// thuc hien truy van xoa
	$is_delete = mysqli_query($conn,$sql_delete);
	if($is_delete)
	{
		$_SESSION['success'] ="xoa thanh cong";		
	}
	else{
		$_SESSION['error'] ="xoa khong thanh cong";
	}
	header("Location:index.php");
	exit();
 ?>