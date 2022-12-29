<?php
session_start();
require_once '../config/db.php';
if (!isset($_SESSION['admin_login'])) {
  $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
  header("location: signin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="../admin/images/linklogo.png">
  <title>MAGICA</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <!-- CSS only -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
  <!-- JavaScript Bundle with Popper -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://kit.fontawesome.com/79e49f6348.js" crossorigin="anonymous">
  <meta name="robots" content="index, nofollow">

  <!-- Custom Theme Style -->
  <link href="build/css/custom.min.css" rel="stylesheet">
  <script nonce="beb9f444-51ca-42c3-8ba6-2a8968356cb3">
    (function(w, d) {
      ! function(a, e, t, r) {
        a.zarazData = a.zarazData || {};
        a.zarazData.executed = [];
        a.zaraz = {
          deferred: []
        };
        a.zaraz.q = [];
        a.zaraz._f = function(e) {
          return function() {
            var t = Array.prototype.slice.call(arguments);
            a.zaraz.q.push({
              m: e,
              a: t
            })
          }
        };
        for (const e of ["track", "set", "ecommerce", "debug"]) a.zaraz[e] = a.zaraz._f(e);
        a.zaraz.init = () => {
          var t = e.getElementsByTagName(r)[0],
            z = e.createElement(r),
            n = e.getElementsByTagName("title")[0];
          n && (a.zarazData.t = e.getElementsByTagName("title")[0].text);
          a.zarazData.x = Math.random();
          a.zarazData.w = a.screen.width;
          a.zarazData.h = a.screen.height;
          a.zarazData.j = a.innerHeight;
          a.zarazData.e = a.innerWidth;
          a.zarazData.l = a.location.href;
          a.zarazData.r = e.referrer;
          a.zarazData.k = a.screen.colorDepth;
          a.zarazData.n = e.characterSet;
          a.zarazData.o = (new Date).getTimezoneOffset();
          a.zarazData.q = [];
          for (; a.zaraz.q.length;) {
            const e = a.zaraz.q.shift();
            a.zarazData.q.push(e)
          }
          z.defer = !0;
          for (const e of [localStorage, sessionStorage]) Object.keys(e || {}).filter((a => a.startsWith(
            "_zaraz_"))).forEach((t => {
            try {
              a.zarazData["z_" + t.slice(7)] = JSON.parse(e.getItem(t))
            } catch {
              a.zarazData["z_" + t.slice(7)] = e.getItem(t)
            }
          }));
          z.referrerPolicy = "origin";
          z.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(a.zarazData)));
          t.parentNode.insertBefore(z, t)
        };
        ["complete", "interactive"].includes(e.readyState) ? zaraz.init() : a.addEventListener(
          "DOMContentLoaded", zaraz.init)
      }(w, d, 0, "script");
    })(window, document);
  </script>
</head>
<style>
  .body {
    font-family: 'Kanit', sans-serif;
    width: auto;
    height: auto;
  }
</style>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.php" class="site_title"><img src="../admin/images/link logo.png" height="50px" width="50px"><span> MAGICA</span></a>
          </div>
          <div class="clearfix"></div>


          <?php
          if (isset($_SESSION['admin_login'])) {
            $user_id = $_SESSION['admin_login'];
            $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
          }
          ?>

          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="../admin/m_img/<?php if ($row['m_img'] == null) {
                                          echo "icon-profile.png";
                                        } else {
                                          echo $row['m_img'];
                                        }
                                        ?> " class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome</span>
              <h2><?php echo $row['firstname'] . ' ' . $row['lastname'] ?></h2>
            </div>
          </div>

          <br />

          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i> หน้าหลัก <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="index.php">สรุปยอดต่าง ๆ </a></li>
                    <li><a href="report1.php">รายงานการขายสินค้า (Excel)</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i> จัดการผู้ใช้งาน <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="admin.php">ผู้ใช้งานทั่วไป</a></li>
                    <li><a href="dealer_general.php">ตัวแทนจำหน่าย (ทั่วไป)</a></li>
                    <li><a href="dealer.php">ตัวแทนจำหน่าย (สถานประกอบการ) </a></li>
                    <li><a href="admin_add.php">เพิ่มผู้ใช้งานทั่วไป</a></li>

                  </ul>
                </li>
                <li><a><i class="fa fa-filter"></i> จัดการประเภท <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="type.php">รายการประเภทสินค้า</a></li>
                    <li><a href="type_add.php">เพิ่มประเภทสินค้า</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-shopping-basket"></i> จัดการสินค้า <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="product.php">รายการสินค้าลูกค้าทั่วไป</a></li>
                    <li><a href="product_dealer.php">รายการสินค้าตัวแทนจำหน่าย</a></li>
                    <li><a href="product_add.php">เพิ่มสินค้า (ลูกค้าทั่วไป)</a></li>
                    <li><a href="product_dealer_add.php">เพิ่มสินค้า (ตัวแทนจำหน่าย)</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-check-square-o"></i> คำสั่งซื้อ <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="order.php">คำสั่งซื้อสินค้า</a></li>

                  </ul>
                </li>
                <li><a><i class="fa fa-truck"></i> จัดส่งสินค้า<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="delivery.php">รายการจัดส่ง</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-user"></i> บัญชีของฉัน <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="profile_edit.php">แก้ไขข้อมูลส่วนตัว</a></li>
                    <li><a href="password_edit.php">เปลี่ยนรหัสผ่าน</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="menu_section">
              </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="top_nav">
        <div class="nav_menu">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <img src="../admin/m_img/<?php if ($row['m_img'] == null) {
                                              echo "icon-profile.png";
                                            } else {
                                              echo $row['m_img'];
                                            }
                                            ?> "><?php echo $row['firstname'] . ' ' . $row['lastname'] ?>
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="profile_edit.php"><i class="fa fa-user pull-right"></i>
                    บัญชีของฉัน</a>
                  <a class="dropdown-item" href="../logout.php"><i class="fa fa-sign-out pull-right"></i> ออกจากระบบ</a>
                </div>
              </li>

              </a>
        </div>
        </li>
        </ul>
        </li>
        </ul>
        </nav>
      </div>
    </div>



    <script src="../admin/vendors/jquery/dist/jquery.min.js"></script>

    <script src="../admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../admin/vendors/fastclick/lib/fastclick.js"></script>

    <script src="../admin/vendors/nprogress/nprogress.js"></script>

    <script src="../admin/vendors/Chart.js/dist/Chart.min.js"></script>

    <script src="../admin/vendors/gauge.js/dist/gauge.min.js"></script>

    <script src="../admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

    <script src="../admin/vendors/iCheck/icheck.min.js"></script>

    <script src="../admin/vendors/skycons/skycons.js"></script> 
    <!-- ** -->

    <script src="../admin/vendors/Flot/jquery.flot.js"></script>
    <script src="../admin/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../admin/vendors/Flot/jquery.flot.time.js"></script>
    <script src="../admin/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../admin/vendors/Flot/jquery.flot.resize.js"></script>

    <script src="../admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../admin/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../admin/vendors/flot.curvedlines/curvedLines.js"></script>

    <script src="../admin/vendors/DateJS/build/date.js"></script>

    <script src="../admin/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>

    <script src="../admin/vendors/moment/min/moment.min.js"></script>
    <script src="../admin/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="../admin/build/js/custom.min.js"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"7464c807e8f846d3","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2022.8.1","si":100}' crossorigin="anonymous"></script>
</body>

</html>