<?php
include('menu_l.php');
require_once('../config/db.php');



if (isset($_SESSION["admin_login"])) {
    $u = $_SESSION["admin_login"];
    $select_stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $select_stmt->bindParam(":id", $u);
    $select_stmt->execute();
    $admin = $select_stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_GET['order_id'])) {
    $id = $_GET['order_id'];
    $select_stmt = $conn->prepare("SELECT * FROM orders WHERE order_Id = :order_Id");
    $select_stmt->bindParam(":order_Id", $id);
    $select_stmt->execute();
    $data_orders = $select_stmt->fetch(PDO::FETCH_ASSOC);
}

date_default_timezone_set('Asia/Bangkok');
$today = date("Y-m-d H:i:s");


?>


<style>
    .body {
        font-family: 'Kanit', sans-serif;
        /* font-size: 16px; */
        color: #000;
    }

    .home-content2 {
        font-size: 20px;
        color: #000;
        width: auto;
        font-weight: bold;
    }

    .title {
        font-size: 16px;

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

    /* input file */
    .filewrap {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #ccc;
        border: 1px solid #ccc;
        border-radius: 7px 7px 7px 7px;
        background-image: url('../admin/images/file-upload.png');
        background-repeat: no-repeat;
        background-size: cover;
        height: 159px;
        width: 139px;
        color: #fff;
        font-family: sans-serif;
        font-size: 12px;
        z-index: 1;
        margin: 5px;
    }

    input[type="file"] {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;

    }

    .bi-plus-circle {
        position: absolute;
        width: 60px;
        height: 60px;
        color: blue;
        font-size: 60px;
        z-index: 2;
    }

    .m {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;

    }

    .pos {
        display: flex;
        width: 100%;
        justify-content: space-between;
    }

    .posit1 {
        width: 50%;
    }

    .posit2 {
        width: 50%;
        text-align: right;
    }
</style>


<div class="container" style="max-width: 800px;"></div>

<body>
    
    <div class="right_col" role="main">
        <div class="row" style="display: inline-block;"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 " style="height: 1500px;">
                <div class="dashboard_graph">
                    <div class="m"><span><h4>ใบสั่งซื้อ</h4></span><img src="../admin/images/logo_tax.png" alt="" width="120px"></div>
                    <form id="tax_form" method="POST" class="form-horizontal mt-2">
                        
                        <div class="form-group pos">
                            <div class="posit1">
                                <span><label for="cus_name" class="form-label" style="margin-bottom: 0px;">ชื่อผู้รับสินค้า : </label>
                                    <span><?php echo $data_orders['cus_name']; ?></span><br>

                                    <span><label for="address" class="form-label" style="margin-bottom: 0px;">ที่อยู่ : </label>
                                        <span><?php echo $data_orders['address']; ?></span></div>
                            <div class="posit2">
                                <span><label for="order_Id" class="form-label" style="margin-bottom: 0px;">เลขที่ใบสั่งซื้อ : </label></span>
                                <span><?php echo  $data_orders['order_Id'] ?></span><br>

                                <span><label for="order_Id" class="form-label" style="margin-bottom: 0px;">วันที่ออก : </label>
                                    <span><?php echo  $today ?></span><br>

                                    <span><label for="name" class="form-label" style="margin-bottom: 0px;">ชื่อผู้ออกใบสั่งซื้อ : </label>
                                        <span>Dr.Magica</span><br></div>

                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr align="center">

                                        <th width="9%">รายการ</th>
                                        <th width="4%">จำนวน</th>
                                        <th width="4%">ราคา (บาท)</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $d_or = $data_orders['order_Id'];
                                    $select_stmt = $conn->prepare("SELECT * FROM orders_detail WHERE order_id =:order_id");
                                    $select_stmt->bindParam(":order_id", $d_or);
                                    $select_stmt->execute();

                                    $row = $select_stmt->fetchAll();

                                    // echo '<pre>';
                                    // print_r($row);
                                    // echo '</pre>';
                                    foreach ($row as $row) {
                                    ?>

                                        <tr style="font-size: small" ;>

                                            <td><?php echo $row['p_name'] ?> </td>
                                            <td align="center"><?php echo $row['qty'] ?> </td>
                                            <td align="center"><?php echo number_format($row['p_price'], 2) ?> </td>




                                        </tr>

                                    <?php } ?>
                                    <tr>
                                        <td>ค่าจัดส่ง </td>
                                        <td></td>
                                        <td align="center">45.00 </td>
                                    </tr>
                                    <tr>
                                        <td>ภาษีมูลค่าเพิ่ม 7%</td>
                                        <td></td>
                                        <td align="center"> <?php echo number_format(($row['p_price']*7)/100 ,2);  ?> </td>
                                    </tr>
                                    <tr>
                                        <td> <b>ราคารวมทั้งหมด</b>  </td>
                                        <td></td>
                                        <td align="center"><b> <?php echo number_format($data_orders['total_price'], 2) ?> </b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row gx-5">
                            <div class="col">
                                <div class="p-1">
                                    <a href="tax_pdf.php?order_id=<?=$_REQUEST['order_id']?>&ad_id=<?= $admin['id']?>" target="blank" class="btn btn-success"><span > ดาวน์โหลด PDF</span></a>
                                    <!-- <button type="button"  onclick="window.print()"  >Export</button> -->
                                    <!-- <a href="tax_pdf.php?order_id=<?=$_REQUEST['order_id']?>" target="blank" class="btn btn-success"><span class="fa fa-print" style="color: #fff"> Export</span></a> -->
                                </div>
                            </div>
                        </div>


                </div>
            </div>



        </div>
       




    </div>

    </div>


</body>