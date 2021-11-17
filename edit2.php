<?php 
    require_once('connection.php');

    if (isset($_REQUEST['update_id'])) {
        try {
            $ID_dog = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM dog WHERE ID_dog = :ID_dog");
            $select_stmt->bindParam(':ID_dog', $ID_dog);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['btn_update'])) {
        $namedog_up = $_REQUEST['txt_namedog'];
        $weight_up = $_REQUEST['txt_weight'];
        $age_up = $_REQUEST['txt_age'];
        $type_up = $_REQUEST['txt_type'];
        $genetic_up = $_REQUEST['txt_genetic'];
        $name_up = $_REQUEST['txt_name'];


        if (empty($namedog_up)) {
            $errorMsg = "Please Enter namedog";
        } else if (empty($weight_up)) {
            $errorMsg = "Please Enter weight";
        } else {
            try {
                if (!isset($errorMsg)) {
                    $update_stmt = $db->prepare("UPDATE dog SET namedog = :namedog_up, 	weight = :weight_up, age = :age_up, type = :type_up, genetic = :genetic_up, name = :name_up WHERE ID_dog = :ID_dog");
                    $update_stmt->bindParam(':namedog_up', $namedog_up);
                    $update_stmt->bindParam(':weight_up', $weight_up);
                    $update_stmt->bindParam(':age_up', $age_up);
                    $update_stmt->bindParam(':type_up', $type_up);
                    $update_stmt->bindParam(':genetic_up', $genetic_up);
                    $update_stmt->bindParam(':name_up', $name_up);
                    $update_stmt->bindParam(':ID_dog', $ID_dog);

                    if ($update_stmt->execute()) {
                        $updateMsg = "Record update successfully...";
                        header("refresh:2;index2.php");
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
    <div class="display-3 text-center">แก้ไขข้อมูลสัตว์</div>

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
                    <label for="namedog" class="col-sm-3 control-label">namedog</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_namedog" class="form-control" placeholder="Enter namedog...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="weight" class="col-sm-3 control-label">weight</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_weight" class="form-control" placeholder="Enter weight...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="age" class="col-sm-3 control-label">age</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_age" class="form-control" placeholder="Enter age...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="type" class="col-sm-3 control-label">type</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_type" class="form-control" placeholder="Enter type...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="genetic" class="col-sm-3 control-label">genetic</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_genetic" class="form-control" placeholder="Enter 	genetic...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="name" class="col-sm-3 control-label">name</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_name" class="form-control" placeholder="Enter name...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="index2.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>


    </form>

    <script src="js/slim.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>