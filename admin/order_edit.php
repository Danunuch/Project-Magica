<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include('menu_l.php');
require_once('../config/db.php');

if (isset($_REQUEST['update_id'])) {
    try {
        $id = $_REQUEST['update_id'];
        $select_stmt = $conn->prepare("SELECT * FROM orders WHERE order_Id = :order_Id");
        $select_stmt->bindParam(':order_Id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

if (isset($_POST['btn_update'])) {
    // $_SESSION['firstname'] = $_POST['firstname'];
    // $_SESSION['lastname'] = $_POST['lastname'];
    // $_SESSION['email'] = $_POST['email'];
    // $_SESSION['tel'] = $_POST['tel'];
    // $_SESSION['password'] = $_POST['password'];
    // $_SESSION['line_Id'] = $_POST['line_Id'];
    // $_SESSION['address'] = $_POST['address'];
    // $_SESSION['m_img'] = $_FILES['m_img'];


    $order_Id = $_POST['order_Id'];
    // $parcel_code  = $_POST['parcel_code'];
    $status_order=  $_POST['status_order'];




    // if (empty($parcel_code)) {
    //     $_SESSION['error'] = 'กรุณากรอกหมายเลขพัสดุ';
    //     header("location: order_edit.php");
    // } else
     if (empty($status_order)) {
        // $_SESSION['error'] = 'กรุณาอนุมัติคำสั่งซื้อ';
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'กรุณาอนุมัติคำสั่งซื้อ',
                icon: 'warning',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";
        echo "<meta http-equiv='Refresh' content='1.3; url=order_edit.php?update_id=$order_Id'>";

    }
    //     if (empty($m_img)) {
    //         $_SESSION['error'] = 'กรุณาอัปโหลดรูปภาพ';
    //         header("location: admin_add.php");
    else {
        try {
            $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $check_email->bindParam(":email", $email);
            $check_email->execute();
            $row = $check_email->fetch(PDO::FETCH_ASSOC);

        if (!isset($_SESSION['error'])){ 
                        $insert_stmt = $conn->prepare("UPDATE orders SET  status_order =:status_order WHERE order_Id = :order_Id");
                        $insert_stmt->bindParam(':order_Id', $order_Id);
                        // $insert_stmt->bindParam(':parcel_code', $parcel_code);
                        $insert_stmt->bindParam(':status_order', $status_order);
                        $insert_stmt->execute();

                        if ($insert_stmt) {
                            echo "<script>alert('แก้ไขข้อมูลคำสั่งซื้อเรียบร้อยแล้ว')</script>";
                            echo "<meta http-equiv='Refresh' content='0.001; url=order.php'>";
                            //$updateMsg = "เพิ่มสินค้าเรียบร้อยแล้ว";

                            // header("refresh:2;product.php");
                        } else {
                            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
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

    .none {
        display: none;
    }

    .show {
        display: flex;
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
            <div class="col-md-12 col-sm-12 " style="height: 1200px;">
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
                    <form id="order_form"  method="POST" class="form-horizontal mt-5" >

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

                            <div class="col" align="left">
                                <div class="p-3"><label for="status_order" class="form-label" style="margin-bottom: 0px;">สถานะคำสั่งซื้อ</label>
                                    <select class="form-control" name="status_order" id="">
                                        <option value="">กรุณาเลือกสถานะ</option>
                                        <option value="2">อนุมัติคำสั่งซื้อ</option>
                                        <option value="1">รออนุมัติคำสั่งซื้อ</option>
                                    </select>
                                </div>
                            </div>
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

                            <!-- <div class="col" align="left">
                                    <div class="p-3 "><label for="parcel_code" class="form-label" style="margin-bottom: 0px;">หมายเลขพัสดุ</label>
                                        <input type="text" class="form-control" name="parcel_code">
                                    </div>
                                </div> -->
                        </div>


                        <div class="row gx-5">
                            <div class="col" align="left">
                                <div class="p-3 "><label for="note" class="form-label" id="label-note" style="margin-bottom: 0px;">หมายเหตุ</label>
                                    <input type="text" value="<?php echo $data_orders[0]['note']; ?>" class="form-control" name="note" id="note" aria-describedby="note" readonly>
                                </div>
                            </div>
                            <div class="col" align="left">
                                <div class="p-3 "><label for="tel" class="form-label" id="label-tel" style="margin-bottom: 0px;">เบอร์โทรศัพท์ผู้รับ</label>
                                    <input type="text" value="<?php echo $data_orders[0]['tel']; ?>" class="form-control" name="tel" id="tel" aria-describedby="tel" readonly>
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
                                <div class="table-responsive">
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
                                                    <font color="#000000"><?php echo $row_order_detail["qty"]; ?>
                                                </td>
                                                </font>
                                                <td align="center">
                                                    <font color="#000000"><?php echo  number_format($row_order_detail["p_price"], 2)  ?>
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
                                    <div class="col" align="left" style="display: inline-flex;">
                                        <div class="p-3"><label for="slip_img" class="col-form-label">หลักฐานการชำระเงิน</label>
                                            <div class="payment">-</div>
                                            <a data-fancybox="gallery" href="../asset/upload/slip_order/<?php echo $data_orders[0]['slip_img']; ?>">
                                                <img class="rounded" width="30%" src="../asset/upload/slip_order/<?php echo $data_orders[0]['slip_img']; ?>" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>




                                <div class="form-group text-center">
                                    <div class="col-md-12 mt-3">
                                        <input type="submit" name="btn_update" class="btn btn-success" value="บันทึกข้อมูล"> &nbsp;&nbsp;
                                        <a href="order.php" class="btn btn-danger">ยกเลิก</a>
                                    </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>


        <script type="text/javascript">
            let imgInput = document.getElementById('imgInput');
            let previewIm = document.getElementById('previewImg');
            var method = document.getElementById('payment_method').value;

            // console.log(method);
            if (method == "ชำระเงินปลายทาง") {
                $(".rounded").addClass("none");
                $(".payment").addClass("show");
            } else if (method == "Mobile Banking") {
                $(".payment").addClass("none");
                $(".rounded").addClass("show");
            }


            imgInput.onchange = evt => {
                const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file);
                }
            }
        </script>
    </div>

</body>