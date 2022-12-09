<?php include('menu_l.php'); ?>


<?php
require_once('../config/db.php');

if (isset($_GET['update_id'])) {
    try {
        $id = $_GET['update_id'];
        $select_stmt = $conn->prepare("SELECT * FROM p_type WHERE t_id = :t_id");
        $select_stmt->bindParam(':t_id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

if (isset($_POST['btn-update'])) {
    $t_name = $_POST['t_name'];


    if (empty($t_name)) {
        $errorMsg = "กรุณากรอกชื่อประเภทสินค้า";
    } else {
        try {
            if (!isset($errorMsg)) {
                $update_stmt = $conn->prepare("UPDATE p_type SET t_name = :t_name WHERE t_id = :t_id");
                $update_stmt->bindParam(':t_name', $t_name);
                $update_stmt->bindParam(':t_id', $id);

                if ($update_stmt->execute()) {
                    echo '<script>alert("แก้ไขข้อมูลเรียบร้อยแล้ว")</script>';
                    echo "<meta http-equiv='Refresh' content='0.001; url=type.php'>";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>

<style>
    .body {
        font-family: 'Kanit', sans-serif;
    }

    .home-content2 {
        font-size: 20px;
        color: #000;
        width: auto;
        font-weight: bold;
    }

    .title {
        font-size: 14px;

    }

    .h5 {
        font-size: small;
        font-weight: normal;

    }

    .card {
        width: 800px;
        height: auto;
    }
</style>

<body>
    <div class="right_col" role="main">
        <div class="row" style="display: inline-block;"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 " style="height: 1024px;">
                <div class="dashboard_graph">

                    <div class="col-md-6">
                        <h3>แก้ไขรายการประเภทสินค้า</h3>
                    </div>
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
                    <br>
                    <form method="post" class="form-horizontal mt-5">
                        <div class="form-group text-center">

                            <div class="row gx-5">
                                <div class="col" align="left">
                                <div class="p-3 "><label for="p_type" class="col-form-label" style="color: black;">ประเภทสินค้า</label>
                                        <input type="text" name="t_name" class="form-control" value="<?=$row['t_name'] ?>">
                                    </div>


                            <div class="form-group text-center">
                                <div class="col-md-12 mt-3">
                                    <input type="submit" name="btn-update" class="btn btn-success" value="บันทึกข้อมูล"> &nbsp;&nbsp;
                                    <a href="type.php" class="btn btn-danger">ยกเลิก</a>
                                </div>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>