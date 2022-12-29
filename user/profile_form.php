<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "../config/db.php";
error_reporting(0);
if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
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

    $sql = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, tel = :tel, line_Id = :line_Id WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->bindParam(":firstname", $firstname);
    $sql->bindParam(":lastname", $lastname);
    $sql->bindParam(":email", $email);
    $sql->bindParam(":tel", $tel);
    $sql->bindParam(":line_Id", $line_Id);
    $sql->execute();

    if ($sql) {
        //   echo "<script>alert('แก้ไขข้อมูลเสร็จสิ้น')</script>";
        echo "<meta http-equiv='Refresh' content='0.001; url=profile'>";
        // header("refresh:0.0000000001; url=profile");
    }
}


?>

<div class="p-form-box">
    <div class="top-title">
        <div class="text-title">
            <span>ข้อมูลทั่วไป</span>
            <div class="line-cut-center"></div>
            <span>ลูกค้าทั่วไป</span>
        </div>

    </div>
    <div class="line-cut-bottom"></div>
    <div class="content">
        <form action="profile_form" method="post">

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
                    </div>
                </div>
               
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

    .p-label {
        width: 80%;
        margin: 0px;
    }

    @media screen and (max-width: 576px) {
        .p-form-box {
            background-color: white;
            width: 100%;
            height: 700px;
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
            width: 100%;
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

        .p-label {
            width: 80%;
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

        .p-label {
            width: 80%;
            margin: 0px;
        }
    }
</style>