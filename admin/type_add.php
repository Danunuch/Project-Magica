<?php include('menu_l.php'); ?>


<?php
require_once('../config/db.php');
?>
<?php
// print_r($_POST);
// exit();
if (isset($_POST['t_name'])) {
    //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    echo '
          <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    $t_name = $_POST['t_name'];

    //sql insert
    $stmt = $conn->prepare("INSERT INTO p_type (t_name)
        VALUES (:t_name)");
    $stmt->bindParam(':t_name', $t_name, PDO::PARAM_STR);
    $result = $stmt->execute();
    //เงื่อนไขตรวจสอบการเพิ่มข้อมูล
    if ($result) {
        echo '<script>alert("เพิ่มข้อมูลเรียบร้อยแล้ว")</script>';
        echo "<meta http-equiv='Refresh' content='0.001; url=type.php'>";
    } else {
        echo '<script>alert("มีบางอย่างผิดพลาด")</script>';
    }
} //else ของเช็คนามสกุลไฟล์  
// if($upload !='') {
$conn = null; //close connect db
//isset
?>


<div class="right_col" role="main">
    <div class="row" style="display: inline-block;">

    </div>

   

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
        </style>
        
    <body>

        <div class="row">
            <div class="col-md-12 col-sm-12 " style="height: 1024px;">
                <div class="dashboard_graph">
                    <div class="col-md-5">
                        <h3>เพิ่มประเภทสินค้า</h3>
                    </div><br>

                    <form method="post" class="form-horizontal mt-5">
                        <div class="form-group text-center" color="#0000">
                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <div class="p-3"><label for="t_name" class="col-form-label">ชื่อประเภทสินค้า</label>
                                        <input type="text" name="t_name" class="form-control">
                                    </div>
                                </div>
                            </div>




                            <div class="form-group text-center">
                                <div class="col-md-12 mt-3" align="left">&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="submit" name="btn_insert" class="btn btn-success" value="บันทึกข้อมูล"> &nbsp;&nbsp;
                                    <a href="admin.php" class="btn btn-danger">ยกเลิก</a>
                                </div> 
                    </form>
                    <br>
                </div>
            </div>




            <script src="js/slim.js"></script>
            <script src="js/popper.js"></script>
            <script src="js/bootstrap.js"></script>

        </div>
    </body>