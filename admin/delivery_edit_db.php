<?php
include('menu_l.php');
require_once('../config/db.php');

if (isset($_REQUEST['update_id'])) {
    try {
        $id = $_REQUEST['update_id'];
        $select_stmt = $conn->prepare("SELECT * FROM orders WHERE order_Id = :order_Id");
        $select_stmt->bindParam(':order_Id', $id);
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


    $order_Id = $_POST['order_Id'];
    $parcel_code  = $_POST['parcel_code'];
    $shipping_name = $_POST['shipping_name'];
 
   




     if (empty($parcel_code)) {
         $_SESSION['error'] = 'กรุณากรอกหมายเลขพัสดุ';
         header("location: order_edit.php");
    //  } else
    //  if (empty($status_order)) {
    //     $_SESSION['error'] = 'กรุณาอนุมัติคำสั่งซื้อ';
    //     header("location: order_edit.php");
    }
    //     if (empty($m_img)) {
    //         $_SESSION['error'] = 'กรุณาอัปโหลดรูปภาพ';
    //         header("location: admin_add.php");
    else {
        try {
            $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $check_email->bindParam(":email", $email);
            $check_email->execute();
            $row = $check_email->fetch(PDO::FETCH_ASSOC);

        if (!isset($_SESSION['error'])){ 
                        $insert_stmt = $conn->prepare("UPDATE orders SET  parcel_code =:parcel_code, shipping_company =:shipping_name WHERE order_Id = :order_Id");
                        $insert_stmt->bindParam(':order_Id', $order_Id);
                        $insert_stmt->bindParam(':parcel_code', $parcel_code);
                        $insert_stmt->bindParam(':shipping_name', $shipping_name);
                        $insert_stmt->execute();

                        if ($insert_stmt) {
                            echo "<script>alert('แก้ไขข้อมูลคำสั่งซื้อเรียบร้อยแล้ว')</script>";
                            echo "<meta http-equiv='Refresh' content='0.001; url=delivery.php'>";
                            //$updateMsg = "เพิ่มสินค้าเรียบร้อยแล้ว";

                            // header("refresh:2;product.php");
                        } else {
                            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                        }
                    }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
