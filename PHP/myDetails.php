<html>
<head>
	<link rel="stylesheet" href="css/detailstable.css?version=52">
	<link rel="stylesheet" type="text/css" href="css/input-style.css?version=12">
	<?php
	   include("headStyle.php");
	?>
<style>
	div.lookgood{
		margin-top:200px;
		margin-left:150px;
	}
	h3.header{
		margin-left:-25px;
	}

</style>

</head>
	<body  style="background-image: url('img/sky.jpg');background-attachment: fixed;">
		<?php
			include("header.php");

			if(!$_SESSION['id']){
				header('LOCATION:https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/PHP/SignIn.php');
				}//if someone use url to get in this page without login, jump to SignIn.php
    ?>

    <h3 style="color: #732a9c; top:0; margin-top:150px; margin-left:70px;position:absolute;"> <font size="6">My Details </font></h3>
		<div class="lookgood">

      <?php
        include("db.php");
				// Determine what type of account is signed it
        $stmt = $mysql->prepare("SELECT type,username,email FROM accountInfo WHERE id = :ID");
        $stmt->bindParam(":ID", $_SESSION['id']);
        $stmt->execute();
        $result=$stmt->fetchAll();
        foreach($result as $row ){
          $type=$row['type'];


					// If customer, get customer details
					if($type=="Customer"){
          	$stmt = $mysql->prepare("SELECT forename, surname,phone_number, date_of_birth,address,title FROM clientinfo where id = :ID");
            $stmt->bindParam(":ID", $_SESSION['id']);
            $stmt->execute();
            $res=$stmt->fetchAll();

						echo "<table style='width:400px; left: 0;margin-left:50px; border-color: black'>";
						echo "<tbody>";
						echo "<tr>";
							echo "<td style='background-color:#36304a; color:white' ;text-align: center;> Account </td>";
							echo "<td style='text-align: left'> Customer </td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td style='background-color:#36304a; color:white'> Username </td>";
							echo "<td style='text-align: left'>".$row['username']."</td>";
						echo "</tr>";

						// Display details if customer signed up for a course
            foreach($res as $customer){
									echo "<td style='background-color:#36304a; color:white'> First Name </td>";
	              	echo "<td style='text-align: left'>".$customer['forename']."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td style='background-color:#36304a; color:white'> Surname </td>";
	              	echo "<td style='text-align: left'>".$customer['surname']."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td style='background-color:#36304a; color:white'> Date of Birth </td>";
	              	echo "<td style='text-align: left'>".$customer['date_of_birth']."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td style='background-color:#36304a; color:white'> Email </td>";
									echo "<td style='text-align: left'>".$row['email']."</td>";
								echo "</tr>";
									echo "<td style='background-color:#36304a; color:white'> Phone Number </td>";
	              	echo "<td style='text-align: left'>".$customer['phone_number']."</td>";
								echo "<tr>";
									echo "<td style='background-color:#36304a; color:white'> Address </td>";
	              	echo "<td style='text-align: left'>".$customer['address']."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td style='background-color:#36304a; color:white'> Course </td>";
									echo "<td style='text-align: left'>".$customer['title']."</td>";
								echo "</tr>";
            	}
							echo "</tbody>";
							echo "</table>";
        	}

					// If account is a staff, get staff details
          if($type=="Staff"){
            $stmt = $mysql->prepare("SELECT branch_name, forename, surname, job_title, phone_number, annual_salary FROM staffInfo where id = :ID");
            $stmt->bindParam(":ID", $_SESSION['id']);
            $stmt->execute();
            $res=$stmt->fetchAll();

						echo "<table style='width:400px; left: 0;margin-left:50px; border-color: black'>";
						echo "<tbody>";
						echo "<tr>";
							echo "<td style='background-color:#36304a; color:white'> Account </td>";
							echo "<td style='text-align: left' > Staff </td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td style='background-color:#36304a; color:white'> Username </td>";
							echo "<td style='text-align: left'>".$row['username']."</td>";
						echo "</tr>";

						// Display staff details
            foreach($res as $staff ){
							echo "<tr>";
								echo "<td style='background-color:#36304a; color:white'> Branch </td>";
              	echo "<td style='text-align: left'>".$staff['branch_name']."</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<td style='background-color:#36304a; color:white'> First Name </td>";
              	echo "<td style='text-align: left'>".$staff['forename']."</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<td style='background-color:#36304a; color:white'> Surname </td>";
              	echo "<td style='text-align: left'>".$staff['surname']."</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<td style='background-color:#36304a; color:white'> Email </td>";
								echo "<td style='text-align: left'>".$row['email']."</td>";
							echo "</tr>";
								echo "<td style='background-color:#36304a; color:white'> Phone Number </td>";
              	echo "<td style='text-align: left'>".$staff['phone_number']."</td>";
							echo "<tr>";
								echo "<td style='background-color:#36304a; color:white'> Job </td>";
								echo "<td style='text-align: left'>".$staff['job_title']."</td>";
							echo "</tr>";
								echo "<td style='background-color:#36304a; color:white'> Salary </td>";
              	echo "<td style='text-align: left'>&#163;".$staff['annual_salary']."</td>";
							echo "</tr>";
            }
						echo "</tbody>";
						echo "</table>";
          }
        }
      ?>
			<form action="editPersonal.php" method="post">
				<li style="margin-top: 20px;margin-left:50px">
					<ul class="form-style-1">
					<input type="submit" name="submit" style="width: 400; " value="Change my details" >
				</li>
				</ul>
			</form>
			<form action="editPassword.php" method="post">
				<li style="margin-top: 20px;margin-left:50px">
					<ul class="form-style-1">
					<input type="submit" name="submit" style="width: 400; " value="Change my password" >
				</li>
				</ul>
			</form>
		</div>
			<div style="top: 0; margin-top:220px; padding-bottom: 300px;position absolute"></div>
		<div>
		<?php

			readfile("footer.html");
		?>
		<script>
			$(document).ready(function(){

			 $('table tr').click(function(){ $(this).addClass("high-light");  });
			 //If you have TD's background set try the below commented code
			  $('table tr td').click(function(){ $(this).parent().find('td').addClass("high-light");  });
			});
	</script>
	</body>
<html>
