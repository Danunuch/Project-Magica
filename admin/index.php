<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<?php include('menu_l.php'); ?>
<style>
  .body {
    font-family: 'Kanit', sans-serif;

  }

  .m {
    width: 200px;
  }

  .lable-text {
    display: block;
    font-size: 30px;
    color: #000000;
  }

  .board-1 {
    width: 450px;
    height: 120px;
    margin: 10px auto;
    display: flex;
    text-align: center;
    justify-content: center;
    align-items: center;
    color: #000000;
    border-radius: 10px;
    background-color: #FFFFFF;
  }

  .board-2 {
    width: 450px;
    height: 120px;
    margin: 10px auto;
    display: flex;
    text-align: center;
    justify-content: center;
    align-items: center;
    color: #000000;
    border-radius: 10px;
    background-color: #FFFFFF;
  }

  .board-3 {
    width: 450px;
    height: 120px;
    margin: 10px auto;
    display: flex;
    text-align: center;
    justify-content: center;
    align-items: center;
    color: #000000;
    border-radius: 10px;
    background-color: #FFFFFF;
  }

  .board-4 {
    width: 450px;
    height: 120px;
    margin: 10px auto;
    display: flex;
    text-align: center;
    justify-content: center;
    align-items: center;
    color: #000000;
    border-radius: 10px;
    background-color: #FFFFFF;
  }


  .dashboard_graph {
    display: block;
    text-align: center;
    justify-content: center;
    background-color: #2A3F54;
  }

  @media screen and (min-width: 1200px) {
    .lable-text {
      display: block;
      font-size: 30px;
      color: #000000;
    }

    .board-1 {
      width: 450px;
      height: 120px;
      margin: 10px;
      display: flex;
      text-align: center;
      justify-content: center;
      align-items: center;
      color: #000000;
      border-radius: 10px;
      background-color: #FFFFFF;
    }

    .board-2 {
      width: 450px;
      height: 120px;
      margin: 10px;
      display: flex;
      text-align: center;
      justify-content: center;
      align-items: center;
      color: #000000;
      border-radius: 10px;
      background-color: #FFFFFF;
    }

    .board-3 {
      width: 450px;
      height: 120px;
      margin: 10px;
      display: flex;
      text-align: center;
      justify-content: center;
      align-items: center;
      color: #000000;
      border-radius: 10px;
      background-color: #FFFFFF;
    }

    .board-4 {
      width: 450px;
      height: 120px;
      margin: 10px;
      display: flex;
      text-align: center;
      justify-content: center;
      align-items: center;
      color: #000000;
      border-radius: 10px;
      background-color: #FFFFFF;
    }


    .dashboard_graph {
      display: flex;
      justify-content: center;
      background-color: #2A3F54;
    }

  }

  @media screen and (max-width: 576px) {
    .lable-text {
      display: block;
      font-size: 30px;
      color: #000000;
    }

    .board-1 {
      width: 100%;
      height: 120px;
      margin: 10px;
      display: flex;
      text-align: center;
      justify-content: center;
      align-items: center;
      color: #000000;
      border-radius: 10px;
      background-color: #FFFFFF;
    }

    .board-2 {
      width: 100%;
      height: 120px;
      margin: 10px;
      display: flex;
      text-align: center;
      justify-content: center;
      align-items: center;
      color: #000000;
      border-radius: 10px;
      background-color: #FFFFFF;
    }

    .board-3 {
      width: 100%;
      height: 120px;
      margin: 10px;
      display: flex;
      text-align: center;
      justify-content: center;
      align-items: center;
      color: #000000;
      border-radius: 10px;
      background-color: #FFFFFF;
    }

    .board-4 {
      width: 100%;
      height: 120px;
      margin: 10px;
      display: flex;
      text-align: center;
      justify-content: center;
      align-items: center;
      color: #000000;
      border-radius: 10px;
      background-color: #FFFFFF;
    }


    .dashboard_graph {
      display: block;
      justify-content: center;
      background-color: #2A3F54;
    }
  }
</style>

<?php
error_reporting(0);

$select_u = $conn->prepare("SELECT * FROM users");
$select_u->execute();
$row_u = $select_u->fetchAll();
$u = count($row_u);

$select_stmt = $conn->prepare("SELECT * FROM dealer ");
$select_stmt->execute();
$row = $select_stmt->fetchAll();
$select_g = $conn->prepare("SELECT * FROM dealer_general");
$select_g->execute();
$row_g = $select_g->fetchAll();
$c = count($row);
$g = count($row_g);

$select_stmt = $conn->prepare("SELECT * FROM dealer ");
$select_stmt->execute();
$row = $select_stmt->fetchAll();

$select_g = $conn->prepare("SELECT * FROM dealer_general");
$select_g->execute();
$row_g = $select_g->fetchAll();


$c = count($row);
$g = count($row_g);


$dealer =  "dealer";
$dealer_gen = "dealer_general";
$user = "user";

// order dealer
$select_price_d = $conn->prepare("SELECT * FROM orders WHERE urole =  :dealer ");
$select_price_d->bindParam(":dealer", $dealer);
$select_price_d->execute();
$price_d = $select_price_d->fetchAll();

// query order derler_gen
$select_price_dg = $conn->prepare("SELECT * FROM orders WHERE urole =  :dealer_gen ");
$select_price_dg->bindParam(":dealer_gen", $dealer_gen);
$select_price_dg->execute();
$price_dg = $select_price_dg->fetchAll();

// query order user
$select_price_user = $conn->prepare("SELECT * FROM orders WHERE urole =  :user ");
$select_price_user->bindParam(":user", $user);
$select_price_user->execute();
$price_user = $select_price_user->fetchAll();

// push price dealer to array
for ($i = 0; $i < count($price_d); $i++) {
  $total[] = $price_d[$i]["total_price"];
}

//push price dealer_gen to array
for ($i = 0; $i < count($price_dg); $i++) {
  $total_dg[] = $price_dg[$i]["total_price"];
}

//push price user to array
for ($i = 0; $i < count($price_user); $i++) {
  $total_user[] = $price_user[$i]["total_price"];
}

// calculate price dealer
if ($price_d != null) {
  for ($i = 0; $i < count($total); $i++) {
    $result_price = $result_price + $total[$i];
  }
} else {
}


// calculate price dealer_gen
if ($price_dg != null) {
  for ($i = 0; $i < count($total_dg); $i++) {
    $result_price_dg = $result_price_dg + $total_dg[$i];
  }
} else {
  $last_price_dealer = "-";
}

if ($result_price != null || $result_price_dg != null) {
  $last_price_dealer = $result_price + $result_price_dg;
  number_format($last_price_dealer, 2);
}



// calculate price user
if ($price_user != null) {
  for ($i = 0; $i < count($total_user); $i++) {
    $result_price_user = $result_price_user + $total_user[$i];
    number_format($result_price_user, 2);
  }
} else {
  $result_price_user = "-";
}




//แผนภาพ

$select_stmt = $conn->prepare("SELECT * FROM orders");
$select_stmt->execute();
$row_info = $select_stmt->fetchAll();
$row = array_reverse($row_info);

if (isset($_GET['submit_search'])) {

  if (isset($_GET['date1']) && isset($_GET['date2'])) {
    $order_date1 = $_GET['date1'];
    $order_date2 = $_GET['date2'];
    $stmt = $conn->prepare("SELECT * FROM `orders` WHERE `order_date` BETWEEN ? AND ?");
    // $stmt->bindParam(":date1", $order_date1);
    // $stmt->bindParam(":date2", $order_date2);
    $stmt->execute(array($order_date1, $order_date2));
    $row_info = $stmt->fetchAll();
    $row = array_reverse($row_info);
  }
}
?>



<body>

  <div class="right_col" role="main">
    <div class="row" style="display: flex; width: 100%; justify-content: center;align-items: center;">
      <div class="tile_count">
        <div class="col-md-12   tile_stats_count">
          <div class="count green">
            <marquee direction="left"> ยินดีต้อนรับสู่ MAGICA SYSTEM </marquee>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-sm-12 " style="height: 1024px;">
          <div class="dashboard_graph">
            <div class="row x_title">
              <div class="col-md-6">
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12 ">
                  <div class="dashboard_graph">
                    <div class="board-1">
                      <div class="lable-text">
                        <span style=" font-size: 18px; color: #000000;"><i class="fa fa-bar-chart"></i> ยอดขายตัวแทนจำหน่าย(บาท) </span>
                        <div class="count green"> <?php echo number_format($last_price_dealer, 2);  ?> </div>
                      </div>

                    </div>
                    <div class="board-2">
                      <div class="lable-text">
                        <span style=" font-size: 18px; color: #000000;"><i class="fa fa-bar-chart"></i> ยอดขายลูกค้าทั่วไป(บาท) </span>
                        <div class="count green"> <?php echo number_format($result_price_user, 2);  ?> </div>
                      </div>
                    </div>

                  </div>
                  <div class="dashboard_graph">
                    <div class="board-3">
                      <div class="lable-text">
                        <span style=" font-size: 18px; color: #000000;"><i class="fa fa-users"></i> จำนวนตัวแทนจำหน่าย(คน) </span>
                        <div class="count green"> <?php echo $c + $g ?> </div>
                      </div>
                    </div>
                    <div class="board-4">
                      <div class="lable-text">
                        <div class="count green"></div>
                        <span style=" font-size: 18px; color: #000000;"><i class="fa fa-users"></i> จำนวนลูกค้าทั่วไป(คน) </span>
                        <div class="count green"> <?php echo $u - 1 ?> </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</body>

</html>