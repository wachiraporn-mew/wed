<?php 
    require_once('connection.php');

    if (isset($_REQUEST['btn_insert'])) {
        $dc = $_REQUEST['txt_dc'];
        $time = $_REQUEST['txt_time'];
        $name = $_REQUEST['txt_name'];
        $symptom = $_REQUEST['txt_symptom'];
        $type = $_REQUEST['txt_type'];
        $status = $_REQUEST['txt_status'];

        if (empty($dc)) {
            $errorMsg = "Please enter dc";
        } else if (empty($time)) {
            $errorMsg = "please Enter time";
        } else {
            try {
                if (!isset($errorMsg)) {
                    $insert_stmt = $db->prepare("INSERT INTO queue(dc, time, name, symptom, type, status) VALUES (:dc, :time, :name , :symptom , :type , :status)");
                    $insert_stmt->bindParam(':dc', $dc);
                    $insert_stmt->bindParam(':time', $time);
                    $insert_stmt->bindParam(':name', $name);
                    $insert_stmt->bindParam(':symptom', $symptom);
                    $insert_stmt->bindParam(':type', $type);
                    $insert_stmt->bindParam(':status', $status);
                    if ($insert_stmt->execute()) {
                        $insertMsg = "Insert Successfully...";
                        header("refresh:2;index3.php");
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
    <title>ข้อมูลการจองคิว</title>

    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>

    <div class="container">
    <p style="font-family:Lulu; font-size:100px; text-align: center;" >ข้อมูลการจองคิว </p>

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
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
                    <a href="index3.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>


    </form>

    <script src="js/slim.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>