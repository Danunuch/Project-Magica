<?php
include('menu_l.php');
require_once('../config/db.php');

if (isset($_SESSION["admin_login"])) {
    $query = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $query->bindParam(":id", $_SESSION["admin_login"]);
    $query->execute();
    $q_user = $query->fetch(PDO::FETCH_ASSOC);
}

if (isset($_REQUEST['update_id'])) {
    try {
        $id = $_REQUEST['update_id'];
        $select_stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

if (isset($_POST['btn_update'])) {
    // $_SESSION['firstname'] = $_POST['firstname'];
    // $_SESSION['lastname'] = $_POST['lastname'];
    // $_SESSION['email'] = $_POST['email'];
    // $_SESSION['tel'] = $_POST['tel'];
    // $_SESSION['password'] = $_POST['password'];
    // $_SESSION['line_Id'] = $_POST['line_Id'];
    // $_SESSION['address'] = $_POST['address'];
    // $_SESSION['m_img'] = $_FILES['m_img'];

    $id = $q_user["id"];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];


    if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: password_edit.php");
    } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 8) {
        $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 8-20 ตัวอักษร';
        header("location: password_edit.php");
    } else if (empty($c_password)) {
        $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
        header("location: password_edit.php");
    } else if ($password != $c_password) {
        $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
        header("location: password_edit.php");
    } else {
        try {
            if (!isset($_SESSION['error'])) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE  users  SET password = :password WHERE id = :id");

                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":password", $passwordHash);
                $stmt->execute();

                if($stmt){
                    echo "<script>alert('แก้ไขรหัสผ่านผู้ใช้งานเรียบร้อยแล้ว')</script>";
                    echo "<meta http-equiv='Refresh' content='0.001; url=profile_edit.php'>";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
