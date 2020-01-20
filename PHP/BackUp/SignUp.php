<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>




<style>
    body{ font-size:100%;  }
    h1{ }
    t1{ font-size:16px;
        color:rgb(100,100,100); }
    Err{ font-size:12px; color:rgb(250,0,100); }
    form {
        position:fixed;
        top:100px;
        left:475px;
        border: 2px solid grey;
        width:400px;
        height: 600px;
        padding:10px 40px;
        background-color: beige;
        box-shadow: 10px 10px 5px grey;
        border-radius: 15px 50px
    }
    s1{ position: absolute;
        bottom: 50px;
        right: 50px;
    }
    l1{ position: absolute;
        font-size:12px;
        color:rgb(100,100,100);
        left:50px;
        bottom:10px;
    }

</style>

<body>


<?php

$name = $email = $password1 = $password2 /*= $gender = $type */= "";
$nameErr = $emailErr /*= $genderErr = $typeErr*/ = $password1Err = $password2Err= "";
$isCorrect = 0;//if the format of input is correct



//determine if the format of input is correct
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isCorrect = 1;//initialize
    $name = test_input($_POST["name"]);
    if (empty($_POST["name"])) { $nameErr = "Name is required!"; $isCorrect=0; }//input is empty
    else
    {   //query the same username
        include "db.php";
        $sql = "SELECT * from account where username = '$name' ";
        $stmt=$mysql->prepare($sql);
        $stmt->execute();
        $res=$stmt->fetchAll();
        foreach( $res as $row ) 
        {
            if($row['username']==$name) 
            {
                $nameErr = "This name is already taken!";
                $isCorrect=0;
            }
        }
    }

    if (empty($_POST["password1"])) { $password1Err = "Password is required!"; $isCorrect=0; }//input is empty
    else { $password1 = test_input($_POST["password1"]); }

    if (empty($_POST["password2"])) { $password2Err = "Password is required!"; $isCorrect=0; }//input is empty
    elseif($_POST["password1"]!=$_POST["password2"]) { $password2Err = "Password is incorrect!"; $isCorrect=0; }//invalid format
    else { $password2 = test_input($_POST["password2"]); }

    $email = test_input($_POST["email"]);
    if (empty($_POST["email"])) { $emailErr = "Email is required!"; $isCorrect=0; }//input is empty
    elseif (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",test_input($_POST["email"])))
    { $emailErr = "Invalid email format!"; $isCorrect=0; }//invalid format
    else 
    {  
        $sql = "SELECT * from account where email = '$email' ";
        $stmt=$mysql->prepare($sql);
        $stmt->execute();
        $res=$stmt->fetchAll();
        foreach( $res as $row ) 
        {
            if($row['email']==$email) 
            {
                $emailErr = "This email has been used!";
                $isCorrect=0;
            }
        }
    }
/*
    if (empty($_POST["gender"])) { $genderErr = " Gender is required"; }
    else { $gender = test_input($_POST["gender"]); }

    if (empty($_POST["type"])) { $typeErr = " Account type is required"; }
    else { $type = test_input($_POST["type"]); }
*/     
}

//test input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//if all correct, jump to 'addAccount.php'
if($isCorrect==1)
{
    header("Location:addAccount.php?name=$name&password=$password1&type=$type&email=$email&isCorrect=$isCorrect");
    $isCorrect=0;
}

?>



<form name="signup" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <br>
    <h1>Sign up</h1>
    <br>
    <br>
    <t1>Name*: <br> <input type="text" name="name" value="<?php echo $name;?>"></t1>
    <span class="error">  <Err><?php echo $nameErr;?></Err></span> 
    <br>
    <br>
    <br>
    <t1>Password*: <br> <input type="text" name="password1" value="<?php echo $password1;?>"></t1>
    <span class="error">  <Err><?php echo $password1Err;?></Err></span>
    <br>
    <br>
    <br>
    <t1>Input your password again*:<br> <input type="text" name="password2" ></t1>
    <span class="error">  <Err><?php echo $password2Err;?></Err></span>
    <br>
    <br>
    <br>
    <t1>Email*:<br> <input type="text" name="email" value="<?php echo $email;?>"></t1>
    <span class="error">  <Err><?php echo $emailErr;?></Err></span>
    <br>
    <br>
    <br>
<!--
    <t1>Gender*:
    <input type="radio" name="gender" value="Female" >Female
    <input type="radio" name="gender" value="Male">Male</t1>
    <span class="error">  <Err><?php echo $genderErr;?></Err></span>
    <br>
    <br>
    <br>
    <t1>Account type*:
    <input type="radio" name="type" value="Customer" >Customer
    <input type="radio" name="type" value="Staff">Staff</t1>
    <span class="error">  <Err><?php echo $typeErr;?></Err></span>
-->
    <s1><input type="Submit" value="Submit"></s1>
    <l1>Already had a account? Click <a href="SignIn.php">here</a> to sign in.</l1>

    
</form>



</body>
</html>