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
        top: 120px;
        left: 50%;
        transform: translateX(-50%);
    }

    /*error message*/
    Err1{ font-size:11px;
          color:rgb(250,0,100);
          position: absolute;
          top: 190px;
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
        height: 400px;
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

$name = $email= "";
$nameErr = $emailErr= "";
$isCorrect = False;//is the format of input correct





//determine if the format of input is correct
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isCorrect = True;//initialize

    $email = test_input($_POST["email"]);
    if (empty($_POST["email"])) { $emailErr = "Email is required!"; $isCorrect=False; }//input is empty
    elseif (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",test_input($_POST["email"])))
    { $emailErr = "Invalid email format!"; $isCorrect=False; }//invalid format
    else
    {
        include "db.php";
        $sql = "SELECT * from accountinfo where email = '$email' ";
        $stmt=$mysql->prepare($sql);
        $stmt->execute();
        $res=$stmt->fetchAll();
        $emailErr = "Incorrect email address";
        $isCorrect=False;
        foreach( $res as $row )
        {
            if($row['email']==$email)
            {
                $emailErr = "";
                $isCorrect=True;
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

//if all correct, sent a email
if($isCorrect==True)
{

$isCorrect=False;
$message = "An email has been sent to you. Get your username in the email. Or follow the link sent in the email to change your password!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script>window.location = 'https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/php/SignIn.php'</script>";

}

?>




<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="background-image: url(img/background/triangle-mosaic.png)">
    <br>
    <h1><font size = 4.5>GET LOG IN DETAILS</font></h1>
    <br>
    <br>
    <t1><br> <input type="text" name="email" class="form-control text-field-box2" placeholder="Email address" value="<?php echo $email;?>"></t1>
    <span class="error">  <Err1><?php echo $emailErr;?></Err1></span>
    <br>
    <br>
    <br>
    <s1><input type="Submit" class="btn rounded" value="Submit"></s1>
    <l1>Remember your details? Click <a href="SignIn.php">here</a> to log in.</l1>


</form>








<f1>
<?php
  readfile("footer.html")
?>
</f1>
</body>
</html>
