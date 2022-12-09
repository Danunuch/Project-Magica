<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm">
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>



<?php include('menu_l.php'); ?>

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
        color: white;

    }

    .m {
        width: 200px;
    }
    .table-responsive{
        height:500px;
  overflow:auto; 
    }
</style>


<?php
require_once('../config/db.php');
error_reporting(0);


if (isset($_GET['act'])) {
    if ($_GET['act'] == 'excel') {
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=export.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
    }
}



$select_stmt = $conn->prepare("SELECT * FROM orders");
$select_stmt->execute();
$row_info = $select_stmt->fetchAll();
$row_order = $row_info;


for ($i = 0; $i < count($row_order); $i++) {
    $date_order = explode(" ", $row_order[$i]["order_date"]);
}


if (isset($_GET['submit_search'])) {

    if (isset($_GET['date1']) && isset($_GET['date2'])) {
        $order_date1 = $_GET['date1'];
        $order_date2 = $_GET['date2'];

        $order_detail = $conn->prepare("SELECT * FROM orders inner join orders_detail on orders.order_Id = orders_detail.order_id WHERE (order_date BETWEEN '$order_date1' AND '$order_date2')");
        $order_detail->execute();
        $row_order_detail = $order_detail->fetchAll(PDO::FETCH_ASSOC);
    }
} else {

    $order_detail = $conn->prepare("SELECT * FROM orders inner join orders_detail on orders.order_Id = orders_detail.order_id");
    $order_detail->execute();
    $row_order_detail = $order_detail->fetchAll(PDO::FETCH_ASSOC);
}

?>

<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm">
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

<body style=" font-family: 'Kanit', sans-serif;">
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 " style="height: 1024px;">
                <div class="dashboard_graph">
                    <div class="row x_title">
                        <div class="col-md-6">
                            <h3>รายงานการขายสินค้า (Excel)</h3>
                        </div>
                        <form action="report1.php" method="GET">
                            <div class="row gx-5">
                                <div class="p-1 m"><br>กรุณาเลือกวันที่ <input type="date" name="date1" class="form-control" value="
                <?php
                if (isset($_GET['date1'])) {
                    echo $_GET['date1'];
                } else {
                    echo "dd/mm/yyyy";
                }
                ?>">
                                </div>

                                <div class="p-1 m"><br>ถึงวันที่ <input type="date" name="date2" class="form-control" value="
                <?php
                if (isset($_GET['date2'])) {
                    echo $_GET['date2'];
                } else {
                    echo "dd/mm/yyyy";
                }
                ?>">
                                </div>

                                <div class="col">
                                    <br>
                                    <div class="p-1"><br><input type="submit" name="submit_search" class="btn btn-secondary" value="แสดงข้อมูล">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="dashboard_graph">  <div class="col col-md ex">
                            <button id="export_button" class="btn btn-success btn-sm">Export</button>
                        </div>
                    <div class="table-responsive">
                      
                        <table id="report_data" class="table table-bordered table-hover" style=" font-family: 'Kanit', sans-serif;">
                            <thead>
                                <tr align="center">

                                    <td width="1%"> <b>เลขที่สั่งซื้อ</b> </td>
                                    <td width="1%"><b>ชื่อสินค้า</b></td>
                                    <td width="1%"> <b>จำนวนการสั่งซื้อ (ชิ้น)</b> </td>
                                    <td width="1%"> <b> วันที่สั่งซื้อ</b></td>
                                    <td width="1%"> <b>ยอดขาย (บาท)</b> </td>
                                </tr>
                            </thead>
                            <tbody style="font-size: 15px;">
                                <?php for ($i = 0; $i < count($row_order_detail); $i++) {
                                ?>
                                    <tr align="center">
                                        <td><?php
                                            if ($row_order_detail[$i]['order_Id'] == $row_order_detail[$i - 1]['order_Id']) {
                                                echo "";
                                            } else {
                                                echo $row_order_detail[$i]['order_Id'];
                                            }
                                            ?></td>
                                        <td align="left"><?php echo $row_order_detail[$i]['p_name']; ?></td>
                                        <td><?php echo $row_order_detail[$i]['qty']; ?></td>
                                        <td><?php
                                            if ($row_order_detail[$i]['order_Id'] == $row_order_detail[$i - 1]['order_Id']) {
                                                echo "";
                                            } else {
                                                $d = explode(" ", $row_order_detail[$i]['order_date']);
                                                echo $d[0];
                                            }
                                            ?></td>
                                        <td><?php
                                            if ($row_order_detail[$i]['order_Id'] == $row_order_detail[$i - 1]['order_Id']) {
                                                echo "";
                                            } else {
                                                echo number_format($row_order_detail[$i]['total_price'], 2);
                                            }
                                            ?></td>
                                    </tr>
                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</body>
<script>
    function html_table_to_excel(type) {

        var data = document.getElementById('report_data');

        var file = XLSX.utils.table_to_book(data, {
            sheet: "sheet1"
        });

        XLSX.write(file, {
            bookType: type,
            bookSST: true,
            type: 'base64'
        });

        XLSX.writeFile(file, 'รายงานการขายสินค้า.' + type);
    }

    const export_button = document.getElementById('export_button');

    export_button.addEventListener('click', () => {
        html_table_to_excel('xlsx');
    });
</script>