<html>
<head>
<meta charset="UTF-8" />



    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php
      include('headStyle.php')
    ?>

<style>
table{
  color:white;
}
h2{
  color:black;
  font-size: 40px;
  font-weight: 550;
}
</style>
</head>


<body style="background-image: url('img/sky.jpg');background-attachment: fixed;">
<!--
<p><a class="navbar-brand" href="index.html"><img src="img/LOGO.PNG" class="img-fluid" alt="AeroDestiny Logo"></a></p>
<hr class="pg-titl-bdr-btm"></hr>
<h1 style="color:#9933CA">&nbsp  Schedule</h1>
-->
<?php
    include("header.php");

    if(!$_SESSION['id']){
        header('LOCATION:https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/PHP/SignIn.php');
    }//if someone use url to get in this page without login, jump to SignIn.php
    if($_SESSION['type']!='Staff'){
        header('LOCATION:https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/index.php');
    }//if someone who do not use lecturer account to get in this page, jump to Index.php


  #  session_start();
  //  echo $_SESSION['id'];

?>


<?php
   include 'db.php';
    $query="select * from lecturerschedule where id = :ID";
    $stmt = $mysql->prepare($query);
    $stmt->bindParam(":ID", $_SESSION['id']);
    $stmt->execute();
    $result=$stmt->fetchAll();


?>


<br><br><br><br><br><br>



<table align=center class="table table-bordered table-hover" style="margin-top:30px;">
	<caption>
            <h2 " align="center">Schedule</h2><br>
    </caption>

    <thead>
        <tr class="info" height=50>
        <td style=" background: #36304a" rowspan="2" width="200" align="center" valign="middle">Title</td>
        <td style=" background: #36304a" rowspan="2" width="200" align="center" valign="middle">Date</td>
        <td style=" background: #36304a" rowspan="2" width="200" align="center" valign="middle">Time</td>
        <td style=" background: #36304a" rowspan="2" width="200" align="center" valign="middle">Students</td>
        <td style=" background: #36304a" rowspan="2" width="200" align="center" valign="middle">Description</td>
        </tr>
    </thead>

    <tbody>
    <?php
    if (empty($result)) {echo "<tr align='center' style='background-color:white;height=50;' height=50>";
                         echo "<td colspan=5 style='color:black'>Seems like you have no lectures...</td>";
                        }
    else{
    // foreach($result as $row){
    //     echo "<tr align='center' style='background-color:white;height=50;' height=50>";
    //     echo "<td style='color:black'>" . $row['title'] ."</td>";
    //     echo "<td style='color:black'>" . $row['date'] ."</td>";
    //     echo "<td style='color:black'>" . $row['start'] ." - ".$row['end'] ."</td>";
    //     echo "<td style='color:black'>" . $row['forename'] ." ".$row['surname'] ."</td>";
    //     echo "<td style='color:black'>" . $row['description'] ."</td>";
    //     echo "</tr>";
    //

  $date = $start = $description = "";
  foreach($result as $row)
  {
    if($date=="")
    {
      echo "<tr align='center' style='background-color:white;height=50;' height=50>";
      echo "<td style='color:black'>" . $row['title'] ."</td>";
      echo "<td style='color:black'>" . $row['date'] ."</td>";
      echo "<td style='color:black'>" . $row['start'] ." - ".$row['end'] ."</td>";
      echo "<td style='color:black'>" . $row['forename'] ." ".$row['surname'] ;
      $date = $row['date'];
      $start = $row['start'];
      $description = $row['description'];
    }
    else
    {
      if( $date == $row['date'] && $start == $row['start'])
      {
        echo ", " . $row['forename'] ." ".$row['surname'] ;
      }
      else
      {
        echo "</td>";
        echo "<td style='color:black'>" . $description ."</td></tr>";
        echo "<tr align='center' style='background-color:white;height=50;' height=50>";
        echo "<td style='color:black'>" . $row['title'] ."</td>";
        echo "<td style='color:black'>" . $row['date'] ."</td>";
        echo "<td style='color:black'>" . $row['start'] ." - ".$row['end'] ."</td>";
        echo "<td style='color:black'>" . $row['forename'] ." ".$row['surname'] ;
      }
      $date = $row['date'];
      $start = $row['start'];
      $description = $row['description'];
    }
  }
  echo "<td style='color:black'>" . $description ."</td></tr>";
  }



    ?>

    </tbody>
</table>


</body>
</html>
