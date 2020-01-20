<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php
      include('headStyle.php')
    ?>
</head>




<style>
    body{ font-size:100%;  }
    h1{ position: absolute;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);}
    /*footer*/
    f1{
        width:100%;
        height:1%;
        position:absolute;
        bottom:0px;
        left: 50%;
        transform: translateX(-50%);
    }
    /*text field box*/
    t1{ font-size:16px;
        position: absolute;
        top: 100px;
        left: 50%;
        transform: translateX(-50%);
    }
    t2{ font-size:16px;
        position: absolute;
        top: 180px;
        left: 50%;
        transform: translateX(-50%);
    }
    t3{ font-size:16px;
        position: absolute;
        top: 260px;
        left: 50%;
        transform: translateX(-50%);
    }
    t4{ font-size:16px;
        position: absolute;
        top: 340px;
        left: 50%;
        transform: translateX(-50%);
    }
    /*error message*/
    Err1{ font-size:11px;
          color:rgb(250,0,100);
          position: absolute;
          top: 165px;
          left: 50%;
          transform: translateX(-100px);
    }
    Err2{ font-size:11px;
          color:rgb(250,0,100);
          position: absolute;
          top: 245px;
          left: 50%;
          transform: translateX(-100px);
          }
    Err3{ font-size:11px;
          color:rgb(250,0,100);
          position: absolute;
          top: 325px;
          left: 50%;
          transform: translateX(-100px);
    }
    Err4{ font-size:11px;
          color:rgb(250,0,100);
          position: absolute;
          top: 405px;
          left: 50%;
          transform: translateX(-100px);
    }
    /*form*/
    form {
        position:absolute;
        top:200px;
        left: 50%;
        transform: translateX(-50%);
        border: 2px solid grey;
        width:415px;
        height: 550px;
        padding:10px 40px;
        background-color: beige;
        /*box-shadow: 10px 10px 5px grey;*/
        border-radius: 50px;
        /*display: none;*/
    }
    s1{ position: absolute;
        bottom: 50px;
        right: 50px;
    }
    l1{ position: absolute;
        font-size:12px;
        color:rgb(150,150,150);
        left:50px;
        bottom:10px;
    }

</style>

<body background= 'img/background/beach.jpg'>

  <?php
    include("header.php")
  ?>

<?php

$name = $email = $password1 = $password2 /*= $gender = $type */= "";
$nameErr = $emailErr /*= $genderErr = $typeErr*/ = $password1Err = $password2Err= "";
$isCorrect = False;//is the format of input correct





//determine if the format of input is correct
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isCorrect = True;//initialize
    $name = test_input($_POST["name"]);
    if (empty($_POST["name"])) { $nameErr = "Name is required!"; $isCorrect=0; }//input is empty
    else
    {   //query the same username
        include "db.php";
        $sql = "SELECT * from accountinfo where username = '$name' ";
        $stmt=$mysql->prepare($sql);
        $stmt->execute();
        $res=$stmt->fetchAll();
        foreach( $res as $row )
        {
            if($row['username']==$name)
            {
                $nameErr = "This username is already taken!";
                $isCorrect=False;
            }
        }
    }

    if (empty($_POST["password1"])) { $password1Err = "Password is required!"; $isCorrect=False; }//input is empty
    else { $password1 = test_input($_POST["password1"]); }

    if (empty($_POST["password2"])) { $password2Err = "Password is required!"; $isCorrect=False; }//input is empty
    elseif($_POST["password1"]!=$_POST["password2"]) { $password2Err = "Entered passwords differ!"; $isCorrect=False; }//invalid format
    else { $password2 = test_input($_POST["password2"]); }

    $email = test_input($_POST["email"]);
    if (empty($_POST["email"])) { $emailErr = "Email is required!"; $isCorrect=False; }//input is empty
    elseif (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",test_input($_POST["email"])))
    { $emailErr = "Invalid email format!"; $isCorrect=False; }//invalid format
    else
    {
        $sql = "SELECT * from accountinfo where email = '$email' ";
        $stmt=$mysql->prepare($sql);
        $stmt->execute();
        $res=$stmt->fetchAll();
        foreach( $res as $row )
        {
            if($row['email']==$email)
            {
                $emailErr = "This email has been used!";
                $isCorrect=False;
            }
        }
    }

}

//test input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//if all correct, jump to 'addAccount.php'
if($isCorrect==True)
{
    header("Location:addAccount.php?name=$name&pass=$password1&email=$email&isCorrect=$isCorrect");
    $isCorrect=False;
}

?>




<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="background-image: url(img/background/triangle-mosaic.png)">
    <br>
    <h1><font size = 4.5>CREATE ACCOUNT</font></h1>
    <br>
    <br>
    <t1><br> <input type="text" name="name" class="form-control text-field-box2" placeholder="Username" value="<?php echo $name;?>"></t1>
    <span class="error">  <Err1><?php echo $nameErr;?></Err1></span>
    <br>
    <br>
    <br>
    <t2><br> <input type="text" name="password1" class="form-control text-field-box2" placeholder="Password" value="<?php echo $password1;?>"></t2>
    <span class="error">  <Err2><?php echo $password1Err;?></Err2></span>
    <br>
    <br>
    <br>
    <t3><br> <input type="text" class="form-control text-field-box2" placeholder="Retype Password"name="password2" ></t3>
    <span class="error">  <Err3><?php echo $password2Err;?></Err3></span>
    <br>
    <br>
    <br>
    <t4><br> <input type="text" name="email" class="form-control text-field-box2" placeholder="Email" value="<?php echo $email;?>"></t4>
    <span class="error">  <Err4><?php echo $emailErr;?></Err4></span>
    <br>
    <br>
    <br>
    <s1><input type="Submit" class="btn rounded" value="Sign up"></s1>
    <l1>Already have an account? Click <a href="SignIn.php">here</a> to log in.</l1>


</form>








<f1>
<?php
  readfile("footer.html")
?>
</f1>
</body>
</html>
