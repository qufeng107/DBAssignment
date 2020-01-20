<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/input-style.css">
	<link rel="stylesheet" href="css/table.css">
	<?php
	    readfile('headStyle.html');
	?>
<style>
	div.lookgood{
		margin-top:150px;
		margin-left:150px;
	}
	h3.header{
		margin-left:-25px;
	}

	.found{
		margin-left:620px;
		margin-top:895px;
		color: red;
		position: absolute;
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

	.input{
		width:165px;
	}

	.inner-border::-webkit-scrollbar {
	  display: none;
	}
</style>

</head>
	<body style="background-color:lightblue">
		<?php
	    	readfile('header.html');
	  ?>
		<div class="lookgood left" >
			<form action="displayStaff(test).php" method="post">
				<ul class="form-style-1">
				<h3 class="header"> Fitler </h3>
					<li>
						<label>Name</label>
						<input style="width:215px; "type="text" name="name" class="field-long">
					</li>
					<li>
						<label>Job Title</label>
						<select name="job_title" class="field-long" style="width:215px">
						<option value="%">All</option>
						<option value="Manager">Manager</option>
						<option value="Instructor">Instructor</option>
						</select>
					</li>
					<li>
						<label>Branch</label>
						<select name="branch" class="field-long" style="width:215px">
						<option value="%">All</option>
						<option value="UK - London">London</option>
						<option value="UK - Edinburgh">Edinburgh</option>
						<option value="Finland - Helsinki">Finland</option>
						<option value="US - Washington DC">USA</option>
						</select>
					</li>
					<li>
						<label>Salary</label>
						<input type="number" name="sal_min" style="width: 100px" placeholder="min">
						<input type="number"  style="width: 100px; margin-left: 115px; margin-top: -36px" name="sal_max"  placeholder="max">
					</li>
					<li>
						<input type="submit" name="submit" style="width: 100px" value="Search">
					</li
				</ul>
			</form>
			<form action="NewStaff.php" method="post">
				<li>
					<input type="submit" name="submit" style="width: 100px" value="Add Staff">
				</li>
			</form>
	</div>

	<?php
			include 'db.php';
			if(isset($_POST['submit'])){

				$query = "SELECT branch_name, forename, surname, job_title, phone_number, annual_salary FROM staff
				WHERE forename LIKE :Name and branch_name like :Branch and job_title like :Job_Title and annual_salary >= :Min AND annual_salary <= :Max
				ORDER BY branch_name";
				$stmt = $mysql->prepare($query);

				$stmt->bindParam(":Name", $name);
				$stmt->bindParam(":Job_Title", $job);
				$stmt->bindParam(":Branch", $branch);
				$stmt->bindParam(":Min", $min);
				$stmt->bindParam(":Max", $max);

				$name = $_POST['name']."%";
				$job = $_POST['job_title'];
				$branch = $_POST['branch'];
				$min = $_POST['sal_min'];
				$max = $_POST['sal_max'];

				if (empty($max)){
					$max = 9999999;
				}

				if (empty($min)){
					$min = 0;
				}

				$stmt->execute();
				$result = $stmt->fetchAll();
				$total=0;
				#style='overflow-y:scroll; height:600px
		    	echo "<div class='lookgood inner-border' style='overflow-y:scroll; height:680px'>
						<table id = 'myTable'>
						<thead>
						<tr>
							<th onclick='sortTable(0)'><span>Branch</span></th>
							<th onclick='sortTable(1)'><span>Firstname</span></th>
							<th onclick='sortTable(2)'><span>Surname</span></th>
							<th onclick='sortTable(3)'><span>Job Title</span></th>
							<th onclick='sortTable(4)'><span>Phone Number</span></th>
							<th onclick='sortTable(5)'><span>Salary</span></th>
					  </tr>
						</thead>
						<tbody style='overfloew-y:scroll'>";
				foreach($result as $row ) {
					echo "<tr>";
					echo "<td>". $row['branch_name'] ."</td>";
					echo "<td>". $row['forename'] ."</td>";
					echo "<td>". $row['surname'] ."</td>";
					echo "<td>". $row['job_title'] ."</td>";
					echo "<td>". $row['phone_number'] ."</td>";
					echo "<td>&#163;". $row['annual_salary'] ."</td>";
					echo "</tr>";
					$total++;
				};
				echo "</tbody>";
				echo "</table>";
				echo "</div>";
				echo "<p class='found'>".$total." Results found.</p>";
			}
		?>
		<script>
		function sortTable(n) {
		  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
		  table = document.getElementById("myTable");
		  switching = true;
		  //Set the sorting direction to ascending:
		  dir = "asc";
		  /*Make a loop that will continue until
		  no switching has been done:*/
		  while (switching) {
		    //start by saying: no switching is done:
		    switching = false;
		    rows = table.rows;
		    /*Loop through all table rows (except the
		    first, which contains table headers):*/
		    for (i = 1; i < (rows.length - 1); i++) {
		      //start by saying there should be no switching:
		      shouldSwitch = false;
		      /*Get the two elements you want to compare,
		      one from current row and one from the next:*/
		      x = rows[i].getElementsByTagName("TD")[n];
		      y = rows[i + 1].getElementsByTagName("TD")[n];
		      /*check if the two rows should switch place,
		      based on the direction, asc or desc:*/
		      if (dir == "asc") {
		        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
		          //if so, mark as a switch and break the loop:
		          shouldSwitch= true;
		          break;
		        }
		      } else if (dir == "desc") {
		        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
		          //if so, mark as a switch and break the loop:
		          shouldSwitch = true;
		          break;
		        }
		      }
		    }
		    if (shouldSwitch) {
		      /*If a switch has been marked, make the switch
		      and mark that a switch has been done:*/
		      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		      switching = true;
		      //Each time a switch is done, increase this count by 1:
		      switchcount ++;
		    } else {
		      /*If no switching has been done AND the direction is "asc",
		      set the direction to "desc" and run the while loop again.*/
		      if (switchcount == 0 && dir == "asc") {
		        dir = "desc";
		        switching = true;
		      }
		    }
		  }
		}
		</script>
		<script>
			function myFunction() {
  		alert("I am an alert box!");
		}
		<?php
			//	readfile("footer.html")
			?>
	</body>
<html>
