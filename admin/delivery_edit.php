<?php
include('menu_l.php');
require_once('../config/db.php');

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
</style>


<div class="container" style="max-width: 800px;">
    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php  } ?>
    <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success" role="alert">
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
        </div>
    <?php  } ?>
    <?php if (isset($_SESSION['warning'])) { ?>
        <div class="alert alert-warning" role="alert">
            <?php
            echo $_SESSION['warning'];
            unset($_SESSION['warning']);
            ?>
        </div>
    <?php  } ?>
</div>


<body>
    <div class="right_col" role="main">
        <div class="row" style="display: inline-block;">

        </div>



        <div class="row">
            <div class="col-md-12 col-sm-12 " style="height: 1500px;">
                <div class="dashboard_graph">

                    <div class="col-md-6">
                        <h3>ตรวจสอบ-อนุมัติคำสั่งซื้อ</h3>
                    </div> <br>
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
                    <form id="delivery_form" action="delivery_edit_db.php" method="POST" class="form-horizontal mt-5" ">

                        <?php
                        if (isset($_GET['update_id'])) {
                            $id = $_GET['update_id'];
                            $select_stmt = $conn->prepare("SELECT * FROM orders WHERE order_Id = :order_Id");
                            $select_stmt->bindParam(":order_Id", $id);
                            $select_stmt->execute();
                            $data_orders = $select_stmt->fetchAll();
                        }
                        ?>
                        <div class=" form-group text-center">
                        <div class="row gx-5">
                            <div class="col" align="left">
                                <input type="hidden" name="order_Id" value="<?php echo  $data_orders[0]['order_Id']; ?>">
                                <div class="p-3"><label for="cus_name" class="form-label" style="margin-bottom: 0px;">ชื่อ</label>
                                    <input type="text" value="<?php echo $data_orders[0]['cus_name']; ?>" class="form-control" name="cus_name" aria-describedby="cus_name" readonly>
                                </div>
                            </div>

                            <!-- <div class="col" align="left">
                                    <div class="p-3"><label for="status_order" class="form-label" style="margin-bottom: 0px;">สถานะคำสั่งซื้อ</label>
                                        <select class="form-control" name="status_order" id="">
                                            <option value="">กรุณาเลือกสถานะ</option>
                                            <option value="2">อนุมัติคำสั่งซื้อ</option>
                                            <option value="1">รออนุมัติคำสั่งซื้อ</option>
                                        </select>
                                    </div>
                                </div> -->
                        </div>
                        <?php
                        // echo '<pre>';
                        // print_r($data_orders);
                        // echo '</pre>';
                        ?>

                        <div class="row gx-5">
                            <div class="col" align="left">
                                <div class="p-3 "><label for="address" class="form-label" id="label-address" style="margin-bottom: 0px;">ที่อยู่ในการจัดส่ง</label>
                                    <input type="text" value="<?php echo $data_orders[0]['address']; ?>" class="form-control" name="address" id="address" aria-describedby="address" readonly>
                                </div>
                            </div>

                            <div class="col" align="left">
                                <div class="p-3 "><label for="parcel_code" class="form-label" style="margin-bottom: 0px;">หมายเลขพัสดุ</label>
                                    <input type="text" class="form-control" value="<?php echo $data_orders[0]['parcel_code']; ?>" name="parcel_code">
                                </div>
                            </div>
                        </div>


                        <div class="row gx-5">

                        <div class="col" align="left">
                                <div class="p-3"><label for="status_order" class="form-label" style="margin-bottom: 0px;">บริษัทขนส่ง</label>
                                    <select class="form-control" name="shipping_name" id="">
                                        <option value="">กรุณาเลือกสถานะ</option>
                                        <option value="Kerry Express">Kerry Express</option>
                                        <option value="Flash Express">Flash Express</option>
                                        <option value="J&T Express">J&T Express</option>
                                        <option value="ไปรษณีย์ไทย">ไปรษณีย์ไทย</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col" align="left">
                                <div class="p-3 "><label for="note" class="form-label" id="label-note" style="margin-bottom: 0px;">หมายเหตุ</label>
                                    <input type="text" value="<?php echo $data_orders[0]['note']; ?>" class="form-control" name="note" id="note" aria-describedby="note" readonly>
                                </div>
                            </div>



                        </div>

                        <div class="form-group">

                            <div class=" control-label">
                                <?php $qty = 0;
                                $p_price = 0;
                                if (isset($_GET['update_id'])) {
                                    $id = $_GET['update_id'];
                                    $select_stmt = $conn->prepare("SELECT * FROM orders_detail WHERE order_id  = :order_id");
                                    $select_stmt->bindParam(":order_id", $id);
                                    $select_stmt->execute();
                                    $data_id_orders = $select_stmt->fetchAll();
                                    //var_dump($query); 
                                    // echo '<pre>';
                                    // print_r($id);
                                    // echo '</pre>';
                                }
                                ?>
                                <!-- <div class="container" align="center"> -->
                                <br>
                                <!-- <span>asfafs</span> -->
                                <div class="table-responsive">
                                    <th width="6%">
                                        <div class="txt-pos" style="width: 90%;padding: 10px; display: flex; justify-content: left; font-size: 16px;">
                                            <font color="#000000">หมายเลขคำสั่งซื่อที่ : <?= $data_id_orders[0]["order_id"] ?> </font>
                                        </div>
                                    </th>
                                    <table class="table">
                                        <tr align="center">
                                            <th width="6%">
                                                <font color="#000000"> ชื่อสินค้า </font>
                                            </th>
                                            <th align="center" width="3%">
                                                <font color="#000000">จำนวน (รายการ) </font>
                                            </th>
                                            <th align="center" width="7%">
                                                <font color="#000000">ราคาทั้งหมด (บาท)
                                            </th>
                                            </font>
                                        </tr>
                                        <?php

                                        foreach ($data_id_orders as $row_order_detail) { ?>
                                            <tr align="center">
                                                <td align="left">
                                                    <font color="#000000"> <?php echo $row_order_detail["p_name"]; ?>
                                                </td>
                                                </font>
                                                <td align="center">
                                                    <font color="#000000"><?php echo $row_order_detail["qty"];
                                                                            $qty = $qty + $row_order_detail["qty"]; ?>
                                                </td>
                                                </font>
                                                <td align="center">
                                                    <font color="#000000"><?php echo $row_order_detail["p_price"]; ?>
                                                </td>
                                                </font>
                                            </tr>
                                        <?php  }
                                        ?>
                                        <!-- <tr align="center">
                                                <td><font color="#000000"> </td></font>
                                                <td><font color="#FF0000"><?php echo $qty; ?>&nbsp;&nbsp;รายการ</td></font>
                                                <td><font color="#FF0000"><?php echo number_format($data_orders[0]['total_price'], 2); ?> </td> </font>

                                            </tr> -->
                                        <tr>
                                            <td>
                                                <font color="#FF0000">รวมภาษีมูลค่าเพิ่ม 7%
                                            </td>
                                            </font>
                                            <td></td>
                                            <td align="center">
                                                <font color="#FF0000"><?php echo number_format($data_orders[0]['total_price'], 2); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="row gx-5">
                                    <div class="col" align="left">
                                        <div class="p-3 "><label for="payment_method" class="form-label" style="margin-bottom: 0px;">รูปเเบบการชำระเงิน</label>
                                            <input type="text" value="<?php echo $data_orders[0]['payment_method']; ?>" class="form-control" name="payment_method" id="payment_method" aria-describedby="payment_method" readonly>

                                        </div>
                                    </div>
                                </div>




                                <div class="form-group text-center">
                                    <div class="col-md-12 mt-3">
                                        <input type="submit" name="btn_update" class="btn btn-success" value="บันทึกข้อมูล"> &nbsp;&nbsp;
                                        <a href="admin.php" class="btn btn-danger">ยกเลิก</a>
                                    </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>


        <script>
            let imgInput = document.getElementById('imgInput');
            let previewIm = document.getElementById('previewImg');


            imgInput.onchange = evt => {
                const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file);
                }
            }
        </script>
    </div>

</body>