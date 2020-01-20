<!DOCTYPE html>
<html lang="en" class=" js no-touch">

<head>
  <title>AeroDestiny | Finances</title>
  <!-- Import style -->
  <?php
    include("headStyle.php");
  ?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    $(function()
    {
      $("#datepicker").datepicker(
      {
          dateFormat: "yy-mm-dd"
      });
      $("#datepicker0").datepicker(
      {
        dateFormat: "yy-mm-dd"
      });
    });
  </script>
</head>
<body style="background-image: url('img/sky.jpg');background-attachment: fixed;background-position: center; background-repeat: no-repeat; background-size: cover;">
  <!--HEADER START-->
  <?php
      include("header.php");
      if(!$_SESSION['id']){
        header('LOCATION:https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/PHP/SignIn.php');
      };//if someone use url to get in this page without login, jump to index.php


      include "db.php";
      $sql = "SELECT * from transactioninfo";
      $stmt=$mysql->prepare($sql);
      $stmt->execute();
      $res=$stmt->fetchAll();

  ?>
  <!--HEADER END-->

<!-- GRAPH START -->
<div class="section-padding overflow-auto" style="margin-top:100px;">
  <div class="container">
    <div class="col-sm">
      <?php

      function checkExpenseCategory($total)
      {
        $selCat;
        if ($_POST["category"] == "Fuel") {
          $selCat = array($total,0,0,0,0,0);
        }
        elseif ($_POST["category"] == "Electricity") {
          $selCat = array(0,0,$total,0,0,0);
        }
        elseif ($_POST["category"] == "Water") {
          $selCat = array(0,0,0,$total,0,0);
        }
        elseif ($_POST["category"] == "Maintainence") {
          $selCat = array(0,0,0,0,$total,0);
        }
        elseif ($_POST["category"] == "Salary Payment") {
          $selCat = array(0,$total,0,0,0,0);
        }
        else
        {
          $selCat = array(0,0,0,0,0,$total);
        }
        return $selCat;
      }

      $fuelExpense;
      $salaryExpense;
      $electricityExpense;
      $waterExpense;
      $maintainenceExpense;
      $loanExpense;

      if (isset($_POST["submit"])) {
        // Get the sum of all expenses in each category
        if ($_POST['startdate'] != "start" && $_POST['enddate'] != "end" && $_POST['category'] != '%' && $_POST['category'] != 'Tuition' && $_POST['category'] != 'Grant' && $_POST['category'] != 'Loan Disbursement')
        {
          $query ="SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\" AND description=\"".$_POST["category"]."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $totalExpense = $row['sum'];
          };
          $setTo100 = checkExpenseCategory($totalExpense);
          $fuelExpense = $setTo100[0];
          $salaryExpense = $setTo100[1];
          $electricityExpense = $setTo100[2];
          $waterExpense = $setTo100[3];
          $maintainenceExpense = $setTo100[4];
          $loanExpense = $setTo100[5];
        }
        elseif ($_POST['category'] != '%' && $_POST['category'] != 'Tuition' && $_POST['category'] != 'Grant' && $_POST['category'] != 'Loan Disbursement')
        {
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description = \"".$_POST['category']."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $totalExpense = $row['sum'];
          };
          $setTo100 = checkExpenseCategory($totalExpense);
          $fuelExpense = $setTo100[0];
          $salaryExpense = $setTo100[1];
          $electricityExpense = $setTo100[2];
          $waterExpense = $setTo100[3];
          $maintainenceExpense = $setTo100[4];
          $loanExpense = $setTo100[5];
        }
        elseif($_POST['startdate'] != "start" && $_POST['enddate'] != "end" && !isset($_POST['income']) && isset($_POST['expenses']))
        {
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE balanceChange<0 AND date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $totalExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description ='Salary Payment' AND date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $salaryExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Fuel' AND date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $fuelExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Electricity' AND date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $electricityExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Water' AND date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $waterExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Maintainence' AND date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $maintainenceExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Loan Repayment' AND date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $loanExpense = $row['sum'];
          };
        }
        elseif ($_POST['startdate'] != "start" && $_POST['enddate'] != "end")
        {
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $totalExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description ='Salary Payment' AND date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $salaryExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Fuel' AND date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $fuelExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Electricity' AND date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $electricityExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Water' AND date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $waterExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Maintainence' AND date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $maintainenceExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Loan Repayment' AND date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\"";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $loanExpense = $row['sum'];
          };
        }
        else
        {
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE balanceChange < 0";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $totalExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description ='Salary Payment'";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $salaryExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Fuel'";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $fuelExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Electricity'";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $electricityExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Water'";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $waterExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Maintainence'";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $maintainenceExpense = $row['sum'];
          };
          $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Loan Repayment'";
          $stmt =$mysql->prepare($query);
          $stmt->execute();
          $result=$stmt->fetchAll();
          foreach($result as $row ) {
            $loanExpense = $row['sum'];
          };
        }
      }
      else
      {
        $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE balanceChange < 0";
        $stmt =$mysql->prepare($query);
        $stmt->execute();
        $result=$stmt->fetchAll();
        foreach($result as $row ) {
          $totalExpense = $row['sum'];
        };
        $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description ='Salary Payment'";
        $stmt =$mysql->prepare($query);
        $stmt->execute();
        $result=$stmt->fetchAll();
        foreach($result as $row ) {
          $salaryExpense = $row['sum'];
        };
        $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Fuel'";
        $stmt =$mysql->prepare($query);
        $stmt->execute();
        $result=$stmt->fetchAll();
        foreach($result as $row ) {
          $fuelExpense = $row['sum'];
        };
        $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Electricity'";
        $stmt =$mysql->prepare($query);
        $stmt->execute();
        $result=$stmt->fetchAll();
        foreach($result as $row ) {
          $electricityExpense = $row['sum'];
        };
        $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Water'";
        $stmt =$mysql->prepare($query);
        $stmt->execute();
        $result=$stmt->fetchAll();
        foreach($result as $row ) {
          $waterExpense = $row['sum'];
        };
        $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Maintainence'";
        $stmt =$mysql->prepare($query);
        $stmt->execute();
        $result=$stmt->fetchAll();
        foreach($result as $row ) {
          $maintainenceExpense = $row['sum'];
        };
        $query = "SELECT SUM(balanceChange) AS sum FROM transactioninfo WHERE description='Loan Repayment'";
        $stmt =$mysql->prepare($query);
        $stmt->execute();
        $result=$stmt->fetchAll();
        foreach($result as $row ) {
          $loanExpense = $row['sum'];
        };
      }

        //Source: canvasjs.com/php-charts/pie-chart/
       $dataPoints = array(
          array("label"=>"Salary Payment","y"=>$salaryExpense*100/$totalExpense),
          array("label"=>"Fuel","y"=>$fuelExpense*100/$totalExpense),
          array("label"=>"Electricity","y"=>$electricityExpense*100/$totalExpense),
          array("label"=>"Water","y"=>$waterExpense*100/$totalExpense),
          array("label"=>"Maintainence","y"=>$maintainenceExpense*100/$totalExpense),
          array("label"=>"Loan Repayment","y"=>$loanExpense*100/$totalExpense)
        )
        ?>
        <script>
        window.onload = function() {
          var chart = new CanvasJS.Chart("chartContainer", {
              animationEnabled: true,
    	        title:
                {
    		          text: "Expenses by Category"
                },
                data: [{
                  type: "pie",
                  yValueFormatString: "#,##0.00\"%\"",
                  indexLabel: "{label} ({y})",
                  dataPoints: <?php echo json_encode($dataPoints,JSON_NUMERIC_CHECK); ?>
                }],
              });
              chart.render();
            }
        </script>
        <div id="chartContainer"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </div>
  </div>
</div>
<!-- GRAPH END -->

<!-- TABLE AREA START -->
<div class="section-padding">
  <div class="container">
    <div class="row" style="margin-top:350px;">

      <!-- FILTER START -->
      <div class="col-sm-4 overflow-auto">
        <form action="finances.php" method="post">
          <div class="form-group">
            <h3 class=""> Filter </h3>
            <label for="startDate">Start Date: <input readonly type="text" id="datepicker" value="start" name="startdate"></label>
            <label for="endDate">End Date: <input readonly type="text" id="datepicker0" value="end" name="enddate"></label>
          </div>
          <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" name="category">
              <option value="%">Category</option>
              <option value="Tuition">Tuition</option>
              <option value="Grant">Grant</option>
              <option value="Loan Disbursement">Loan Disbursement</option>
              <option value="Salary Payment">Salary Payment</option>
              <option value="Fuel">Fuel</option>
              <option value="Electricity">Electricity</option>
              <option value="Water">Water</option>
              <option value="Maintainence">Maintainence</option>
              <option value="Loan Repayment">Loan Repayment</option>
            </select>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="income" value="income" name="income">
            <label class="form-check-label" for="income">Income</label>
            <input type="checkbox" class="custom-control-input" id="expenses" value="expenses" name="expenses">
            <label class="form-check-label" for="expenses">Expenditure</label>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
          <button type="reset" class="btn btn-primary" href="finances.php" onClick="window.location='Functional/redirectFinance.php'">Reset</button>
        </form>
      </div>
      <!-- FILTER END -->

      <!-- TABLE START -->
      <div class="col-sm-8 overflow-auto" style="margin-left:000px;">
      <table class="table" bgcolor="#000">
        <thead bgcolor="#6b588c" class="text-white">
          <tr>
            <font color="#ffffff">
            <th scope="col">Date</th>
            <th scope="col">Category</th>
            <th scope="col">Profit/Loss</th>
            <th scope="col">Balance</th>
          </font>
          </tr>
        </thead>
        <tbody>
        <?php
        if (isset($_POST['submit']))
        {
            if ($_POST['startdate'] != "start" && $_POST['enddate'] != "end" && $_POST['category'] != '%')
            {
                $sql = "SELECT * FROM transactioninfo WHERE date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\" AND description=\"".$_POST["category"]."\"";
            }
            elseif ($_POST['startdate'] != "start" && $_POST['enddate'] != "end" && !isset($_POST['income']) && isset($_POST['expenses'])) {
              $sql = "SELECT * FROM transactioninfo WHERE date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\" AND balanceChange<0";
            }
            elseif ($_POST['category'] != '%') {
              $sql = "SELECT * from transactioninfo WHERE description=\"".$_POST["category"]."\"";
            }
            elseif (isset($_POST['income']) && !isset($_POST['expenses']))
            {
              $sql = "SELECT * from transactioninfo WHERE balanceChange>0";
            }
            elseif (!isset($_POST['income']) && isset($_POST['expenses'])) {
              $sql = "SELECT * from transactioninfo WHERE balanceChange<0";
            }
            elseif (isset($_POST['startdate']) && isset($_POST['enddate'])) {
              $sql = "SELECT * FROM transactioninfo WHERE date >=\"".$_POST['startdate']."\" AND date <=\"".$_POST['enddate']."\"";
            }
        }
        $stmt=$mysql->prepare($sql);
        $stmt->execute();
        $res=$stmt->fetchAll();
        unset($_POST['submit']);
        if (isset($_POST['startdate'])) {
          unset($_POST['startdate']);
        }
        if (isset($_POST["enddate"])) {
          unset($_POST['enddate']);
        }
        if (isset($_POST['category'])) {
          unset($_POST['category']);
        }
          foreach( $res as $row )
          {
            echo "<tr>";
            echo "<td>".$row['date']."</td>";
            echo "<td>".$row['description']."</td>";
              if($row['balanceChange'][0] == "-"){
                $row['balanceChange'] = ltrim($row['balanceChange'], "-");
                $row['balanceChange'] = "-£".$row['balanceChange'];
                echo "<td>".$row['balanceChange']."</td>";
              }
              else{
                echo "<td>£".$row['balanceChange']."</td>";
              }
              echo "<td>£".$row['balance']."</td>";
              echo "</tr>";
            }
          ?>
        </tbody>
      </table>
      <!-- TABLE END -->
      </div>
    </div>
  </div>
</div>
<!-- TABLE AREA END -->

<!-- FOOTER START -->
<?php
  readfile("footer.html")
?>
<!-- FOOTER END -->
</body>
