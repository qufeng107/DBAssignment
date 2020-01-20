<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/input-style.css?version=52">
	<link rel="stylesheet" type="text/css" href="css/gordontable.css">
	<link rel="stylesheet" href="test/util.css">
	<?php
	    include('headStyle.php');
	?>
<style>

	div.lookgood{
		margin-top:190px;
		margin-left:100px;
	}
	h3.header{
		margin-left:-25px;
	}

	.split {
	  height: 100%;
	  width: 40%;
	  position: fixed;
	  z-index: 1;
	  top: 0;
	  overflow-x: hidden;
	  padding-top: 20px;
		border-width: 5px;
	}

	/* Control the left side */
	.left {
	  left: 0;
		position: fixed;

	}

	/* Control the right side */
	.right {
	  right: 0;
		position: fixed;

	}

	.centered {
	  position: relative;
	  top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  text-align: center;
	}

	.inner-border::-webkit-scrollbar
	{
    display: none;
  }

	.input{
		width:165px;
	}

	.found{
		margin-left:100px;
		margin-top:900px;
		color: #b1e7f1;
		position: fixed;
		top: 0;
	}

	.box{
		width:300px;
		height:800px;
		background-color: #36304a;
		position: fixed;
		margin-top: 196px;
		margin-left:50px;
		border-radius: 10px;
		border: 2px solid #36304a;
	}
	.inputbox{
		margin-left:50px;
		border-radius: 10px;
		border: 2px solid #36304a;
	}
	html label{
		color:white;
	}
</style>

</head>
<body style="background-image: url('img/sky.jpg');background-attachment: fixed;">
		<?php
			include ('header.php');

			if(!$_SESSION['id']){
				header('LOCATION:https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/PHP/SignIn.php');
				}//if someone use url to get in this page without login, jump to SignIn.php
	  ?>
	<div class="box"> </div>
			<h3 style="color: #732a9c; margin-top:150px; margin-left:60px;position:fixed;"> <font size="6">Client Management </font></h3>
			<div class="lookgood left" >
				<form action="ClientInformationPage.php" method="post">
					<ul class="form-style-1">
					<h3 class="header" style="color: white"> <font size="5">Search Client(s)  </font></h3>
					<li>
						<label>Student ID</label>
						<input style="width:215px; "type="text" name="student_id" class="field-long">
					</li>
                    <li>
						<label>First name</label>
						<input style="width:215px;" type="text" name="first_name" class="field-long">
					</li>
                    <li>
						<label>Surname</label>
						<input style="width:215px;  "type="text" name="surname" class="field-long">
					</li>
                    <li>
						<label>Date of Birth</label>
						<input style="width:215px; "type="date" name="date_of_birth" class="field-long">
					</li>
                    <li>
						<label>Email</label>
						<input style="width:215px;" type="text" name="email" class="field-long">
					</li>
                    <li>
						<label>Phone Number</label>
						<input style="width:215px; "type="text" name="phone_number" class="field-long">
					</li>
                    <li>
						<label>Address</label>
						<input style="width:215px; "type="text" name="address" class="field-long">
					</li>
                    <li>
						<label>Term ID</label>
						<input style="width:215px; "type="number" name="term_id" class="field-long">
					</li>
					<li>
						<label>License Course</label>
						<select name="title" class="field-long" style = "width:215px">
						<option value="%">All</option>
						<option value="Private Pilot Course">Private Pilot</option>
						<option value="Commercial Pilot Course">Commercial Pilot</option>
						<option value="Multi-Crew Pilot Course">Multi-Crew Pilot</option>
						<option value="Airline Transport Course">Airline Transport Pilot</option>
						</select>
					</li>
					<li>
						<input type="submit" name="submit" style="width: 215px" value="search">
					</li>
					<li style="margin-top: 50px">
					<input type="submit" name="submitDelete" style="width: 215px" value="Delete Client">
				</li>
				</ul>
			</form>
		</div>
	</div>
	<?php
			include 'db.php';

			// If clicked delete button
			if(isset($_POST['submitDelete'])){
				$id= $_COOKIE["deleteClient"];

				// delete customer and account info
				$query = "DELETE customerinfo, accountinfo FROM customerinfo INNER JOIN accountinfo  WHERE customerinfo.id= accountinfo.id and customerinfo.id = :ID";
				$stmt = $mysql->prepare($query);
				$stmt->bindParam(":ID", $id);
				$stmt->execute();

				$stmt = $mysql->prepare("SELECT * from clientinfo where id = :ID");
				$stmt->bindParam(":ID", $id);
				$stmt->execute();

				$results=$stmt->fetchall();
				// If signup is Successful
				if($stmt->rowCount() > 0){

					$message = "Delete Failed.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
				else{
					$message = "Delete Successful";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}

			}

			$student_id = "%";
			$first_name = "%";
			$surname = "%";
			$date_of_birth = "%";
			$email = "%";
			$phone_number = "%";
			$address = "%";
			$term_id = "%";
			$title ="%";

			// If intiated filter search
			if(isset($_POST['submit'])){

								$student_id = $_POST['student_id']."%";
								$first_name = "%".$_POST['first_name']."%";
								$surname = "%".$_POST['surname']."%";
								$date_of_birth = $_POST['date_of_birth']."%";
								$email = "%".$_POST['email']."%";
								$phone_number = "%".$_POST['phone_number']."%";
								$address = "%".$_POST['address']."%";
								$term_id = $_POST['term_id']."%";
								$title = $_POST['title'];
			}

				// filter customers
				$query = "SELECT id,forename, surname, date_of_birth, phone_number, address, term_id,title,email from clientInfo
				where id like :ID and forename like :FORENAME and surname like :SURNAME and date_of_birth like :DOB and email like :EMAIL and phone_number like :PHONE and address like :ADDRESS and term_id like :TERM_ID and title like :TITLE
				Order by id ";
				$stmt = $mysql->prepare($query);

				$stmt->bindParam(":ID", $student_id);
				$stmt->bindParam(":FORENAME", $first_name);
				$stmt->bindParam(":SURNAME", $surname);
				$stmt->bindParam(":DOB", $date_of_birth);
				$stmt->bindParam(":EMAIL", $email);
				$stmt->bindParam(":PHONE", $phone_number);
				$stmt->bindParam(":ADDRESS", $address);
				$stmt->bindParam(":TERM_ID", $term_id);
				$stmt->bindParam(":TITLE", $title);

				// Print customers
				$stmt->execute();
				$result = $stmt->fetchAll();
				$total=0;
		    	echo "<div class='limiter'>
						<div class='container-table100'>
							<div class='wrap-table100' style='top:0;margin-top:196px ;position:absolute'>
								<div class='table100'>
									<table id>
										<thead>
											<tr class='table100-head'>
							<th class='column1'>ID</th>
							<th class='column2'>First Name</th>
							<th class='column3'>Surname</th>
							<th class='column4'>Date of Birth</th>
							<th class='column5'>Phone Number</th>
							<th class='column6'>Address</th>
							<th class='column7'>Email</th>
							<th class='column8'>Term ID</th>
							<th class='column9'>Course Title</th>
					  </tr>
						</thead>
						<tbody>";
				foreach($result as $row ) {
					echo "<tr>";
					echo "<td class='column1'>". $row['id'] ."</td>";
					echo "<td class='column2'>". $row['forename'] ."</td>";
					echo "<td class='column3'>". $row['surname'] ."</td>";
					echo "<td class='column4'>". $row['date_of_birth'] ."</td>";
					echo "<td class='column5'>". $row['phone_number'] ."</td>";
					echo "<td class='column6'>". $row['address'] ."</td>";
					echo "<td class='column7'>". $row['email'] ."</td>";
					echo "<td class='column8'>". $row['term_id'] ."</td>";
					echo "<td class='column9'>". $row['title'] ."</td>";
					echo "</tr>";
					$total++;
				};
				echo "</tbody>";
				echo "</table>";
				echo "</div>";
				echo "</div>";
				echo "</div>";
				echo "</div>";
				echo "<p class='found'>".$total." Results found</p>";
				echo "<div style='position:relative; margin-top:1800px;'>";

		?>


		<?php
			readfile("footer.html");
			?>
			<script>
			var table = document.getElementsByTagName("table")[0];
			var tbody = table.getElementsByTagName("tbody")[0];
			tbody.onclick = function (e) {
			    e = e || window.event;
			    var data = [];
			    var target = e.srcElement || e.target;
			    while (target && target.nodeName !== "TR") {
			        target = target.parentNode;
			    }
			    if (target) {
			        var cells = target.getElementsByTagName("td");
			            data.push(cells[0].innerHTML);
			    }
					document.cookie = "deleteClient=" + data;
					//alert(cells[0].innerHTML);

			};
				function getCookie(cname) {
			  var name = cname + "=";
			  var decodedCookie = decodeURIComponent(document.cookie);
			  var ca = decodedCookie.split(';');
			  for(var i = 0; i <ca.length; i++) {
			    var c = ca[i];
			    while (c.charAt(0) == ' ') {
			      c = c.substring(1);
			    }
			    if (c.indexOf(name) == 0) {
			      return c.substring(name.length, c.length);
			    }
			  }
			  return "";
			};
			var previous;
			[].forEach.call(document.getElementsByTagName('tr'), function(item) {
				 item.addEventListener('click', function() {
						 if(previous != null){
							 previous.classList.remove("active");
						 }
						 item.classList.add("active");
						 previous=item;
				 }, false);
			});
		</script>
	</body>
<html>
