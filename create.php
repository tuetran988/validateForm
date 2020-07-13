<?php 
	//nhung  file database vao de su dung bien connection
	 require_once 'database.php';
	 session_start();
	//  se code chuc nag them moi truoc
	//  chua form them moi
	// luu cac thong tin user nhap trong form vao trong bang categories
	// 1- khai bao cac bien chua loi va ket qua
		$error = '';
		$result= '';
     //2- debug cac thong tin lien quan den post va files
     //3 -check neu nguoi dung submit form thi moi xu ly
     if(isset($_POST['submit']))
     {
     	// khai bao bien trung gian de thao tac 
     	$name = $_POST['name'];
     	$description = $_POST['description'];
        $avatar_arr = $_FILES['avatar'];
        //4- validate-form
           //4.1 name va description khong duoc de trong
           //4.2 file upload phai co dang anh va dung luong khong qua 2MB
        if(empty($name)||empty($description))
        {
        	$error ='name or description must not be empty';
        }
        // chi xu ly fileupload neu co file dc tai len 
        // dua vao bien error cua file neu =0 tuc la co tai file len
        else if($avatar_arr['error']==0)
        {
        	//validate file upload phai co dang anh
        	//lay ra duoi file
        	$extension = pathinfo($avatar_arr['name'],PATHINFO_EXTENSION);
        	// truyen duoi file ve ky tu thuong
        	$extension = strtolower($extension);
        	// tao ra 1 mang co cac duoi file hople
        	$extension_allowed =['jpg','png','gif','jpeg'];
        	//lay ra dung luong file upload
        	//1MB= 1024KB = 1024x1024 B
        	$file_size_mb = $avatar_arr['size']/1024/1024;
        	$file_size_mb = round($file_size_mb,2); //giu lai 2 so thap phan sau dau ,


        	if(!in_array($extension,$extension_allowed))
        	{
        		$error = 'can upload file dang anh';
        	}else if($file_size_mb>2)
        	{
        		$error ='file upload khong duoc vuot qua 2mb';
        	}
        }

        if(empty($error))
        {
        	$avatar='';
        	if($avatar_arr['error'] == 0){
        		// tao thu muc chua file upload len
        		//tao thu muc co ten bbang uploads ngang hang voi file hien tai
        		$dir_uploads='uploads';
        	   // tao thu muc khi thu muc chua ton tai
        		if(!file_exists($dir_uploads)){
        			mkdir($dir_uploads);
        		} // tao ra chi 1 file tranh truong hop bi de file khi user upload cung 1 file len he thong nhieu lan
        		$avatar = time().'-'.$avatar_arr['name'];
        		// upload file tu thu muc tam cua xampp vao trong uploads ban da tao ra 
        		move_uploaded_file($avatar_arr['tmp_name'],$dir_uploads.'/'.$avatar);
        	}

        	//1- tao cau truy van 

        		$sql_insert ="INSERT INTO categories(`name`,`description`,`avatar`) VALUES('$name','$description','$avatar')";

        	//thuc thi truy van- voi kieu truy van insert, update, delete thi ham mysqli luon tra ve gia tri true/false
        		$is_insert = mysqli_query($conn,$sql_insert);

        		// var_dump($is_insert);
        		if($is_insert)
        		{
        			$_SESSION['success']="insert success";
        			header('Location:index.php');
        			exit();
        		}
        		else{
        			$error ='insert false';
        		}



        }


     } 
    
 ?>
	<h3><?php echo $error; ?></h3>
 <form action="" method="post" enctype="multipart/form-data">
 		
 		<label for="">Name:</label>
 		<input type="text" name="name" value="">
 		<br>
 		<label for="">Description:</label>
		<textarea name="description" cols="20"></textarea>
		<br>
		<label for="">Avatar</label>
		<input type="file" name="avatar">
		<br>
		<input type="submit" value="Save" name="submit">
		<a href="index.php">Cancel</a>

 </form>