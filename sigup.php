<?php
 
 include('connection.php');
 //ตรวจสอบการเข้ารหัสของข้อความ
//  $result = json_decode($_POST["tel"]);
//  if (่json_last_error()=== JSON_ERROR_NONE) {
// 	 $_POST = json_decode(file_get_contents('php://input'), true);
//  }
	
 $name = $_POST['name'];
 $tel = $_POST['tel'];
 $email = $_POST['email'];
 $password = $_POST['password'];

   if ($tel == null) {
	   //พารามิเตอร์ไม่ถูกต้อง
	   $ret = array( "status" => "fail", "Message" => "format error" );
   }else{
	   //เพิ่มข้อมูลเข้าในตาราง
		$mySQL = "INSERT INTO `testfluter`(`name`, `tel`,`email`, `password`) VALUES ('$name','$tel','$email','$password')";
		$result1 = mysqli_query($con, $mySQL);
		if ($result1 === TRUE) {
			//การประมวลผลสำเร็จ
			 $ret = array( "status" => "Success", "message" => "Merber was create" );
		}else{
			//การประมวลผลเกิดข้อผิดพลาด
			$ret = array( "status" => "fail", "message" => "insert merber error" );
		}
   }
   //แสดงผลการดำเนินการ พร้อมเข้ารหัสเจสัน
   echo Json_encode( $ret );
    

  
           
?>