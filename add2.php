<?php 
    require_once('connection.php');

    if (isset($_REQUEST['btn_insert'])) {
        $namedog = $_REQUEST['txt_namedog'];
        $weight = $_REQUEST['txt_weight'];
        $age = $_REQUEST['txt_age'];
        $type = $_REQUEST['txt_type'];
        $genetic = $_REQUEST['txt_genetic'];
        $name = $_REQUEST['txt_name'];

        if (empty($namedog)) {
            $errorMsg = "Please enter namedog";
        } else if (empty($weight)) {
            $errorMsg = "please Enter weight";
        } else {
            try {
                if (!isset($errorMsg)) {
                    $insert_stmt = $db->prepare("INSERT INTO dog(namedog, weight, age, type, genetic, name) VALUES (:namedog, :weight, :age , :type , :genetic , :name)");
                    $insert_stmt->bindParam(':namedog', $namedog);
                    $insert_stmt->bindParam(':weight', $weight);
                    $insert_stmt->bindParam(':age', $age);
                    $insert_stmt->bindParam(':type', $type);
                    $insert_stmt->bindParam(':genetic', $genetic);
                    $insert_stmt->bindParam(':name', $name);
                    if ($insert_stmt->execute()) {
                        $insertMsg = "Insert Successfully...";
                        header("refresh:2;index2.php");
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
    <title>ข้อมูลสัตว์</title>

    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>

    <div class="container">
    <p style="font-family:Lulu; font-size:100px; text-align: center;" >ข้อมูลสัตว์ </p>

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
                        <input type="text" name="txt_genetic" class="form-control" placeholder="Enter genetic...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="name" class="col-sm-3 control-label">name</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_name" class="form-control" placeholder="Enter 	name...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
                    <a href="index2.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>


    </form>

    <script src="js/slim.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>