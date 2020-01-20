<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/input-style.css?version=1">
	<link rel="stylesheet" href="test/goodtable.css?version=53">
	<link rel="stylesheet" href="test/util.css">
	<?php
	   include('headStyle.php');
	?>
<style>
	div.lookgood{
		margin-top:190px;
		margin-left:92px;
	}
	h3.header{
		margin-left:-25px;
	}

	.found{
		margin-left:150px;
		margin-top:565px;
		color: #b1e7f1;
		position: fixed;
		top: 0;
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

	.box{
		width:300px;
		height:600px;
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

	/* The popup form - hidden by default */
	.form-popup {
	  display: none;
	  position: fixed;
	  bottom: 0;
	  right: 15px;
	  border: 3px solid #f1f1f1;
	  z-index: 9;
	}

	/* Add styles to the form container */
	.form-container {
	  max-width: 300px;
	  padding: 10px;
	  background-color: white;
	}

	/* Full-width input fields */
	.form-container input[type=text], .form-container input[type=password] {
	  width: 100%;
	  padding: 15px;
	  margin: 5px 0 22px 0;
	  border: none;
	  background: #f1f1f1;
	}

	/* When the inputs get focus, do something */
	.form-container input[type=text]:focus, .form-container input[type=password]:focus {
	  background-color: #ddd;
	  outline: none;
	}

	/* Set a style for the submit/login button */
	.form-container .btn {
	  background-color: #4CAF50;
	  color: white;
	  padding: 16px 20px;
	  border: none;
	  cursor: pointer;
	  width: 100%;
	  margin-bottom:10px;
	  opacity: 0.8;
	}

	/* Add a red background color to the cancel button */
	.form-container .cancel {
	  background-color: red;
	}

	/* Add some hover effects to buttons */
	.form-container .btn:hover, .open-button:hover {
	  opacity: 1;
	}
</style>

</head>
	<body style="background-image: url('img/sky.jpg');background-attachment: fixed;">
		<?php
			include("header.php");

			if(!$_SESSION['id']){
				header('LOCATION:https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/PHP/SignIn.php');
			};//if someone use url to get in this page without login, jump to index.php
		?>
		<div class="box"> </div>
		<h3 style="color: #732a9c; margin-top:150px; margin-left:70px;position:fixed;"> <font size="6">Staff Management </font></h3>
		<div class="lookgood left" >
			<form action="displayStaff.php" method="post">
				<ul class="form-style-1">
				<h3 class="header" style="color: white"> Filter </h3>
					<li>
						<label style="color: white">Name</label>
						<input style="width:215px;" type="text" name="name" class="field-long" placeholder="name">
					</li>
					<li>
						<label style="color: white">Job Title</label>
						<select name="job_title" class="field-long" style="width:215px">
						<option value="%">All</option>
						<option value="Manager">Manager</option>
						<option value="Instructor">Instructor</option>
						<option value="Mechanic">Mechanic</option>
						</select>
					</li>
					<li>
						<label style="color: white">Branch</label>
						<select name="branch" class="field-long" style="width:215px">
						<option value="%">All</option>
						<option value="UK - London">London</option>
						<option value="UK - Edinburgh">Edinburgh</option>
						<option value="Finland - Helsinki">Finland</option>
						<option value="US - Washington DC">USA</option>
						</select>
					</li>
					<li>
						<label style="color: white">Salary</label>
						<input type="number" name="sal_min" style="width: 100px" placeholder="min">
						<input type="number"  style="width: 100px; margin-left: 115px; margin-top: -34px" name="sal_max"  placeholder="max">
					</li>
					<li>
						<input type="submit" name="submit" style="width: 215;" value="Search">
					</li
				</ul>
			</form>
			<form action="NewStaff.php" method="post">
				<li>
					<input type="submit" name="submit" style="width: 215;margin-top: 50px " value="Add Staff" >
				</li>
			</form>
			<form action="editStaff.php" method="post">
				<li>
					<input type="submit" type="submit" style="width: 215; " value="Edit Staff" >
				</li>
			</form>
			<form action="displayStaff.php" method="post">
				<li>
					<input type="submit" name="submitDelete" style="width: 215; " value="Delete Staff" >
				</li>
			</form>
	</div>



	<?php
			include 'db.php';
			// Initiate search when entering page.
			if(1==1){

			if(isset($_POST['submitDelete'])){

				// If selected delete staff option, delete the selected table rows staff.
				$query = "DELETE staffinfo, accountinfo FROM staffinfo INNER JOIN accountinfo  WHERE staffinfo.id= accountinfo.id and staffinfo.id = :ID";
				$stmt = $mysql->prepare($query);
				$stmt->bindParam(":ID", $id);
				$id= $_COOKIE["selectedStaff"];
				$stmt->execute();

			}

			// Find staff which meet filter criteria
				$query = "SELECT id,branch_name, forename, surname, job_title, phone_number, annual_salary FROM staffInfo
				WHERE forename LIKE :Name and branch_name like :Branch and job_title like :Job_Title and annual_salary >= :Min AND annual_salary <= :Max
				ORDER BY branch_name,annual_salary DESC";
				$stmt = $mysql->prepare($query);

				$stmt->bindParam(":Name", $name);
				$stmt->bindParam(":Job_Title", $job);
				$stmt->bindParam(":Branch", $branch);
				$stmt->bindParam(":Min", $min);
				$stmt->bindParam(":Max", $max);

				$name = "%";
				$job = "%";
				$branch = "%";
				$min = 0;
				$max = 0;

				// If a filter search was initiated
				if(isset($_POST['submit'])){
								$name = $_POST['name']."%";
								$job = $_POST['job_title']."%";
								$branch = $_POST['branch']."%";
								$min = $_POST['sal_min'];
								$max = $_POST['sal_max'];
				}
				if (empty($max)){
					$max = 9999999;
				}

				if (empty($min)){
					$min = 0;
				}

				$stmt->execute();

				// Print search results
					$result = $stmt->fetchAll();
					$total=0;
			    	echo "
								<div class='limiter'>
									<div class='container-table100'>
										<div class='wrap-table100' style='top:0;margin-top:196px ;position:absolute'>
											<div class='table100'>
												<table id='rowClick'>
													<thead>
														<tr class='table100-head'>
															<th class='column1'>Branch</th>
															<th class='column2'>Forename</th>
															<th class='column3'>Surname</th>
															<th class='column4'>Job</th>
															<th class='column5'>Phone</th>
															<th class='column6'>Salary</th>
														</tr>
													</thead>
													<tbody>";
											foreach($result as $row ) {
												echo "<tr>";
												echo "<td class='column1'>". $row['branch_name'] ."</td>";
												echo "<td class='column2'>". $row['forename'] ."</td>";
												echo "<td class='column3'>". $row['surname'] ."</td>";
												echo "<td class='column4'>". $row['job_title'] ."</td>";
												echo "<td class='column5'>". $row['phone_number'] ."</td>";
												echo "<td class='column6'>&#163;". $row['annual_salary'] ."</td>";
												echo "<td style='display:none;'>".$row['id']."</td>";
												echo "</tr>";
												$total++;

											};
											echo "</tbody>";
											echo "</table>";
											echo "</div>
										</div>
									</div>
								</div>";
					echo "<p class='found'>".$total." Results found</p>";
					echo "<div style='position:relative; margin-top:1800px;'>";
					echo "</div>";

			}
		?>

	<?php
			readfile("footer.html");
	?>
		<script>
		// Store id of clicked staff in cookie
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
			            data.push(cells[6].innerHTML);
			    }
					document.cookie = "selectedStaff=" + data;
					var deleteRow = getCookie("selectedStaff");
					//alert(deleteRow);

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

			// Turn clicked and all other back to normal
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

			function openForm() {
			  document.getElementById("myForm").style.display = "block";
			}

			function closeForm() {
			  document.getElementById("myForm").style.display = "none";
			}
		</script>
	</body>
<html>
