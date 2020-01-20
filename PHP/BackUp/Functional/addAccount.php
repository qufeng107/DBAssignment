<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    


<?php

include "db.php";
//if the format of input is correct
$isCorrect=isset($_GET["isCorrect"])?$_GET["isCorrect"]:"";

//if correct, add account
if($isCorrect==1)
{

//get values from 'SignUp.php'
$name=isset($_GET["name"])?$_GET["name"]:"";
$password=isset($_GET["password"])?$_GET["password"]:"";
$email=isset($_GET["email"])?$_GET["email"]:"";
/*
$gender=isset($_GET["gender"])?$_GET["gender"]:"";
$type=isset($_GET["type"])?$_GET["type"]:"";
*/
$type="Customer";


$sql = "SELECT MAX(id) from account ";
        $stmt=$mysql->prepare($sql);
        $stmt->execute();
        $res=$stmt->fetchAll();
        foreach( $res as $row ) 
        {
            $id= $row['MAX(id)']+1;
        }




$stmt = $mysql->prepare("INSERT INTO account (id, username, password, type ,email)
VALUE (:id, :username, :pass, :acctype, :email)");

$stmt->bindParam(":id", $id);
$stmt->bindParam(":username", $name);
$stmt->bindParam(":pass", $password);
$stmt->bindParam(":acctype", $type);
$stmt->bindParam(":email", $email);

$stmt->execute();


echo "$type Added";

}

?>












    
</body>
</html>
