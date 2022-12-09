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
if (isset($_REQUEST['delete_id'])) {
    $id = $_REQUEST['delete_id'];

    $stmt = $conn->prepare("SELECT * FROM dealer_general WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Delete an original record from db
    $stmt = $conn->prepare('DELETE FROM dealer_general WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if ($stmt) {
        echo "<script>alert('ลบตัวแทนจำหน่ายเรียบร้อยแล้ว')</script>";
        header("refresh:0.00000001; url=dealer_general");
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

    .btn1{
        background-color: #EFB50E;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: flex ;
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

    .btn2{
        background-color: #E62B18;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: flex ;
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
</style>



<body>
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 " style="height: 1024px;">
                <div class="dashboard_graph">
                    <div class="row x_title">
                        <div class="col-md-6">
                            <h3>ตัวแทนจำหน่าย (ทั่วไป) </h3>
                        </div> <br>
                        <div class="dashboard_graph">
                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <br>
                            <tr align="center">
                                <th width="3%">รูป</th>
                                <th width="6%">ข้อมูลส่วนบุคคล</th>
                                <th width="10%">ข้อมูลทั่วไป</th>
                                <th width="3%">ระดับตัวแทน</th>
                                <th width="2%"></th>
                                <th width="2%"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $select_stmt = $conn->prepare("SELECT * FROM dealer_general");
                            $select_stmt->execute();

                            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>

                                <tr style="font-size: small" ;>
                                    <td align="center"><img src="../admin/dg_img/<?php if ($row['m_img'] == null) {
                                                          echo "icon-profile.png";
                                                        } else {
                                                          echo $row['m_img'];
                                                        }
                                                       ?> " class="img-circle profile_img" style="width: 46px; height: 46px; margin: 10px;"></td>
                                    <td>ชื่อ : <?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?>
                                        <br>รหัสประจำตัวประชาชน : <?php echo $row['Id_card']; ?>
                                        <br>อีเมล : <?php echo $row['email']; ?><br>เบอร์โทรศัพท์ : <?php echo $row['tel']; ?>
                                        
                                    </td>
                                    <td>ไลน์ไอดี : <?php echo $row['line_Id']; ?>
                                    <br>ที่อยู่ : <?php echo $row['address']; ?>
                                    </td>
                                    <td>สถานะ : <?php echo $row['level']; ?>
                                       
                                    </td>
                                    <td align="center" color="#fff"><a href="dealer_general_edit.php?update_id=<?php echo $row["id"]; ?>" class="btn1"><i class="bi bi-pencil-square" ></i></a></td>
                                    <td align="center"><a onclick="return confirm('คุณต้องการลบผู้ใช้งานนี้หรือไม่')" href="?delete_id=<?php echo $row["id"]; ?>" class="btn2"><i class="bi bi-trash"></i></a></td>
                                </tr>

                            <?php }

                            ?>

                        </tbody>
                    </table>
                </div>



            </div>
        </div>


    </div>


</body>