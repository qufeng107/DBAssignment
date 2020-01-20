<div class="main-navigation navbar-fixed-top">
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
        </button>
        <?php

        if($_SERVER["URL"] != "/2019-ac32006/team12/index.php")
        {
          echo "<a class=\"navbar-brand\" href=\"../index.php\"><img src=\"img/LOGO2.PNG\" class=\"img-fluid\" alt=\"AeroDestiny Logo\"></a>";
        }
        else
        {
          echo "<a class=\"navbar-brand\" href=\"index.php\"><img src=\"PHP/img/LOGO2.PNG\" class=\"img-fluid\" alt=\"AeroDestiny Logo\"></a>";
        }
        ?>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <?php
            //Get session variables.
            Session_start();
            $_SESSION['usernamedb'] = "19ac3other12";
            //Will print the login status
            function displayLoginStatus($dir)
            {
              //If the user is logged in
              if(isset($_SESSION['username']) && isset($_SESSION['id']))
              {
                //Get the user's type
                include($dir."db.php");
                $sql = "SELECT type, id FROM accountinfo WHERE id=".$_SESSION['id'];
                $stmt=$mysql->prepare($sql);
                $stmt->execute();
                $res=$stmt->fetchAll();
                $type=NULL;
                foreach( $res as $row ){

                  $type=$row['type'];
                }

                //If the user is a Customer
                if ($type == "Customer")
                {
                  $_SESSION['usernamedb'] = "19ac3user12";
                  echo "<li><a href=\"".$dir."displayCustomerSchedule.php\">Schedule</a></li>";
                  echo "<li><a href=\"".$dir."CourseSignUp.php\">Course Sign Up</a></li>";
                }
                else
                {
                  //If the user is staff
                  $sql = "SELECT job_title FROM staffInfo WHERE id=".$_SESSION['id'];
                  $stmt=$mysql->prepare($sql);
                  $stmt->execute();
                  $res=$stmt->fetchAll();
                  $job = NULL;
                  foreach( $res as $row ){
                    $job = $row['job_title'];
                  }

                  if ($job == "Instructor")
                  {
                    $_SESSION['usernamedb'] = "19ac3extra12";
                    echo "<li><a href=\"".$dir."displayLecturerSchedule.php\">Schedule</a></li>";
                    echo "<li><a href=\"".$dir."ClientInformationPage.php\">Client Information</a></li>";
                  }
                  else if ($job == "Manager")
                  {
                    $_SESSION['usernamedb'] = "19ac3u12";
                    echo "<li><a href=\"".$dir."displayStaff.php\"> Staff Management</a></li>";
                    echo "<li><a href=\"".$dir."finances.php\">Finances</a></li>";
                  }

                }

                echo "<li><a href=\"".$dir."myDetails.php\">My Details</a></li>";
                //Give user option to log out.
                echo "<li><a href=\"".$dir."Functional/logout.php\"> Log Out</a></li>";
                //Say hello
                echo "<li>Hello, ".$_SESSION['username']."</li>";
              }
              else
              {
                  echo "<li><a href='#service'>Service</a></li>";
                  echo "<li><a href='#about'>Our Team</a></li>";
                  echo "<li><a href='#contact'>Contact</a></li>";
                  echo "<li><a href=\"".$dir."SignIn.php\">Log in</a></li>";
                  //Give user option to log in.
              }
            }

            //If not on the index page (done due to folder structure)
            if($_SERVER["URL"] != "/2019-ac32006/team12/index.php")
            {
            #  echo "<li class='active'><a href=\"../index.php\">Home</a></li>";
              displayLoginStatus("");
            }
            else
            {
              #echo "<li class='active'><a href=\"index.php\">Home</a></li>";
              displayLoginStatus("PHP/");
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>
</div>
