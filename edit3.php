<?php 
    require_once('connection.php');

    if (isset($_REQUEST['update_id'])) {
        try {
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM queue WHERE id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['btn_update'])) {
        $dc = $_REQUEST['txt_dc'];
        $time = $_REQUEST['txt_time'];
        $name = $_REQUEST['txt_name'];
        $symptom = $_REQUEST['txt_symptom'];
        $type = $_REQUEST['txt_type'];
        $status = $_REQUEST['txt_status'];
        
        if (empty($dc_up)) {
            $errorMsg = "Please Enter dc";
        } else if (empty($time_up)) {
            $errorMsg = "Please Enter time";
        } else {
            try {
                if (!isset($errorMsg)) {
                    $update_stmt = $db->prepare("UPDATE queue SET dc = :dc_up, time = :time_up, name = :name_up WHERE id = :id");
                    $update_stmt->bindParam(':dc_up', $dc_up);
                    $update_stmt->bindParam(':time_up', $time_up);
                    $update_stmt->bindParam(':name_up', $name_up);
                    $update_stmt->bindParam(':id', $id);

                    if ($update_stmt->execute()) {
                        $updateMsg = "Record update successfully...";
                        header("refresh:2;index3.php");
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
    <div class="display-3 text-center">แก้การจองคิว</div>

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
                    <label for="dc" class="col-sm-3 control-label">date</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_dc" class="form-control" placeholder="Enter dc...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="time" class="col-sm-3 control-label">time</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_time" class="form-control" placeholder="Enter time...">
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
                <div class="row">
                    <label for="symptom" class="col-sm-3 control-label">symptom</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_symptom" class="form-control" placeholder="Enter symptom...">
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
                    <label for="status" class="col-sm-3 control-label">status</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_status" class="form-control" placeholder="Enter 	status...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="index3.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>


    </form>

    <script src="js/slim.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>