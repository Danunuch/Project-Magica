<?php
require_once('../config/db.php');
?>

<?php
session_start();
error_reporting(0);
require_once '../config/db.php';

if (isset($_POST['btn_insert'])) {
    // $_SESSION['firstname'] = $_POST['firstname'];
    // $_SESSION['lastname'] = $_POST['lastname'];
    // $_SESSION['email'] = $_POST['email'];
    // $_SESSION['tel'] = $_POST['tel'];
    // $_SESSION['password'] = $_POST['password'];
    // $_SESSION['line_Id'] = $_POST['line_Id'];
    // $_SESSION['address'] = $_POST['address'];
    // $_SESSION['m_img'] = $_FILES['m_img'];


    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $password = $_POST['password'];
    $line_Id = $_POST['line_Id'];
    $address =  $_POST['address'];
    $m_img =  $_FILES['m_img'];
    $urole = 'admin';

    $allow = array('jpg', 'jpeg', 'png');
    $extention = explode(".", $m_img['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt = strtolower(end($extention)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew = rand() . "." . $fileActExt;
    $filePath = "../admin/m_img/" . $fileNew;


    if (empty($firstname)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header("location: admin_add.php");
    } else if (empty($lastname)) {
        $_SESSION['error'] = 'กรุณากรอกนามสกุล';
        header("location: admin_add.php");
    } else if (empty($email)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
        header("location: admin_add.php");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        header("location: admin_add.php");
    } else if (strlen($_POST['tel']) < 10) {
        $_SESSION['error'] = 'กรุณาหมายเลขโทรศัพท์ให้ถูกต้อง';
        header("location: admin_add.php");
    } else if (strlen($_POST['tel']) > 10) {
        $_SESSION['error'] = 'กรุณาหมายเลขโทรศัพท์ให้ถูกต้อง';
        header("location: admin_add.php");
    } else if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: admin_add.php");
    } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 8) {
        $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 8-20 ตัวอักษร';
        header("location: admin_add.php");
    } else if (empty($line_Id)) {
        $_SESSION['error'] = 'กรุณากรอกไลน์ไอดี';
        header("location: admin_add.php");
    } else if (empty($address)) {
        $_SESSION['error'] = 'กรุณากรอกที่อยู่';
        header("location: admin_add.php");
    }
    //    // else if (empty($m_img)) {
    //         $_SESSION['error'] = 'กรุณาอัปโหลดรูปภาพ';
    //         header("location: admin_add.php");
    else {
        try {
            $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $check_email->bindParam(":email", $email);
            $check_email->execute();
            $row = $check_email->fetch(PDO::FETCH_ASSOC);

            if (in_array($fileActExt, $allow)) {
                if ($m_img['size'] > 0 && $m_img['error'] == 0) {
                    if (move_uploaded_file($m_img['tmp_name'], $filePath)) {
                        if ($row['email'] == $email) {
                            $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='../index.php'>คลิกที่นี่เพื่อเข้าสู่ระบบ</a> ";
                            // header("location: admin_add.php");
                        } else if (!isset($_SESSION['error'])) {
                            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                            $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, tel, password, line_Id, address, urole, m_img)
                                        VALUES(:firstname, :lastname, :email, :tel, :password, :line_Id, :address, :urole, :m_img)");
                            $stmt->bindParam(":firstname", $firstname);
                            $stmt->bindParam(":lastname", $lastname);
                            $stmt->bindParam(":email", $email);
                            $stmt->bindParam(":tel", $tel);
                            $stmt->bindParam(":password", $passwordHash);
                            $stmt->bindParam(":line_Id", $line_Id);
                            $stmt->bindParam(":address", $address);
                            $stmt->bindParam(":urole", $urole);
                            $stmt->bindParam(':m_img', $fileNew);
                            $stmt->execute();

                            if ($stmt) {
                                echo "<script>alert('เพิ่มผู้ใช้งานเรียบร้อยแล้ว')</script>";
                                header("refresh:0.00000001; url=admin.php");
                            } else {
                                echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                            }
                        }
                    } else {
                        $_SESSION['error'] = 'กรุณาอัปโหลดรูปภาพ';
                        header("location: admin_add.php");
                    }
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
