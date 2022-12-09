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

?>
<script>
    function confirm_delete() {
        return confirm('ต้องการลบรายการนี้ใช่หรือไม่?');
    }
</script>

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
        background-color: #888c8b;
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

    .btn3:hover {
        color: white;
        background-color: #737373;
    }

    .page-item.active .page-link {
        color: #FFFFFF;
        background: #2A3F54;
        border: none;
    }
</style>

<?php
if (isset($_POST['submit_tracking'])) {
    if (count((array)$_POST['ids']) > 0) {
        $p_all = $_POST['ids'];
        $order_Id = implode(",", $_POST['ids']);
        header("Location : tracking.php");
    } else {
        //  echo "<script>alert('กรุณาเลือกรายการก่อนทำการพิมพ์เอกสาร');</script>";
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'กรุณาเลือกรายการก่อนทำการพิมพ์เอกสาร',
                icon: 'warning',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";
        // header("refresh:2; url=cart.php");
    }
}

$page = $_GET['page'];
$select_count = $conn->prepare("SELECT * FROM orders WHERE status_order = 2");
$select_count->execute();
$row_count = $select_count->fetchAll();
$rows = 10;

if ($page == "") {
    $page = 1;
}
$total_data = count($row_count);
$total_page = ceil($total_data / $rows);
$start = ($page - 1) * $rows;


$select_stmt = $conn->prepare("SELECT * FROM orders WHERE status_order = 2 ORDER BY order_Id DESC LIMIT $start,10");
$select_stmt->execute();
$row_info = $select_stmt->fetchAll();
$row = $row_info;


if (isset($_GET['submit_search'])) {
    if (isset($_GET['order_Id'])) {
        $id_order = $_GET['order_Id'];
        $stmt = $conn->prepare("SELECT * FROM `orders` WHERE `order_Id` LIKE ?");
        $stmt->bindValue(1, "%$id_order%", PDO::PARAM_STR);
        $stmt->execute();
        $row_info = $stmt->fetchAll();
        $row = array_reverse($row_info);
    }

    if (isset($_GET['shipment'])) {
        $shipment = $_GET['shipment'];
        $stmt = $conn->prepare("SELECT * FROM `orders` WHERE `shipping_company` LIKE ?");
        $stmt->bindValue(1, "%$shipment%", PDO::PARAM_STR);
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
        echo "<meta http-equiv='Refresh' content='1.3; url=delivery.php'>";
    }
}
?>

<body>
    <div class="right_col" role="main">
        <div class="row" style="display: inline-block;">

        </div>


        <div class="row">
            <div class="col-md-12 col-sm-12" style="height: 1500px;">
                <div class="dashboard_graph">

                    <div class="col-md-6">
                        <h3>รายการจัดส่งสินค้า</h3>
                    </div> <br><br>
                    <br>

                    <form action="delivery.php" method="GET">
                        <div class="row gx-5">
                            <div class="col">
                                <div class="p-1">เลขที่คำสั่งซื้อ <input type="text" name="order_Id" class="form-control" value="">
                                </div>
                            </div>
                            <!-- <div class="col">
                                <div class="p-1">โทรศัพท์ <input type="text" name="tel" class="form-control" value="">
                                </div>
                            </div> -->
<!-- 
                            <div class="col">
                                <div class="p-1">รูปแบบการจัดส่ง :<select class="form-select" name="shipment" id="" align="right">
                                        <option value="" selected disabled>
                                            <?php
                                            if (isset($_GET['shipment'])) {
                                                //  echo $_GET['shipment'];
                                            } else {
                                                $shipment = "กรุณาเลือกสถานะ";
                                            }
                                            echo $shipment; ?>

                                        </option>

                                        <option value="ไปรษณีย์ไทย">ไปรษณีย์ไทย</option>
                                        <option value="Kerry">Kerry</option>
                                        <option value="Flash Express">Flash Express</option>
                                        <option value="J&T">J&T</option>
                                    </select>
                                </div>
                            </div> -->

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
                            <!-- <div class="col">
                                <div class="p-1">สถานะสินค้า :<select class="form-control" name="status_order" id="" align="right">
                                        <option value="" selected disabled>กรุณาเลือกสถานะ</option>
                                        <option value="กำลังแพ็ค">กำลังแพ็ค</option>
                                        <option value="ส่งเรียบร้อยแล้ว">ส่งเรียบร้อยแล้ว</option>
                                    </select>
                                </div>
                            </div> -->

                            <div class="col">
                                <br>
                                <div class="p-1"><input type="submit" name="submit_search" class="btn btn-secondary" value="แสดงข้อมูล">
                                </div>
                            </div>
                        </div>
                        <div class="row gx-5">
                            <div class="col">
                                <!-- <div class="p-1">

                                    <button type="submit" name="submit_tracking" class="btn btn-danger">พิมพ์เอกสาร</button>
                                </div> -->
                            </div>
                        </div><br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr align="center">
                                        <!-- <th width="1%"></th> -->
                                        <th >เลขที่คำสั่งซื้อ</th>
                                        <th >ชื่อลูกค้า</th>
                                        <th >ที่อยู่</th>
                                        <th >รูปเเบบการจัดส่ง</th>
                                        <th >หมายเลขพัสดุ</th>
                                        <th >รูปแบบการชำระเงิน</th>
                                        <th ></th>
                                        <th ></th>
                                        <th >พิมพ์ใบสั่งซื้อ</th>
                                        <th >พิมพ์ใบแปะหน้า</th>
                                    </tr>
                                </thead>
                    </form>

                    <tbody>
                        <?php
                        foreach ($row as $row) {
                        ?>

                            <tr style="font-size: small" ;>

                                <!-- <td align="center"> <input type="checkbox" class="checkbox checkbox-only" name="ids[]" value=<?php //echo $row['order_Id'] 
                                                                                                                                    ?>></td> -->
                                <td align="center"><?php echo $row['order_Id']; ?> </td>
                                <td align="center"><?php echo $row['cus_name']; ?></td>
                                <td><?php echo $row['address']; ?><br>โทรศัพท์ :<?php echo $row['tel']; ?></td>

                                <td align="center"> <?php echo $row['shipping_company']; ?></td>
                                <td align="center"> <?php echo $row['parcel_code']; ?></td>
                                <td align="center"><?php echo $row['payment_method']; ?>
                                <td align="center"><a href="delivery_edit.php?update_id=<?php echo $row["order_Id"]; ?>" class="btn1"><i class="bi bi-pencil-square"></i></a></td>
                                <td align="center"><a href="?delete_id=<?php echo $row["order_Id"]; ?>" onclick="return confirm_delete()" class="btn2"><i class="bi bi-trash"></i></a></td>
                                <td align="center"><a href="tax.php?order_id=<?php echo $row["order_Id"]; ?>" class="btn3"><i class="bi bi-printer"></i></a></td>
                                <td align="center"><a href="face_sheet.php?order_id=<?php echo $row["order_Id"]; ?>" class="btn3"><i class="bi bi-printer"></i></a></td>
                            </tr>

                        <?php } ?>
                    </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-center">
                    <li <?php if ($page == 1) {
                            echo "class='page-item disabled'";
                        } ?>>
                        <a class="page-link" href="delivery.php?page=<?= $page - 1 ?>">Previous</a>
                    </li>
                    <?php
                    for ($i = 1; $i <= $total_page; $i++) { ?>
                        <li <?php if ($page == $i) {
                                echo "class='page-item active sele-color'";
                            } ?>><a class="page-link" href="delivery.php?page=<?= $i ?>"><?= $i ?></a></li>

                    <?php }

                    ?>



                    <li <?php if ($page == $total_page) {
                            echo "class='page-item disabled'";
                        } ?>>
                        <a class="page-link" href="delivery.php?page=<?= $page + 1 ?>">Next</a>
                    </li>
                </ul>




            </div>
        </div>


    </div>
    </div>

</body>