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

    <i class="bi bi-person-circle " style="font-size: 45px; margin-left: 35px; margin-right: 20px;"></i> <span id="regis-der">ลงทะเบียนสำหรับลูกค้า</span>
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
            <form id="signup_form" action="signup_db.php" method="post">
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

                    <div class="four mb-4" style="display: none;">
                        <div class="container address-form">
                            <div class="m4">
                                <label for="sel1">จังหวัด</label>
                                <select class="form-select" name="provinces" id="provinces">
                                    <option value="<?php echo isset($_SESSION['provinces']) ? $_SESSION['provinces'] : ""; ?>" selected disabled>-กรุณาเลือกจังหวัด-</option>
                                    <?php foreach ($query as $value) { ?>
                                        <option value="<?= $value['name_th'] ?>"><?= $value['name_th'] ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="m4">
                                <label for="sel1">อำเภอ</label>
                                <select class="form-select" name="amphures" id="amphures">
                                </select>
                            </div>
                            <div class="m4">
                                <label for="sel1">ตำบล</label>
                                <select class="form-select" name="districts" id="districts">
                                </select>
                            </div>
                            <div class="m4">
                                <label for="sel1">รหัสไปรษณีย์</label>
                                <input type="text" name="zip_code" id="zip_code" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="container" style="align-items: center; width: 95%; display: flex;padding-left: 0px;margin: 10px auto;">
                        <input type="checkbox" name="cb" id="cb" style="width: 50px; height: 20px;">
                        <span>ฉันยอมรับ <a href="privacy_policy.php" target="_blank">ข้อกำหนดและเงื่อนไข</a></span>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LcaGEcjAAAAACzinKev4IXpEXKd26T5Av6pXe4H" style="display: flex;justify-content: center;"></div>
                    <div class="container" style="display: flex; justify-content: center;">

                        <button type="submit" name="signup" class="btn" id="btn-signup">ลงทะเบียน</button>
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
<?php include('config/ad_script.php'); ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>