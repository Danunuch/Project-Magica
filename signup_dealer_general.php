<?php

session_start();
require_once 'config/db.php';
error_reporting(0);
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - MAGICA</title>
    <link rel="stylesheet" href="asset/css/web_tablet_style.css?v=<?php echo time(); ?>">
</head>

<?php
$sql_provinces = $conn->query("SELECT * FROM provinces");
$sql_provinces->execute();
$query = $sql_provinces->fetchAll();
?>
<!-- //// Header //// -->

<!-- //// Header //// -->

<?php include('header.php') ?>
<!-- /////  Content //////-->
<div class="bg-text-regis">

    <i class="bi bi-person-circle " style="font-size: 45px; margin-left: 35px; margin-right: 20px;"></i> <span id="regis-der">ลงทะเบียนสำหรับตัวแทนจำหน่าย</span>
</div>

<p id="text-title-signin">
    กรุณากรอกข้อมูลของท่านให้ถูกต้องครบถ้วน เพื่อใช้ในการลงทะเบียน</p>
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
<div class="bg-regis">
    <div class="bg-f-regis">
        <p style="font-size: 24px;padding-left: 25px; padding-top: 20px;"><b>ข้อมูลส่วนบุคคล</b></p>
        <div class=" pos-form">
            <form id="signup_form" action="signup_dealer_general_db.php" method="post">
                <div class="form-group">
                <div class="content-form">
                        <div class="col-md-6">
                            <p class="p-label">ชื่อ</p>
                            <input type="text" value="<?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] : ""; ?>" class="form-control" name="firstname" id="firstname" aria-describedby="firstname">

                        </div>
                        <div class="col-md-6">
                            <p class="p-label">นามสกุล</p>
                            <input type="text" value="<?php echo isset($_SESSION['lastname']) ? $_SESSION['lastname'] : ""; ?>" class="form-control" name="lastname" id="lastname" aria-describedby="lastname">
                        </div>
                    </div>
                    <div class="content-form">
                        <div class="col-md-6">
                            <p class="p-label">อีเมล</p>
                            <input type="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ""; ?>" class="form-control" name="email" id="email" aria-describedby="email">
                        </div>
                        <div class="col-md-6">
                            <p class="p-label">โทรศัพท์</p>
                            <input type="tel" value="<?php echo isset($_SESSION['tel']) ? $_SESSION['tel'] : ""; ?>" class="form-control" maxlength="10" name="tel" id="tel" aria-describedby="tel">
                        </div>
                    </div>
                    <div class="content-form">
                        <div class="col-md-6">
                            <p class="p-label">รหัสผ่าน</p>
                            <input type="password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ""; ?>" class="form-control" id="password" name="password">
                        </div>
                        <div class="col-md-6">
                            <p class="p-label">ยืนยันรหัสผ่าน</p>
                            <input type="password" value="<?php echo isset($_SESSION['c_password']) ? $_SESSION['c_password'] : ""; ?>" class="form-control" id="c_password" name="c_password">
                        </div>
                    </div>
                    <div class="content-form">
                        <div class="col-md-6">
                            <p class="p-label">ไลน์ไอดี</p>
                            <input type="text" value="<?php echo isset($_SESSION['line_Id']) ? $_SESSION['line_Id'] : ""; ?>" class="form-control" name="line_Id" id="line_Id" aria-describedby="line_Id">
                        </div>
                        <div class="col-md-6">
                            <p class="p-label">ที่อยู่</p>
                            <input type="text" value="<?php echo isset($_SESSION['address']) ? $_SESSION['address'] : ""; ?>" class="form-control" name="address" id="address" aria-describedby="address">
                        </div>
                    </div>
                    <div class="content-form">
                        <div class="col-md-6">
                            <p class="p-label">เลขบัตรประจำตัวประชาชน</p>
                            <input type="tel" value="" class="form-control" maxlength="13" name="Id_card" id="Id_card" aria-describedby="Id_card">
                        </div>
                        <div class="col-md-6">
                            <!-- <p class="p-label">ที่อยู่</p>
                            <input type="text" value="<?php echo isset($_SESSION['address']) ? $_SESSION['address'] : ""; ?>" class="form-control" name="address" id="address" aria-describedby="address"> -->
                        </div>
                    </div>
    
                <!-- <div class="content-form">
                        <div class="one">
                            <div class="mm">
                                <label for="firstname" class="form-label" style="margin-bottom: 0px;">ชื่อ</label>
                                <input type="text" value="<?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] : ""; ?>" class="form-control" name="firstname" aria-describedby="firstname">
                            </div>
                            <div class="mm">
                                <label for="email" class="form-label" style="margin-bottom: 0px;">อีเมล</label>
                                <input type="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ""; ?>" class="form-control" name="email" aria-describedby="email">
                            </div>
                            <div class="mm">
                                <label for="password" class="form-label" style="margin-bottom: 0px;">รหัสผ่าน</label>
                                <input type="password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ""; ?>" class="form-control" name="password">
                            </div>
                            <div class="mm">
                                <label for="line_Id" class="form-label" style="margin-bottom: 0px;">ไลน์ไอดี</label>
                                <input type="text" value="<?php echo isset($_SESSION['line_Id']) ? $_SESSION['line_Id'] : ""; ?>" class="form-control" name="line_Id" aria-describedby="line_Id">
                            </div>
                        </div>
                        <div class="two">
                            <div class="mm">
                                <label for="lastname" class="form-label" style="margin-bottom: 0px;">นามสกุล</label>
                                <input type="text" value="<?php echo isset($_SESSION['lastname']) ? $_SESSION['lastname'] : ""; ?>" class="form-control" name="lastname" aria-describedby="lastname">
                            </div>
                            <div class="mm">
                                <label for="tel" class="form-label" style="margin-bottom: 0px;">โทรศัพท์</label>
                                <input type="tel" value="<?php echo isset($_SESSION['tel']) ? $_SESSION['tel'] : ""; ?>" class="form-control" maxlength="10" name="tel" aria-describedby="tel">
                            </div>
                            <div class="mm">
                                <label for="confirm password" class="form-label" style="margin-bottom: 0px;">ยืนยันรหัสผ่าน</label>
                                <input type="password" value="<?php echo isset($_SESSION['c_password']) ? $_SESSION['c_password'] : ""; ?>" class="form-control" name="c_password">
                            </div>
                            <div class="mm">
                                <label for="Id_card" class="form-label" style="margin-bottom: 0px;">เลขบัตรประจำตัวประชาชน</label>
                                <input type="tel" value="" class="form-control" maxlength="13" name="Id_card" aria-describedby="Id_card">
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="three">

                        <label for="address" class="form-label" id="label-address" style="margin-bottom: 0px;">ที่อยู่</label>
                        <input type="text" value="<?php echo isset($_SESSION['address']) ? $_SESSION['address'] : ""; ?>" class="form-control" name="address" id="address" aria-describedby="address">

                    </div> -->
                   
                    <div class="container" style="align-items: center; display: flex;padding-left: 0px; margin-left: 0px; margin-bottom: 30px;">
                        <input type="checkbox" name="cb" id="cb" style="width: 50px; height: 20px;">
                        <span>ฉันยอมรับ <a href="privacy_policy.php" target="_blank">ข้อกำหนดและเงื่อนไข</a></span>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LcaGEcjAAAAACzinKev4IXpEXKd26T5Av6pXe4H" style="display: flex;justify-content: center;"></div>
                    <div class="container" style="display: flex; justify-content: center;">
                        <button type="submit" name="signup_dealer_general" class="btn" id="btn-signup">ลงทะเบียน</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ///// Footer   -->
<?php include('footer.php') ?>
<!-- ///// Footer   -->

<script src="action.js"></script>

<style>
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php include('config/ad_script.php'); ?>