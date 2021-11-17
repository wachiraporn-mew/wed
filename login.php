
<?php
 
 include('condb.php');
 //ตรวจสอบการเข้ารหัสของข้อความ
//  $result = json_decode($_POST["tel"]);
//  if (่json_last_error()=== JSON_ERROR_NONE) {
// 	 $_POST = json_decode(file_get_contents('php://input'), true);
//  }
	
 $email = $_POST['email'];
 $password = $_POST['password'];

   if ($tel == null) {
	   //พารามิเตอร์ไม่ถูกต้อง
	   $ret = array( "status" => "fail", "Message" => "format error" );
   }else{
	   //เพิ่มข้อมูลเข้าในตาราง
		 $query = "SELECT * FROM testfluter WHERE tel = '$email' AND password = '$password' ";
  		$result = mysqli_query($con, $query);
		if ($result->num_rows >0) {
			while($row = $result->fetch_assoc()) {
			

			// printf($per);
			$ret = $row;
		}
			//การประมวลผลสำเร็จ
			 $ret = array( "status" => "success","Message" => $ret );
		}else{
			//การประมวลผลเกิดข้อผิดพลาด
			$ret = array( "status" => "fail", "message" => "insert merber error" );
		}
   }
   //แสดงผลการดำเนินการ พร้อมเข้ารหัสเจสัน
   echo Json_encode( $ret );
    
 
//  include('condb.php');
	
//  $email = $_POST['email'];
//  $password = $_POST['password'];

   
    
//     $query = "SELECT * FROM testfluter WHERE tel = '$tel' AND password = '$password' ";

//   $result = mysqli_query($con, $query);
//   if ($result->num_rows >0){
// 		while($row = $result->fetch_assoc()) {
			

// 			// printf($per);
// 			$ret = $row;
// 		}
// 			echo json_encode(array(  "status" => "success","Message" => $ret));
// 	}else{
//     $ret = array( "status" => "fail", "Message" => "Machine not found." );
// 		// $ret = array( "status" => "fail", "Message" => array() );
// 			return json_encode($ret);
// 	}
  
           
?>