<?php
include('menu_l.php');
require_once('../config/db.php');

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

    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    // $password = $_POST['password'];
    $line_Id = $_POST['line_Id'];
    $address =  $_POST['address'];
    $m_img =  $_FILES['m_img'];
    $urole = 'admin';

    $allow = array('jpg', 'jpeg', 'png');
    $extention = explode(".", $m_img['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt = strtolower(end($extention)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew = rand() . "." . $fileActExt;
    $filePath = "../admin/m_img/" . $fileNew;

            if (in_array($fileActExt, $allow)) {
                if ($m_img['size'] > 0 && $m_img['error'] == 0) {
                    if (move_uploaded_file($m_img['tmp_name'], $filePath)) {
                        $insert_stmt = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email , tel = :tel , line_Id = :line_Id ,
                                                                        address = :address, m_img = :m_img WHERE id = :id");
                        $insert_stmt->bindParam(':id', $id);
                        $insert_stmt->bindParam(':firstname', $firstname);
                        $insert_stmt->bindParam(':lastname', $lastname);
                        $insert_stmt->bindParam(':email', $email);
                        $insert_stmt->bindParam(':tel', $tel);
                        $insert_stmt->bindParam(':line_Id', $line_Id);
                        $insert_stmt->bindParam(':address', $address);
                        $insert_stmt->bindParam(':m_img', $fileNew);
                        $insert_stmt->execute();

                        if ($insert_stmt) {
                            echo "<script>alert('แก้ไขข้อมูลผู้ใช้งานเรียบร้อยแล้ว')</script>";
                            echo "<meta http-equiv='Refresh' content='0.001; url=profile_edit.php'>";
                        } else {
                            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                        }
                    }
                }
            } else {
                $insert_stmt = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email , tel = :tel , line_Id = :line_Id ,
                address = :address WHERE id = :id");
                $insert_stmt->bindParam(':id', $id);
                $insert_stmt->bindParam(':firstname', $firstname);
                $insert_stmt->bindParam(':lastname', $lastname);
                $insert_stmt->bindParam(':email', $email);
                $insert_stmt->bindParam(':tel', $tel);
                $insert_stmt->bindParam(':line_Id', $line_Id);
                $insert_stmt->bindParam(':address', $address);
          
                $insert_stmt->execute();

                if ($insert_stmt) {
                    echo "<script>alert('แก้ไขข้อมูลผู้ใช้งานเรียบร้อยแล้ว')</script>";
                    echo "<meta http-equiv='Refresh' content='0.001; url=profile_edit.php'>";
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                }
    
    }
}
