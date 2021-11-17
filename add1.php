<?php 
    require_once('connection.php');

    if (isset($_REQUEST['btn_insert'])) {
        $name = $_REQUEST['txt_name'];
        $address = $_REQUEST['txt_address'];
        $number = $_REQUEST['txt_number'];

        if (empty($name)) {
            $errorMsg = "Please enter name";
        } else if (empty($address)) {
            $errorMsg = "please Enter address";
        } else {
            try {
                if (!isset($errorMsg)) {
                    $insert_stmt = $db->prepare("INSERT INTO user(name, address, number) VALUES (:name, :address, :number)");
                    $insert_stmt->bindParam(':name', $name);
                    $insert_stmt->bindParam(':address', $address);
                    $insert_stmt->bindParam(':number', $number);

                    if ($insert_stmt->execute()) {
                        $insertMsg = "Insert Successfully...";
                        header("refresh:2;index1.php");
                    }
                }
            } catch (PDOException $e) {
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
    <title>ข้อมูลผู้ใช้</title>

    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>

    <div class="container">
    <p style="font-family:Lulu; font-size:100px; text-align: center;" >ข้อมูลผู้ใช้</p>

    <?php 
         if (isset($errorMsg)) {
    ?>
        <div class="alert alert-danger">
            <strong>Wrong! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>
    

    <?php 
         if (isset($insertMsg)) {
    ?>
        <div class="alert alert-success">
            <strong>Success! <?php echo $insertMsg; ?></strong>
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
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
                    <a href="index1.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>


    </form>

    <script src="js/slim.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>