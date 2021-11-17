
<?php 
    require_once('connection.php');

    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare("SELECT * FROM queue WHERE id = :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        // Delete an original record from db
        $delete_stmt = $db->prepare('DELETE FROM queue WHERE id = :id');
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();

        header('Location:index3.php');
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
    <a href="add3.php" class="btn btn-success mb-3">เพิ่ม</a>
    <a href="index.php" class="btn btn-success mb-3">กลับหน้าหลัก</a>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>data</th>
                <th>time</th>
                <th>name</th>
                <th>symptom</th>
                <th>type</th>
                <th>status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php 
                $select_stmt = $db->prepare("SELECT * FROM queue");
                $select_stmt->execute();

                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>

                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["dc"]; ?></td>
                    <td><?php echo $row["time"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["symptom"]; ?></td>
                    <td><?php echo $row["type"]; ?></td>
                    <td><?php echo $row["status"]; ?></td>
                    <td><a href="edit3.php?update_id=<?php echo $row["id"]; ?>" class="btn btn-warning">แก้ไข</a></td>
                    <td><a href="?delete_id=<?php echo $row["id"]; ?>" class="btn btn-danger">ลบ</a></td>
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