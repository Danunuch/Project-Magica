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
            <div class="col-md-12 col-sm-12 " style="height: 1500px;">
                <div class="dashboard_graph">

                    <div class="col-md-6">
                        <h3>แก้ไขข้อมูลผู้ใช้งานทั่วไป</h3>
                    </div> <br>
                    <?php
                    if (isset($errorMsg)) {
                    ?>
                        <div class="alert alert-danger">
                            <strong>Wrong! <?php echo $errorMsg; ?></strong>
                        </div>
                    <?php } ?>


                    <?php
                    if (isset($updateMsg)) {
                    ?>
                        <div class="alert alert-success">
                            <strong>Success! <?php echo $updateMsg; ?></strong>
                        </div>
                    <?php } ?>
                    <br>
                    <form id="password_edit_form" action="password_edit_db.php" method="POST" class="form-horizontal mt-5" enctype="multipart/form-data">

                        <?php
                        if (isset($_GET['update_id'])) {
                            $id = $_GET['update_id'];
                            $select_stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
                            $select_stmt->bindParam(":id", $id);
                            $select_stmt->execute();
                            $data_id_users = $select_stmt->fetchAll();
                        }

                        ?>

                        <div class="form-group text-center">
                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="password" class="form-label" style="margin-bottom: 0px;">รหัสผ่านใหม่</label>
                                        <input type="password" class="form-control"  name="password">
                                    </div>
                                </div>

                                <div class="col" align="left">
                                    <div class="p-3 "><label for="c_password" class="form-label" style="margin-bottom: 0px;">ยันยันรหัสผ่านใหม่</label>
                                        <input type="password" class="form-control" name="c_password">
                                    </div>
                                </div>
                            </div>




                            <div class="form-group text-center">
                                <div class="col-md-12 mt-3">
                                    <input type="submit" name="btn_update" class="btn btn-success" value="บันทึกข้อมูล"> &nbsp;&nbsp;
                                    <a href="profile_edit.php" class="btn btn-danger">ยกเลิก</a>
                                </div>
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