<?php
include('menu_l.php');
require_once('../config/db.php');

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
            <div class="col-md-12 col-sm-12 " style="height: 1024px;">
                <div class="dashboard_graph">

                    <div class="col-md-6">
                        <h3>เพิ่มผู้ใช้งานทั่วไป</h3>
                    </div> <br>

                    <form id="admin_add_form" action="admin_add_db.php" method="POST" class="form-horizontal mt-5" enctype="multipart/form-data">
                        <div class="form-group text-center" color="#0000">
                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <label for="firstname" class="form-label" style="margin-bottom: 0px;">ชื่อ</label>
                                    <input type="text" class="form-control" name="firstname" aria-describedby="firstname">
                                </div>

                                <div class="col" align="left">
                                    <label for="lastname" class="form-label" style="margin-bottom: 0px;">นามสกุล</label>
                                    <input type="text" class="form-control" name="lastname" aria-describedby="lastname">
                                </div>
                            </div>
                        </div>

                        <div class="row gx-5">
                            <div class="col" align="left">
                                <label for="email" class="form-label" style="margin-bottom: 0px;">อีเมล</label>
                                <input type="email" class="form-control" name="email" aria-describedby="email">
                            </div>

                            <div class="col" align="left">
                                <label for="password" class="form-label" style="margin-bottom: 0px;">รหัสผ่าน</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <br>
                        <div class="row gx-5">
                            <div class="col" align="left">
                                <label for="line_Id" class="form-label" style="margin-bottom: 0px;">ไลน์ไอดี</label>
                                <input type="text" class="form-control" name="line_Id" aria-describedby="line_Id">
                            </div>
                            <div class="col" align="left">
                                <label for="tel" class="form-label" style="margin-bottom: 0px;">โทรศัพท์</label>
                                <input type="tel" class="form-control" maxlength="10" name="tel" aria-describedby="tel">
                            </div>
                        </div>

                        <br>
                        <div class="row gx-5">
                            <div class="col" align="left">
                                <label for="address" class="form-label" id="label-address" style="margin-bottom: 0px;">ที่อยู่</label>
                                <input type="text" class="form-control" name="address" id="address" aria-describedby="address">
                            </div>

                            <div class="col" align="left">
                                <label for="urole" class="form-label" style="margin-bottom: 0px;">สถานะ</label>
                                <select class="form-control" name="urole" id="">
                                    <option value="">เลือกข้อมูล</option>
                                    <option value="admin">ผู้ดูแลระบบ</option>
                                    <option value="marketing">ฝ่ายการตลาด</option>
                                </select>
                            </div>
                        </div>

                        <br>
                        <div class="row gx-5">
                            <div class="col" style="display: inline-flex;" align="left">
                                <label for="m_img" class="col-form-label" style="margin-bottom: 0px;">รูปภาพ </label>
                                <div class="filewrap">
                                    <input name="m_img" id="imgInput" class="form-control" type="file" />
                                    <img width="100%" id="previewImg" alt="">
                                </div>
                            </div>
                        </div>


                        <div class="form-group text-center">
                            <div class="col-md-12 mt-3">
                                <input type="submit" name="btn_insert" class="btn btn-success" value="บันทึกข้อมูล"> &nbsp;&nbsp;
                                <a href="admin.php" class="btn btn-danger">ยกเลิก</a>
                            </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>


        <script>
            let imgInput = document.getElementById('imgInput');
            let previewIm = document.getElementById('previewImg');


            imgInput.onchange = evt => {
                const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file);
                }
            }
        </script>
    </div>

</body>