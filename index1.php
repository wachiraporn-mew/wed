
<?php 
    require_once('connection.php');

    if (isset($_REQUEST['delete_id'])) {
        $ID_User = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare("SELECT * FROM user WHERE ID_User = :ID_User");
        $select_stmt->bindParam(':ID_User', $ID_User);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        // Delete an original record from db
        $delete_stmt = $db->prepare('DELETE FROM user WHERE ID_User = :ID_User');
        $delete_stmt->bindParam(':ID_User', $ID_User);
        $delete_stmt->execute();

        header('Location:index1.php');
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
    <a href="add1.php" class="btn btn-success mb-3">เพิ่ม</a>
    <a href="index.php" class="btn btn-success mb-3">กลับหน้าหลัก</a>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>name</th>
                <th>address</th>
                <th>number</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php 
                $select_stmt = $db->prepare("SELECT * FROM user");
                $select_stmt->execute();

                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>

                <tr>
                    <td><?php echo $row["ID_User"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["address"]; ?></td>
                    <td><?php echo $row["number"]; ?></td>
                    <td><a href="edit1.php?update_id=<?php echo $row["ID_User"]; ?>" class="btn btn-warning">แก้ไข</a></td>
                    <td><a href="?delete_id=<?php echo $row["ID_User"]; ?>" class="btn btn-danger">ลบ</a></td>
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