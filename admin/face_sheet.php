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
        justify-content: center;
        align-items: center;

    }

    .pos {
        display: block;
        width: 100%;
        max-width: 100%;
        max-height: 80%;
        /* justify-content: space-between; */
        margin: 0 auto;
        position: relative;
    }

    .posit1 {
        width: 40%;
        border: 2px solid #000000;
        padding: 10px;
        display: block;
        margin: 0 auto;
    }

    .posit2 {
        width: 40%;
        height: 220px;
        border-left: 2px solid #000000;
        border-bottom: 2px solid #000000;
        border-right: 2px solid #000000;
        /* border: 2px solid #000000; */
        padding: 10px;
        margin: 0 auto;
        position: relative;
    }

    .order_Id {
        width: 100%;
        height: 35px;
        display: flex;
        padding: 5px;
        align-items: center;
        justify-content: flex-end;
        /* background-color: #000000;
        color: #FFFFFF; */
    }

    .c1 {
        width: 10%;
    }

    .c2 {
        width: 90%;
    }

    .q1 {
        width: 30%;
    }

    .q2 {
        width: 70%;
    }

    .q3 {
        width: 40%;
        display: flex;
        margin: 0 auto;
        justify-content: center;
        align-items: flex-start;
    }

    .box-c {
        display: flex;
    }

    .box-qr {
        position: absolute;
        width: 50%;
        height: 197px;
        max-height: 80%;
        left: 0;
        padding: 10px;
        border: 2px solid #000000;
    }

    #tax_form {
        font-size: 16px;
    }

    .p-1 {
        width: 100%;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

</style>


<div class="container" style="max-width: 800px;"></div>

<body>
    <div class="right_col" role="main">
        <div class="row" style="display: inline-block;"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 " style="height: 1500px;">
                <div class="dashboard_graph">
                    <form id="tax_form" method="POST" class="form-horizontal mt-2">
                        <span>
                            <h3>ใบแปะหน้าพัสดุ</h3>
                        </span>
                        <div class="form-group pos">
                            <div class="posit1">
                                <p class="order_Id">*กรณีจัดส่งสินค้าไม่สำเร็จ กรุณาส่งคืนตามที่อยู่ผู้ส่ง</p>
                                <h4>ผู้ส่ง</h4><br>
                                <div class="box-c">
                                    <div class="c1">

                                        <span><b>ชื่อ</b></span> <br>
                                        <span><b>โทร</b></span> <br>
                                        <span><b>ที่อยู่</b></span>
                                    </div>
                                    <div class="c2">

                                        <span> Dr.Magica</span><br>
                                        <span> 0636424297</span><br>

                                        <span></span> <span> 559/61 บ้านกลางเมือง รัชดา 36 ซ. รัชดาภิเษก 36 (เสือใหญ่)</span><br>
                                        <span>ถ. รัชดาภิเษก แขวง จันทร์เกษม เขต จตุจักร กรุงเทพ 10900</span>
                                    </div>
                                </div>
                            </div>
                            <div class="posit2">
                                <p class="order_Id">#<?php echo $data_orders['order_Id']; ?></p>
                                <h4>ผู้รับ</h4><br>
                                <div class="box-c">
                                    <div class="c1">

                                        <span><b>ชื่อ</b></span> <br>
                                        <span><b>โทร</b></span> <br>
                                        <span><b>ที่อยู่</b></span>
                                    </div>
                                    <div class="c2">

                                        <span><?php echo $data_orders['cus_name']; ?></span><br>
                                        <span><?php echo $data_orders['tel']; ?></span><br>
                                        <span><?php echo $data_orders['address']; ?></span><br>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="p-1">
                            <a href="face_sheet_pdf.php?order_id=<?= $_REQUEST['order_id'] ?>&ad_id=<?= $admin['id'] ?>" target="blank" class="btn btn-success"><span>สั่งพิมพ์</span></a>
                        </div>


                    </form>
                </div>
            </div>



        </div>





    </div>

    </div>


</body>