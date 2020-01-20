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
    body{ font-size:100%; 



        }
    h1{ }
    t1{ font-size:16px;
        color:rgb(100,100,100); }
    Err{ font-size:10px; color:rgb(250,0,100); }
    form {
        position:fixed;
        top:100px;
        left:475px;
        border: 2px solid grey;
        width:400px;
        height: 400px;
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
    n1{
        position: absolute;
        font-size:10px;
        color:rgb(100,100,100);
        left:150px;
        bottom:100px;
    }

</style>

<body>


<?php

$name = $pass = $type = "";
$nameErr = $passErr = $typeErr = "";


//determine if the input is correct
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) { $nameErr = " Name is required"; }
    else { $name = test_input($_POST["name"]); }

    if (empty($_POST["pass"])) { $passErr = " Password is required"; }
    else { $pass = test_input($_POST["pass"]); }

    if (empty($_POST["type"])) { $typeErr = " Account type is required"; }
    else { $type = test_input($_POST["type"]); }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if(!empty($name))
{
    include "db.php";
    $sql = "SELECT * from account where username = '$name' ";
    $stmt=$mysql->prepare($sql);
    $stmt->execute();
    $res=$stmt->fetchAll();
    foreach( $res as $row ) 
    {

        if($row['username']==$name && $row['password']==$pass && $row['type']==$type) 
        {
            echo " Sign in succeeded! ";
            //header("Location:addAccount.php?name=$name&password=$password1&type=$type");
        }
        else
        {
            echo " Sign in failed! "; 
        }
        
    }


}



?>



<form name="signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <h1>Sign in</h1>
    <br>
    <t1>Name*: <br> <input type="text" name="name" value="<?php echo $name;?>"></t1>
    <span class="error">  <Err><?php echo $nameErr;?></Err></span> 
    <br>
    <br>
    <br>
    <t1>Password*: <br> <input type="text" name="pass" ></t1>
    <span class="error">  <Err><?php echo $passErr;?></Err></span>
    <br>
    <br>
    <br>
    <t1>Account type*:
    <input type="radio" name="type" value="Customer" >Customer
    <input type="radio" name="type" value="Staff">Staff</t1>
    <span class="error">  <Err><?php echo $typeErr;?></Err></span>

    <s1><input type="Submit" value="Submit"></s1>
    <l1>Don't had a account? Click <a href="SignUp.php">here</a> to sign up.</l1>

    
</form>



</body>
</html>