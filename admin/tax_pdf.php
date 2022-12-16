<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
<title>Purchase Order - Magica</title>
<link rel="shortcut icon" href="../asset/img/icon-web.ico">
<?php

require_once('../config/db.php');



if (isset($_GET["ad_id"])) {
    $u = $_GET["ad_id"];
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
    body {
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

    @media print {
        #printButton {
            display: none;
        }

        @page {
            margin: 0;
        }

        body {
            margin: 1.6cm;
        }
    }

</style>




<body>
    <div class="container" style="max-width: 800px;">
        <div class="right_col" role="main">
            <div class="row" style="display: inline-block;"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="dashboard_graph">
                        <div class="m"><h4>ใบสั่งซื้อ</h4><img src="../admin/images/logo_tax.png" alt="" width="120px"></div>
                        <form id="tax_form" method="POST" class="form-horizontal mt-2">
                            <span>
                                
                            </span>
                            <div class="form-group pos">
                                <div class="posit1">
                                    <span><label for="cus_name" class="form-label" style="margin-bottom: 0px;">ชื่อผู้รับสินค้า : </label>
                                        <span><?php echo $data_orders['cus_name']; ?></span><br>

                                        <span><label for="address" class="form-label" style="margin-bottom: 0px;">ที่อยู่ : </label>
                                            <span><?php echo $data_orders['address']; ?></span>
                                </div>
                                <div class="posit2">
                                    <span><label for="order_Id" class="form-label" style="margin-bottom: 0px;">เลขที่ใบสั่งซื้อ : </label></span>
                                    <span><?php echo  $data_orders['order_Id'] ?></span><br>

                                    <span><label for="order_Id" class="form-label" style="margin-bottom: 0px;">วันที่ออก : </label>
                                        <span><?php echo  $today ?></span><br>

                                        <span><label for="name" class="form-label" style="margin-bottom: 0px;">ผู้ออกใบสั่งซื้อ : </label>
                                            <span>Dr.Magica</span><br>
                                </div>

                            </div>
                            <br>
                            <div class="table-responsive">
                            <div class="table-responsive">
                            <table class="table table-bordered" >
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

                                            <td style="font-size: 16px;"><?php echo $row['p_name'] ?> </td>
                                            <td align="center" style="font-size: 16px;"><?php echo $row['qty'] ?> </td>
                                            <td align="center" style="font-size: 16px;"><?php echo number_format($row['p_price'], 2) ?> </td>




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
                                        <td align="center"><?php echo number_format(($row['p_price']*7)/100 ,2);  ?> </td>
                                    </tr>
                                    <tr>
                                        <td> <b>ราคารวมทั้งหมด</b>  </td>
                                        <td></td>
                                        <td align="center"><b> <?php echo number_format($data_orders['total_price'], 2) ?> </b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            </div>
                            <div class="row gx-5">
                                <div class="col">
                                    <div class="p-1">
                                        <button type="button" class="btn btn-success " style="color: #fff" id="printButton" onclick="window.print()"><i class="bi bi-printer"></i> พิมพ์เอกสาร</button>
                                        <!-- <a href="tax_pdf.php?order_id=<?= $_REQUEST['order_id'] ?>" target="blank" class="btn btn-success"><span class="fa fa-print" style="color: #fff"> Export</span></a> -->
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>