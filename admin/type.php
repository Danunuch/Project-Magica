<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<?php include('menu_l.php'); ?>


<?php
require_once('../config/db.php');


if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    $select_stmt = $conn->prepare("SELECT * FROM p_type WHERE t_id = :id");
    $select_stmt->bindParam(':id', $id);
    $select_stmt->execute();
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

    // Delete an original record from db
    $delete_stmt = $conn->prepare('DELETE FROM p_type WHERE t_id = :id');
    $delete_stmt->bindParam(':id', $id);
    $delete_stmt->execute();

    if($delete_stmt){
        echo '<script>alert("ลบข้อมูลเรียบร้อยแล้ว")</script>';
        echo "<meta http-equiv='Refresh' content='0.001; url=type.php'>";
    }
    header('Location:type.php');
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

    .ex {
        display: flex;
        justify-content: flex-end;
    }

    .ta {
        font-size: 16px;
    }

    .btn1{
        background-color: #EFB50E;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: flex ;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        width: 5px;
        height: 20px;
        border-radius: 5px;
        
    }
    .btn1:hover {
        color: white;

    }
    .a .bi .bi-pencil-square {
        width: 10px;
        height: 10px;
    }

    .btn2{
        background-color: #E62B18;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: flex ;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        width: 5px;
        height: 20px;
        border-radius: 5px;
    }
    .btn2:hover {
        color: white;

    }
    
</style>

<body>
    <div class="right_col" role="main">
        <div class="row" style="display: inline-block;">

        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 " style="height: 1024px;">
                <div class="dashboard_graph">

                    <div class="col-md-3">
                        <h3>รายการประเภทสินค้า</h3>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr align="center">

                                <th width="7%">ประเภทสินค้า</th>
                                <th width="2%"></th>
                                <th width="2%"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $select_stmt = $conn->prepare("SELECT * FROM p_type");
                            $select_stmt->execute();

                            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>

                                <tr style="font-size: small" ;>
                                    <td><?php echo $row['t_name']; ?></td>
                                    <td align="center"><a href="type_edit.php?update_id=<?php echo $row["t_id"]; ?>" class="btn1"><i class="bi bi-pencil-square" ></i></a></td>
                                    <td align="center"><a href="?delete_id=<?php echo $row["t_id"]; ?>" onclick="return confirm('ต้องการลบประเภทสินค้านี้ใช่หรือไม่?')" class="btn2"><i class="bi bi-trash"></i> </a></td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>



            </div>
        </div>


    </div>


</body>