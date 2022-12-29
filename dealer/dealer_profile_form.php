<?php
error_reporting(0);
if (!isset($_SESSION)) {
    session_start();
}
require_once "../config/db.php";
error_reporting(0);
if (isset($_SESSION['dealer_login'])) {
    $user_id = $_SESSION['dealer_login'];
    $stmt = $conn->prepare("SELECT * FROM dealer WHERE id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['update'])) {
    $id = $row['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $line_Id = $_POST['line_Id'];
    $Org_name = $_POST['Org_name'];
    $license_type = $_POST['license_type'];
    $Id_card = $_POST['Id_card'];
    $license_number = $_POST['license_number'];


    $sql = $conn->prepare("UPDATE dealer SET firstname = :firstname, lastname = :lastname, email = :email, tel = :tel, 
                            line_Id = :line_Id, Org_name= :Org_name, license_type = :license_type,Id_card =:Id_card,license_number = :license_number WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->bindParam(":firstname", $firstname);
    $sql->bindParam(":lastname", $lastname);
    $sql->bindParam(":email", $email);
    $sql->bindParam(":tel", $tel);
    $sql->bindParam(":line_Id", $line_Id);
    $sql->bindParam(":Org_name", $Org_name);
    $sql->bindParam(":license_type", $license_type);
    $sql->bindParam(":Id_card", $Id_card);
    $sql->bindParam(":license_number", $license_number);
    $sql->execute();

    if ($sql) {
        echo "<script>alert('แก้ไขข้อมูลเสร็จสิ้น')</script>";
        echo "<meta http-equiv='Refresh' content='0.001; url=dealer_profile'>";
    }
}


?>

<div class="p-form-box">
    <div class="top-title">
        <div class="text-title">
            <span>ข้อมูลทั่วไป</span>
            <div class="line-cut-center"></div>
            <span><?= $row["level"] ?></span>
        </div>

    </div>
    <div class="line-cut-bottom"></div>
    <div class="content">
        <form method="post">

            <div class="form-group">
                <div class="content-form">
                    <div class="col-md-4">
                        <p class="p-label">ชื่อ</p>
                        <input type="text" value="<?php echo $row['firstname']; ?>" class="form-control fo" name="firstname" aria-describedby="firstname">

                    </div>
                    <div class="col-md-4">
                        <p class="p-label">นามสกุล</p>
                        <input type="text" value="<?php echo $row['lastname']; ?>" class="form-control fo" name="lastname" aria-describedby="lastname">
                    </div>
                </div>
                <div class="content-form">
                    <div class="col-md-4">
                        <p class="p-label">อีเมล</p>
                        <input type="email" value="<?php echo $row['email']; ?>" class="form-control fo" name="email" aria-describedby="email">
                    </div>
                    <div class="col-md-4">
                        <p class="p-label">โทรศัพท์</p>
                        <input type="tel" value="<?php echo $row['tel']; ?>" class="form-control fo" name="tel" aria-describedby="tel">
                    </div>
                </div>
                <div class="content-form">
                    <div class="col-md-4">
                        <p class="p-label">ไลน์ไอดี</p>
                        <input type="text" value="<?php echo $row['line_Id']; ?>" class="form-control fo" name="line_Id">
                    </div>
                    <div class="col-md-4">
                    <p class="p-label">ตำแหน่ง</p>
                        <input type="text" value="<?php echo $row['level']; ?>" class="form-control fo" name="level" aria-describedby="firstname" readonly>
                    </div>
                </div>
                <div class="content-form">
                    <div class="col-md-4">
                        <p class="p-label">ชื่อสถานประกอบการ</p>
                        <input type="text" value="<?php echo $row['Org_name']; ?>" class="form-control fo" name="Org_name" aria-describedby="email">
                    </div>
                    <div class="col-md-4">
                        <p class="p-label">ประเภทใบอนุญาต</p>
                        <input type="text" value="<?php echo $row['license_type']; ?>" class="form-control fo" name="license_type">
                    </div>
                </div>
                <div class="content-form">
                    <div class="col-md-4">
                        <p class="p-label">ใบอนุญาตเลขที่</p>
                        <input type="text" value="<?php echo $row['Id_card']; ?>" class="form-control fo" name="Id_card" aria-describedby="lastname">
                    </div>
                    <div class="col-md-7">
                        <p class="p-label">รหัสประจำตัวใบประกอบวิชาชีพ</p>
                        <input type="text" value="<?php echo $row['license_number']; ?>" class="form-control fo-1" name="license_number" aria-describedby="tel">
                    </div>
                </div>
                <!-- <div class="content-form">
                    <div class="one">
                        <div class="mm">
                            <label for="firstname" class="form-label" style="margin-bottom: 0px;">ชื่อ</label>
                            <input type="text" value="<?php echo $row['firstname']; ?>" class="form-control" name="firstname" aria-describedby="firstname">
                        </div>
                        <div class="mm">
                            <label for="email" class="form-label" style="margin-bottom: 0px;">อีเมล</label>
                            <input type="email" value="<?php echo $row['email']; ?>" class="form-control" name="email" aria-describedby="email">
                        </div>
                        <div class="mm">
                            <label for="line_Id" class="form-label" style="margin-bottom: 0px;">ไลน์ไอดี</label>
                            <input type="text" value="<?php echo $row['line_Id']; ?>" class="form-control" name="line_Id">
                        </div>
                    </div>
                    <div class="two">
                        <div class="mm">
                            <label for="lastname" class="form-label" style="margin-bottom: 0px;">นามสกุล</label>
                            <input type="text" value="<?php echo $row['lastname']; ?>" class="form-control" name="lastname" aria-describedby="lastname">
                        </div>
                        <div class="mm">
                            <label for="tel" class="form-label" style="margin-bottom: 0px;">โทรศัพท์</label>
                            <input type="tel" value="<?php echo $row['tel']; ?>" class="form-control" name="tel" aria-describedby="tel">
                        </div>
                    </div>
                    
                </div> -->
                <!-- <div class="content-form">
                    <div class="one">
                        <div class="mm">
                            <label for="firstname" class="form-label" style="margin-bottom: 0px;">ตำแหน่ง</label>
                            <input type="text" value="<?php echo $row['level']; ?>" class="form-control" name="level" aria-describedby="firstname" readonly>
                        </div>
                        <div class="mm">
                            <label for="email" class="form-label" style="margin-bottom: 0px;">ชื่อสถานประกอบการ/ร้านขายยา</label>
                            <input type="text" value="<?php echo $row['Org_name']; ?>" class="form-control" name="Org_name" aria-describedby="email">
                        </div>
                        <div class="mm">
                            <label for="line_Id" class="form-label" style="margin-bottom: 0px;">ประเภทใบอนุญาต</label>
                            <input type="text" value="<?php echo $row['license_type']; ?>" class="form-control" name="license_type">
                        </div>
                    </div>
                    <div class="two">
                        <div class="mm">
                            <label for="lastname" class="form-label" style="margin-bottom: 0px;">ใบอนุญาตเลขที่</label>
                            <input type="text" value="<?php echo $row['Id_card']; ?>" class="form-control" name="Id_card" aria-describedby="lastname">
                        </div>
                        <div class="mm">
                            <label for="tel" class="form-label" style="margin-bottom: 0px;">รหัสประจำตัวใบประกอบวิชาชีพ</label>
                            <input type="text" value="<?php echo $row['license_number']; ?>" class="form-control" name="license_number" aria-describedby="tel">
                        </div>
                    </div>
                    
                </div> -->
                <div class="btn-submit">
                    <button type="submit" name="update" class="btn" id="btn-save">บันทึก</button>
                </div>
            </div>
        </form>
    </div>
</div>


<style>
    .p-form-box {
        background-color: white;
        width: 90%;
        height: 700px;
        margin-top: 120px;
        box-shadow: 2px 2px 8px 4px rgba(0, 0, 0, 0.1);
    }

    .top-title {
        width: 100%;
        height: 60px;
        margin: 0 auto;
        padding: 20px 10px 0px 10px;
        margin-left: 20px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    .content {
        width: 100%;
        height: 30px;
        /* background-color: #aaa; */
        margin: 0 auto;
    }

    .text-title {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        padding: 10px;
    }

    .line-cut-center {
        width: 2px;
        height: 20px;
        background-color: #ccc;
        margin-left: 4px;
        margin-right: 4px;
    }

    .line-cut-bottom {
        width: 90%;
        height: 2px;
        margin: 0px 40px 0px 40px;
        background-color: #ccc;
    }

    span {
        font-size: 18px;
    }

    .content-form {
        display: flex;
        justify-content: flex-start;
        margin-left: 40px;
        margin-top: 5px;
    }

    .btn-submit {
        display: flex;
        justify-content: flex-start;
    }

    .mm {
        margin-right: 60px;
    }

    #btn-save {
        width: 120px;
        height: 40px;
        background-color: #1979FE;
        color: white;
        margin-left: 40px;
        margin-top: 20px;
        box-shadow: none;
    }
 
    .fo {
        width: 100%;
    }

    .fo-1 {
        width: 58%;
    }

    .p-label {
        width: 100%;
        margin: 0px;
    }

    @media screen and (max-width: 576px) {
        .p-form-box {
            background-color: white;
            width: 100%;
            height: 840px;
            margin-top: 120px;
            box-shadow: 2px 2px 8px 4px rgba(0, 0, 0, 0.1);
        }

        .top-title {
            width: 100%;
            height: 60px;
            margin: 0 auto;
            padding: 0px 0px 0px 35px;
            margin-left: 0px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .content {
            width: 100%;
            height: 30px;
            /* background-color: #aaa; */
            margin: 0 auto;
        }

        .text-title {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding: 0px;
        }

        .line-cut-center {
            width: 2px;
            height: 20px;
            background-color: #ccc;
            margin-left: 4px;
            margin-right: 4px;
        }

        .line-cut-bottom {
            width: 90%;
            height: 2px;
            margin: 0px 40px 0px 40px;
            background-color: #ccc;
        }

        span {
            font-size: 18px;
        }

        .content-form {
            display: flex;
            justify-content: flex-start;
            margin-left: 0px;
            margin-top: 5px;
        }

        .btn-submit {
            display: flex;
            justify-content: flex-start;
        }

        .mm {
            margin-right: 60px;
        }

        #btn-save {
            width: 120px;
            height: 40px;
            background-color: #1979FE;
            color: white;
            margin-left: 125px;
            margin-top: 20px;
            box-shadow: none;
        }
        .fo {
            width: 100%;
        }
        .fo-1 {
            width: 100%;
        }

        .p-label {
            width: 100%;
            margin: 0px;
        }
    }

    @media screen and (min-width: 1200px) {
        .p-form-box {
            background-color: white;
            width: 90%;
            height: 700px;
            margin-top: 120px;
            box-shadow: 2px 2px 8px 4px rgba(0, 0, 0, 0.1);
        }

        .top-title {
            width: 100%;
            height: 60px;
            margin: 0 auto;
            padding: 20px 10px 0px 10px;
            margin-left: 20px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .content {
            width: 100%;
            height: 30px;
            /* background-color: #aaa; */
            margin: 0 auto;
        }

        .text-title {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding: 10px;
        }

        .line-cut-center {
            width: 2px;
            height: 20px;
            background-color: #ccc;
            margin-left: 4px;
            margin-right: 4px;
        }

        .line-cut-bottom {
            width: 90%;
            height: 2px;
            margin: 0px 40px 0px 40px;
            background-color: #ccc;
        }

        span {
            font-size: 18px;
        }

        .content-form {
            display: flex;
            justify-content: flex-start;
            margin-left: 40px;
            margin-top: 5px;
        }

        .btn-submit {
            display: flex;
            justify-content: flex-start;
        }

        .mm {
            margin-right: 60px;
        }

        #btn-save {
            width: 120px;
            height: 40px;
            background-color: #1979FE;
            color: white;
            margin-left: 40px;
            margin-top: 20px;
            box-shadow: none;
        }
        .fo {
            width: 70%;
        }

        .fo-1 {
            width: 40%;
        }

        .p-label {
            width: 80%;
            margin: 0px;
        }
    }
</style>