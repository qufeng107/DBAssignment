<!doctype html>
<html lang="en">
<head>
    <meta name="save" content="history">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
    <?php
      include("headStyle.php")
    ?>
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js">
    </script>



</head>


<style>
    body{ font-size:100%;


    }
    /*footer*/
    f1{
        width:100%;
        height:1%;
        position:absolute;
        bottom:0px;
        left: 50%;
        transform: translateX(-50%);
    }
    /*Log in*/
    h1{
        position: absolute;
        font-size: 40px;
        font-weight: 500;
        top: 0px;
        left: 50%;
        transform: translateX(-50%);
    }
    /*text field box*/
    t1{ font-size:16px;
        position: absolute;
        top: 130px;
        left: 50%;
        transform: translateX(-50%);
    }
    t2{ font-size:16px;
        position: absolute;
        top: 210px;
        left: 50%;
        transform: translateX(-50%);
    }
    /*error message*/
    Err1{ font-size:11px;
          color:rgb(250,0,100);
          position: absolute;
          top: 175px;
          text-align: center;
          transform: translateX(-100px);
    }
    Err2{ font-size:11px;
          color:rgb(250,0,100);
          position: absolute;
          top: 255px;
          text-align: center;
          transform: translateX(-100px);
          }
    /*form*/
    form{
        position:fixed;
        top:250px;
        left:300px;
        border: 2px solid grey;
        width:400px;
        height: 400px;
        padding:10px 40px;
        /*box-shadow: 10px 10px 5px grey;*/
        border-radius: 50px;
        /*display: none;*/
    }

    p1{
        position:fixed;
        top:200px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 50px;
        font-weight: 800;
        color: white;
        display: none;
    }

    /*submit*/
    s1{ position: absolute;
        bottom: 50px;
        right: 50px;
    }
    /*link to sign up page*/
    l1{ position: absolute;
        font-size:12px;
        color:rgb(150,150,150);
        left:50px;  
        bottom:10px;
    }
    /*fogot password*/
    l2{ position: absolute;
        font-size:12px;
        color:rgb(150,150,150);
        text-align: center;
        transform: translateX(-120px);
        bottom:65px;
    }
</style>



<body background= 'img/background/aircraft1.jpg'>

  <?php
    include("header.php");
  ?>
<div class="section-padding">
  <div class="container">
    <div class="row">
      <div class="page-title text-center">
<?php
    if($_SESSION['id']){
        header('LOCATION:https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/index.php');
        }//if already logged In, jump to index.php


$name = $pass = $type =  "";
$nameErr = $passErr = $typeErr = "";


//determine if the inputs are correct
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) { $nameErr = "Name is required"; }
    else {
            $passErr = "Incorrect username or password";
            $name = test_input($_POST["name"]);
        }
    if (empty($_POST["pass"])) { $passErr = "Password is required"; }
    else { $pass = SHA1(test_input($_POST["pass"])); }
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
    $sql = "SELECT * from accountInfo where username = '$name' ";
    $stmt=$mysql->prepare($sql);
    $stmt->execute();
    $res=$stmt->fetchAll();
    foreach( $res as $row )
    {
        if($row['username']==$name && $row['password']==$pass )
        {
            session_start();
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['type']=$row['type'];
            echo "<script>window.location = '../index.php'</script>";
        }

    }

}

?>


<p1>Your journey begins here...</p1>
<?php
if(empty($_POST["record"])) {fade();}
function fade() {

    echo "<script>";
    echo "$(document).ready(function(){";
    echo "  $(\"form\").hide();";
    echo "  $(\"p1\").show();";
    echo "  $(\"p1\").delay(1000).fadeOut(500);";
    echo "  $(\"form\").delay(1300).fadeIn(800); });";
    echo "</script>";
}
?>


<div class="form-sec">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="background-image: url(img/background/triangle-mosaic.png)">

    <h1>LOG IN</h1>
    <t1><input type="text" name="name" class="form-control text-field-box2" placeholder="Username" value="<?php echo $name;?>"></t1>
    <span class="error">  <Err1><?php echo $nameErr;?></Err1></span>
    <t2><input type="password" name="pass" class="form-control text-field-box2" placeholder="Password"></t2>
    <span class="error">  <Err2><?php echo $passErr;?></Err2></span>
    <input type="hidden" name="record" value="1">
    <s1><input type="Submit" class="btn rounded" value="Login"></s1>
    <l1>Don't have an account? Click <a href="SignUp.php">here</a> to sign up.</l1>
    <l2><a href="forgotPassword.php">Forgot log in details?</a></l2>

</form>

</div>
</div>
</div>
</div>
</div>

<f1>
<?php
  readfile("footer.html")
?>
</f1>









<script>

/**
*
*  Secure Hash Algorithm (SHA1)
*  http://www.webtoolkit.info/javascript_sha1.html#.Xc1N3lf7SUk
*
**/
function SHA1 (msg) {
    function rotate_left(n,s) {
        var t4 = ( n<<s ) | (n>>>(32-s));
        return t4;
    };
    function lsb_hex(val) {
        var str="";
        var i;
        var vh;
        var vl;
        for( i=0; i<=6; i+=2 ) {
            vh = (val>>>(i*4+4))&0x0f;
            vl = (val>>>(i*4))&0x0f;
            str += vh.toString(16) + vl.toString(16);
        }
        return str;
    };
    function cvt_hex(val) {
        var str="";
        var i;
        var v;
        for( i=7; i>=0; i-- ) {
            v = (val>>>(i*4))&0x0f;
            str += v.toString(16);
        }
        return str;
    };
    function Utf8Encode(string) {
        string = string.replace(/\r\n/g,"\n");
        var utftext = "";
        for (var n = 0; n < string.length; n++) {
            var c = string.charCodeAt(n);
            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }
        }
        return utftext;
    };
    var blockstart;
    var i, j;
    var W = new Array(80);
    var H0 = 0x67452301;
    var H1 = 0xEFCDAB89;
    var H2 = 0x98BADCFE;
    var H3 = 0x10325476;
    var H4 = 0xC3D2E1F0;
    var A, B, C, D, E;
    var temp;
    msg = Utf8Encode(msg);
    var msg_len = msg.length;
    var word_array = new Array();
    for( i=0; i<msg_len-3; i+=4 ) {
        j = msg.charCodeAt(i)<<24 | msg.charCodeAt(i+1)<<16 |
        msg.charCodeAt(i+2)<<8 | msg.charCodeAt(i+3);
        word_array.push( j );
    }
    switch( msg_len % 4 ) {
        case 0:
            i = 0x080000000;
        break;
        case 1:
            i = msg.charCodeAt(msg_len-1)<<24 | 0x0800000;
        break;
        case 2:
            i = msg.charCodeAt(msg_len-2)<<24 | msg.charCodeAt(msg_len-1)<<16 | 0x08000;
        break;
        case 3:
            i = msg.charCodeAt(msg_len-3)<<24 | msg.charCodeAt(msg_len-2)<<16 | msg.charCodeAt(msg_len-1)<<8    | 0x80;
        break;
    }
    word_array.push( i );
    while( (word_array.length % 16) != 14 ) word_array.push( 0 );
    word_array.push( msg_len>>>29 );
    word_array.push( (msg_len<<3)&0x0ffffffff );
    for ( blockstart=0; blockstart<word_array.length; blockstart+=16 ) {
        for( i=0; i<16; i++ ) W[i] = word_array[blockstart+i];
        for( i=16; i<=79; i++ ) W[i] = rotate_left(W[i-3] ^ W[i-8] ^ W[i-14] ^ W[i-16], 1);
        A = H0;
        B = H1;
        C = H2;
        D = H3;
        E = H4;
        for( i= 0; i<=19; i++ ) {
            temp = (rotate_left(A,5) + ((B&C) | (~B&D)) + E + W[i] + 0x5A827999) & 0x0ffffffff;
            E = D;
            D = C;
            C = rotate_left(B,30);
            B = A;
            A = temp;
        }
        for( i=20; i<=39; i++ ) {
            temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0x6ED9EBA1) & 0x0ffffffff;
            E = D;
            D = C;
            C = rotate_left(B,30);
            B = A;
            A = temp;
        }
        for( i=40; i<=59; i++ ) {
            temp = (rotate_left(A,5) + ((B&C) | (B&D) | (C&D)) + E + W[i] + 0x8F1BBCDC) & 0x0ffffffff;
            E = D;
            D = C;
            C = rotate_left(B,30);
            B = A;
            A = temp;
        }
        for( i=60; i<=79; i++ ) {
            temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0xCA62C1D6) & 0x0ffffffff;
            E = D;
            D = C;
            C = rotate_left(B,30);
            B = A;
            A = temp;
        }
        H0 = (H0 + A) & 0x0ffffffff;
        H1 = (H1 + B) & 0x0ffffffff;
        H2 = (H2 + C) & 0x0ffffffff;
        H3 = (H3 + D) & 0x0ffffffff;
        H4 = (H4 + E) & 0x0ffffffff;
    }
    var temp = cvt_hex(H0) + cvt_hex(H1) + cvt_hex(H2) + cvt_hex(H3) + cvt_hex(H4);
    return temp.toLowerCase();
}



</script>







</body>
</html>
