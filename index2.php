<?php 
    require_once('connection.php');

    if (isset($_REQUEST['delete_id'])) {
        $ID_dog = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare("SELECT * FROM dog WHERE ID_dog = :ID_dog");
        $select_stmt->bindParam(':ID_dog', $ID_dog);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        // Delete an original record from db
        $delete_stmt = $db->prepare('DELETE FROM dog WHERE ID_dog = :ID_dog');
        $delete_stmt->bindParam(':ID_dog', $ID_dog);
        $delete_stmt->execute();

        header('Location:index2.php');
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
    <a href="add2.php" class="btn btn-success mb-3">เพิ่ม</a>
    <a href="index.php" class="btn btn-success mb-3">กลับหน้าหลัก</a>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>animal name</th>
                <th>weight</th>
                <th>age</th>
                <th>type</th>
                <th>genetic</th>
                <th>name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
        <?php 
                $select_stmt = $db->prepare("SELECT * FROM dog ");
                $select_stmt->execute();

                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>


                <tr>
                    <td><?php echo $row["ID_dog"]; ?></td>
                    <td><?php echo $row["namedog"]; ?></td>
                    <td><?php echo $row["weight"]; ?></td>
                    <td><?php echo $row["age"]; ?></td>
                    <td><?php echo $row["type"]; ?></td>
                    <td><?php echo $row["genetic"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><a href="edit2.php?update_id=<?php echo $row["ID_dog"]; ?>" class="btn btn-warning">Edit</a></td>
                    <td><a href="?delete_id=<?php echo $row["ID_dog"]; ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php } ?>
        </tbody>
    </table>
    </div>
    
    

    <script src="js/slim.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
