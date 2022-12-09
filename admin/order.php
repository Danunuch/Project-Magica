<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm">
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
require_once('../config/db.php');
include('menu_l.php');
error_reporting(0);
$page = $_GET['page'];
$select_count = $conn->prepare("SELECT * FROM orders");
$select_count->execute();
$row_count = $select_count->fetchAll();
$rows = 10;

if ($page == "") {
    $page = 1;
}
$total_data = count($row_count);
$total_page = ceil($total_data / $rows);
$start = ($page - 1) * $rows;

$select_stmt = $conn->prepare("SELECT * FROM orders ORDER BY order_Id DESC LIMIT $start,10 ");
$select_stmt->execute();
$row_info = $select_stmt->fetchAll();
//$row = array_reverse($row_info);
$row = $row_info;


if (isset($_GET['submit_search'])) {

    if (isset($_GET['date1']) && isset($_GET['date2'])) {
        $order_date1 = $_GET['date1'];
        $order_date2 = $_GET['date2'];
        $stmt = $conn->prepare("SELECT * FROM `orders` WHERE `order_date` BETWEEN ? AND ?");
        // $stmt->bindParam(":date1", $order_date1);
        // $stmt->bindParam(":date2", $order_date2);
        $stmt->execute(array($order_date1, $order_date2));
        $row_info = $stmt->fetchAll();
        $row = array_reverse($row_info);
    }
    if (isset($_GET['status_order'])) {
        $status = $_GET['status_order'];
        $stmt = $conn->prepare("SELECT * FROM `orders` WHERE `status_order` LIKE ?");
        $stmt->bindValue(1, "%$status%", PDO::PARAM_STR);
        $stmt->execute();
        $row_info = $stmt->fetchAll();
        $row = array_reverse($row_info);
    }
    if (isset($_GET['payment_method'])) {
        $payment = $_GET['payment_method'];
        $stmt = $conn->prepare("SELECT * FROM `orders` WHERE `payment_method` LIKE ?");
        $stmt->bindValue(1, "%$payment%", PDO::PARAM_STR);
        $stmt->execute();
        $row_info = $stmt->fetchAll();
        $row = array_reverse($row_info);
    }
}

if (isset($_GET["delete_id"])) {
    $order_Id = $_GET["delete_id"];

    $state = $conn->prepare("DELETE FROM orders WHERE order_Id = :order_Id");
    $state->bindParam(":order_Id", $order_Id);
    $state->execute();

    if ($state) {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'ลบรายการสั่งซื้อเรียบแล้ว',
                icon: 'success',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";
        echo "<meta http-equiv='Refresh' content='1.3; url=order.php'>";
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

    .status1 {
        color: #DB9C00;
        font-weight: bold;
    }

    .status2 {
        color: #358F02;
        font-weight: bold;
    }

    .btn3 {
        background-color: #FEA42A;
        border: none;
        color: white;
        padding: 0px;
        text-align: center;
        text-decoration: none;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 14px;
        width: 120px;
        height: 35px;
        border-radius: 5px;
    }

    .btn3:hover {
        background-color: #CA7603;
        color: white;

    }

    .page-item.active .page-link {
        color: #FFFFFF ;
        background: #2A3F54 ;
        border: none;
    }
</style>

<script>
    function confirm_delete() {
        return confirm('ต้องการลบรายการนี้ใช่หรือไม่?');
    }
</script>

<body>
    <div class="right_col" role="main">
        <div class="row" style="display: inline-block;">

        </div>


        <div class="row">
            <div class="col-md-12 col-sm-12" style="height: 1500px;">
                <div class="dashboard_graph">

                    <div class="col-md-6">
                        <h3>คำสั่งซื้อลูกค้าทั่วไป</h3>
                    </div> <br><br>
                    <br>
                    <form action="order.php" method="GET">
                        <div class="row gx-5">

                            <div class="col">
                                <div class="p-1">สถานะ :<select class="form-select" name="status_order" id="" align="right">
                                        <option value="" selected disabled><?php
                                                                            if (isset($_GET['status_order'])) {
                                                                                if ($_GET['status_order'] == 1) {
                                                                                    $status = "รออนุมัติคำสั่งซื้อ";
                                                                                } else {
                                                                                    $status = "อนุมัติคำสั่งซื้อ";
                                                                                }
                                                                            } else {
                                                                                $status = "กรุณาเลือกอนุมัติ";
                                                                            }

                                                                            echo $status ?></option>
                                        <option value="2">อนุมัติคำสั่งซื้อ</option>
                                        <option value="1">รออนุมัติคำสั่งซื้อ</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col">
                                <div class="p-1">รูปแบบการชำระเงิน :<select class="form-select" name="payment_method" id="" align="right">
                                        <option value="" selected disabled>
                                            <?php
                                            if (isset($_GET['payment_method'])) {
                                                //  echo $_GET['payment_method'];
                                            } else {
                                                $payment = "กรุณาเลือกรูปแบบ";
                                            }
                                            echo $payment; ?>

                                        </option>
                                        <option value="Mobile Banking">Mobile Banking</option>
                                        <option value="บัตรเครดิต/เดบิต">บัตรเครดิต/เดบิต</option>
                                        <option value="ชำระเงินปลายทาง">ชำระเงินปลายทาง</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="col">
                                <br>
                                <div class="p-1"><input type="submit" name="submit_search" class="btn btn-secondary" value="แสดงข้อมูล">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row gx-5">
                            <div class="col">
                                <div class="p-1"><a href="delivery.php" class="btn3"><span class="fa fa-truck"> เพิ่มการจัดส่ง</span></a>
                                </div>
                            </div>
                        </div> -->
                        <br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr align="center">

                                        <th width="7%">เลขที่คำสั่งซื้อ</th>
                                        <th width="6%">ชื่อลูกค้า</th>
                                        <th width="5%">ยอดรวม(บาท)</th>
                                        <th width="7%">สถานะ</th>
                                        <!-- <th width="2%">หมายเลขพัสดุ</th> -->
                                        <th width="9%">รูปเเบบการชำระเงิน</th>
                                        <th width="2%">ประเภทผู้ใช้</th>
                                        <th width="1%"></th>
                                        <th width="1%"></th>


                                    </tr>
                                </thead>
                    </form>

                    <tbody>
                        <?php

                        foreach ($row as $row) {
                        ?>

                            <tr style="font-size: small" ;>

                                <td align="center"><?php echo $row['order_Id']; ?> </td>
                                <td align="center"><?php echo $row['cus_name']; ?></td>
                                <td align="center"><?php echo number_format($row['total_price'], 2); ?></td>
                                <td align="center"><?php
                                                    if ($row['status_order'] == 1) {
                                                        $status_order = "รออนุมัติคำสั่งซื้อ";
                                                        echo  "<span class='status1'>$status_order</span>";
                                                    } else {
                                                        $status_order = "อนุมัติคำสั่งซื้อ";
                                                        echo  "<span class='status2'>$status_order</span>";
                                                    }


                                                    ?> </td>
                                <!-- <td align="center"><?php //echo $row['parcel_code']; 
                                                        ?> </td> -->
                                <td align="center"><?php echo $row['payment_method']; ?>
                                <td align="center"><?php echo $row['urole'] ?>

                                <td align="center"><a href="order_edit.php?update_id=<?php echo $row["order_Id"]; ?>" class="btn1"><i class="bi bi-pencil-square"></i></a></td>
                                <!-- <td align="center"> <button type="button" class="btn2" onclick="return confirm('are you sure?')"><i class="bi bi-trash"></i></button></td> -->
                                <td align="center"><a href="?delete_id=<?php echo $row["order_Id"];  ?>" onclick="return confirm_delete()" class="btn2"><i class="bi bi-trash"></i></a></td>

                            </tr>

                        <?php } ?>
                    </tbody>
                    </table>

                </div>


                <ul class="pagination justify-content-center" >
                    <li <?php if ($page == 1) {
                            echo "class='page-item disabled'";
                        } ?>>
                        <a class="page-link" href="order.php?page=<?= $page - 1 ?>">Previous</a>
                    </li>
                    <?php
                    for ($i = 1; $i <= $total_page; $i++) { ?>
                        <li <?php if ($page == $i) {
                                echo "class='page-item active sele-color'";
                            } ?>><a class="page-link"  href="order.php?page=<?= $i ?>"><?= $i ?></a></li>

                    <?php }

                    ?>



                    <li <?php if ($page == $total_page) {
                            echo "class='page-item disabled'";
                        } ?>>
                        <a class="page-link" href="order.php?page=<?= $page + 1 ?>">Next</a>
                    </li>
                </ul>




            </div>
        </div>


    </div>
    </div>

</body>