<html>
<head>
	<link rel="stylesheet" href="../HTML/css/table.css">
</head>
<body>

<?php
	include 'db.php';
	if( isset($_POST['submit'])){
		
		$query = "SELECT branch_name, forename, surname, job_title, phone_number, annual_salary FROM staff		
		WHERE forename LIKE :Name and branch_name like :Branch and job_title like :Job_Title and annual_salary >= :Min AND annual_salary <= :Max";
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
		
    	echo "<table id = 'myTable'>
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
			<tbody>";
	  #dbbcff - purple
	  #b1e7f1 - blue
		foreach($result as $row ) {
			echo "<tr>";
			echo "<td>". $row['branch_name'] ."</td>";
			echo "<td>". $row['forename'] ."</td>";
			echo "<td>". $row['surname'] ."</td>";
			echo "<td>". $row['job_title'] ."</td>";
			echo "<td>". $row['phone_number'] ."</td>";
			echo "<td>  &#163;". $row['annual_salary'] ."</td>";
			echo "</tr>";
		}
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


</body>
</html>