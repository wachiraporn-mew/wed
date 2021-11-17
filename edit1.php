<?php 
    require_once('connection.php');

    if (isset($_REQUEST['update_id'])) {
        try {
            $ID_User = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM user WHERE ID_User = :ID_User");
            $select_stmt->bindParam(':ID_User', $ID_User);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['btn_update'])) {
        $name_up = $_REQUEST['txt_name'];
        $address_up = $_REQUEST['txt_address'];
        $number_up = $_REQUEST['txt_number'];


        if (empty($name_up)) {
            $errorMsg = "Please Enter name";
        } else if (empty($address_up)) {
            $errorMsg = "Please Enter address";
        } else {
            try {
                if (!isset($errorMsg)) {
                    $update_stmt = $db->prepare("UPDATE user SET name = :name_up, address = :address_up, number = :number_up WHERE ID_User = :ID_User");
                    $update_stmt->bindParam(':name_up', $name_up);
                    $update_stmt->bindParam(':address_up', $address_up);
                    $update_stmt->bindParam(':number_up', $number_up);
                    $update_stmt->bindParam(':ID_User', $ID_User);

                    if ($update_stmt->execute()) {
                        $updateMsg = "Record update successfully...";
                        header("refresh:2;index1.php");
                    }
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>

    <div class="container">
    <div class="display-3 text-center">แก้ไขข้อมูลผู้ใช้</div>

    <?php 
         if (isset($errorMsg)) {
    ?>
        <div class="alert alert-danger">
            <strong>Wrong! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>
    

    <?php 
         if (isset($updateMsg)) {
    ?>
        <div class="alert alert-success">
            <strong>Success! <?php echo $updateMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            
            <div class="form-group text-center">
                <div class="row">
                    <label for="name" class="col-sm-3 control-label">name</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_name" class="form-control" placeholder="Enter name...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="address" class="col-sm-3 control-label">address</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_address" class="form-control" placeholder="Enter address...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="number" class="col-sm-3 control-label">number</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_number" class="form-control" placeholder="Enter number...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="index1.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>


    </form>

    <script src="js/slim.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>