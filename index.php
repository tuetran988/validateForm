<?php 
	session_start();
	//truy van csdl de lay ra toan bo ban ghi trong bang categories
	require_once'database.php';
	// viet truy van lay du lieu 
	$sql_select_all ="SELECT * FROM categories";
	// thuc thi truy van vua tao , voi truy van select thi ham mysqli tra ve 1 doi tuong trung gian chu ko phai true
	//false
	$result_all = mysqli_query($conn,$sql_select_all);
	// lay ra mang du lieu categories;
	$categories = mysqli_fetch_all($result_all,MYSQLI_ASSOC);
	// echo "<pre>";
	// print_r($categories);
	// echo "</pre>";
 ?>


 <a href="create.php">Them-Moi</a>
 <?php 
 		if(isset($_SESSION['success']))
 		{
 			echo $_SESSION['success'];
 			unset($_SESSION['success']);
 		}
 		if(isset($_SESSION['error']))
 		{
 			echo $_SESSION['error'];
 			unset($_SESSION['error']);
 		}
  ?>
 <table border="1" cellspacing="0" cellpadding="8">
 	 <tr>
 	 	<th>ID</th>
 	 	<th>Name</th>
 	 	<th>Description</th>
 	 	<th>Avatar</th>
 	 	<th>Created_At</th>
 	 	<th>action</th>
 	 </tr>
 	 <?php 
 	 	foreach ($categories AS $category){
 	  ?>
 	 <tr>
 	 	<td><?php echo $category['id'] ?></td>
 	 	<td><?php echo $category['name'] ?></td>
 	 	<td><?php echo $category['description'] ?></td>
 	 	<td><img src="uploads/<?php echo $category['avatar']?> "style ="width:20px;height:20px;"></td>
 	 	<td><?php echo date('d-m-Y H:i:s',strtotime($category['create_at']))?></td>
 	 	<?php 
 	 		$url_detail = "detail.php?id=".$category['id'];
 	 		$url_update = "update.php?id=".$category['id'];
 	 		$url_delete = "delete.php?id=".$category['id'];
 	 	 ?>
 	 	<td>
 	 		<a href="<?php echo  $url_detail;?>">xem chi tiet</a>
 	 		<a href="<?php echo  $url_update;?>">sua</a>
 	 		<a href="<?php echo  $url_delete;?>" onclick = "return confirm('are you delete?')" > xoa </a>
 	 	</td>
 	 </tr>
 	<?php } ?>
 </table>