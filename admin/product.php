<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm">
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>


<?php
require_once('../config/db.php');
include('menu_l.php');
error_reporting(0);
$page = $_GET['page'];
$select_count = $conn->prepare("SELECT * FROM product");
$select_count->execute();
$row_count = $select_count->fetchAll();
$rows = 10;

if ($page == "") {
    $page = 1;
}
$total_data = count($row_count);
$total_page = ceil($total_data / $rows);
$start = ($page - 1) * $rows;

$select_stmt = $conn->prepare("SELECT * FROM product ORDER BY p_id DESC LIMIT $start,10");
$select_stmt->execute();
$row_info = $select_stmt->fetchAll();
$row = $row_info;

if (isset($_REQUEST['delete_id'])) {
    $id = $_REQUEST['delete_id'];

    $stmt = $conn->prepare("SELECT * FROM product WHERE p_id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Delete an original record from db
    $stmt = $conn->prepare('DELETE FROM product WHERE p_id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if ($stmt) {
        echo "<script>alert('ลบสินค้าเรียบร้อยแล้ว')</script>";
        echo "<meta http-equiv='Refresh' content='0.001; url=product.php'>";
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

    .ex {
        display: flex;
        justify-content: flex-end;
    }

    .ta {
        font-size: 16px;
    }

    .btn1 {
        background-color: #EFB50E;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        width: 5px;
        height: 20px;
        border-radius: 5px;

    }

    .btn1:hover {
        background-color: #CD9F00;
        color: white;

    }

    .a .bi .bi-pencil-square {
        width: 10px;
        height: 10px;
    }

    .btn2 {
        background-color: #E62B18;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        width: 5px;
        height: 20px;
        border-radius: 5px;
    }

    .btn2:hover {
        background-color: #A01E09;
        color: white;
    }

    .page-item.active .page-link {
        color: #FFFFFF;
        background: #2A3F54;
        border: none;
    }
</style>


<body>
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 " style="height: 1024px;">
                <div class="dashboard_graph">
                    <div class="row x_title">
                        <div class="col-md-6">
                            <h3>รายการสินค้าลูกค้าทั่วไป</h3>
                        </div> <br>
                        <div class="dashboard_graph">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <br>
                                        <tr align="center">
                                            <th width="5%">รูป</th>
                                            <th width="9%">ชื่อสินค้า</th>
                                            <th width="8%">รายละเอียด/จำนวน</th>
                                            <th width="5%">ราคา (บาท)</th>
                                            <th width="3%"></th>
                                            <th width="3%"></th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php
                                        foreach ($row as $row) {
                                        ?>

                                            <tr style="font-size: small" ;>
                                                <td><img width="80%" src="../admin/p_img/<?php echo $row['p_img1']; ?>" alt=""></td>
                                                <td><?php echo $row['p_name']; ?> </td>
                                                <td>สรรพคุณ : <?php echo $row['p_detail']; ?> <br> จำนวน : <?php echo $row['p_amount']; ?> <?php echo $row['p_unit']; ?></td>
                                                <td align="center"><?php echo $row['p_price']; ?>.00</td>
                                                <td align="center"><a href="product_edit.php?update_id=<?php echo $row["p_id"]; ?>" class="btn1"><i class="bi bi-pencil-square"></i></a></td>
                                                <td align="center"><a href="?delete_id=<?php echo $row["p_id"]; ?>" onclick="return confirm('คุณต้องการลบสินค้าชิ้นนี้ใช่หรือไม่?')" class="btn2"><i class="bi bi-trash"></i> </a></td>
                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <ul class="pagination justify-content-center">
                                <li <?php if ($page == 1) {
                                        echo "class='page-item disabled'";
                                    } ?>>
                                    <a class="page-link" href="product.php?page=<?= $page - 1 ?>">Previous</a>
                                </li>
                                <?php
                                for ($i = 1; $i <= $total_page; $i++) { ?>
                                    <li <?php if ($page == $i) {
                                            echo "class='page-item active sele-color'";
                                        } ?>><a class="page-link" href="product.php?page=<?= $i ?>"><?= $i ?></a></li>

                                <?php }

                                ?>



                                <li <?php if ($page == $total_page) {
                                        echo "class='page-item disabled'";
                                    } ?>>
                                    <a class="page-link" href="product.php?page=<?= $page + 1 ?>">Next</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>


</body>