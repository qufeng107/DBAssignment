<html>
<head>
<link rel="stylesheet" type="text/css" href="css/input-style.css">
<?php
	include('headStyle.php');
?>

<style>
	div.lookgood{
		margin-top:150px;
		margin-left:150px;
	}
	h3.header{
		margin-left:-25px;
	}
	input.button{
		margin-right:50px;
	}
	f1{
        width:100%;
        height:4.5%;
        position:absolute;
        bottom:0px;
        left: 50%;
        transform: translateX(-50%);
    }
    Err{ font-size:11px;
          color:rgb(250,0,100);
    }
</style>

</head>
	<body style="background-image: url('img/sky.jpg');background-attachment: fixed;">
		<?php
			include("header.php");
			if(!$_SESSION['id']){
				header('LOCATION:https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/PHP/SignIn.php');
				}//if someone use url to get in this page without login, jump to SignIn.php
		?>



        <?php
        	    	
		include('db.php');
		$id = $_SESSION['id'];
        $stmt = $mysql->prepare("SELECT password FROM accountInfo WHERE id =:ID");
        $stmt->bindParam(":ID", $id);
        $stmt->execute();
        $result=$stmt->fetchAll();

        $oldPass = $newPass1 = $newPass2 =  "";
        $oldPassErr = $newPass1Err = $newPass2Err = "";
        $isCorrect = True;//if the format of input is correct
        
        foreach($result as $row ){
            $pass=$row['password'];
            //determine if the inputs are correct
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                if (empty($_POST["oldPass"])) { $oldPassErr = "Old password is required !"; $isCorrect=False; }
                else if($pass != SHA1($_POST["oldPass"]))
                    { $oldPassErr = "Incorrect old password !"; $isCorrect=False; }
                else { $oldPass = $_POST["oldPass"]; }

                if (empty($_POST["newPass1"])) { $newPass1Err = "new password is required !"; $isCorrect=False; }
                else if($pass == SHA1($_POST["oldPass"]) && $pass == SHA1($_POST["newPass1"]))
                    {  $newPass1Err = "New password is the same as the old !"; $isCorrect=False; }
                else { $newPass1 = $_POST["newPass1"]; }

                if (empty($_POST["newPass2"])) { $newPass2Err = "new password is required !"; $isCorrect=False; }
                else if(SHA1($_POST["newPass1"]) != SHA1($_POST["newPass2"])){ $newPass2Err = "Entered new passwords differ !"; $isCorrect=False; }
                else { $newPass2 = $_POST["newPass2"]; }
            }
            


		}


        if($isCorrect==True)
        {
            $pass=SHA1($newPass1);
            $sql="UPDATE accountinfo SET password=:pass where id=:ID";
		    $stmt = $mysql->prepare($sql);
            $stmt->bindParam(":ID", $id);       
            $stmt->bindParam(":pass", $pass);

            if($stmt->execute()) 
            {
                $message = "Password Changed to ".$newPass1;
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            else{
                $message = "Failed";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            
            $isCorrect=False;
            // $message = "Password Changed.".$pass;
	    	// echo "<script type='text/javascript'>alert('$message');</script>";
	    	echo "<script>window.location = 'https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/php/myDetails.php'</script>";
        }
	    ?>

        <div class="lookgood">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<ul class="form-style-1">
				<h3 class="header"> Change Password </h3>
				<li>
				    <label>Old Password <span class="required">*</span></label>
                      <input type="password" name="oldPass"  class="field-long" value="<?php echo $oldPass;?>"/>
                      <span class="error"> <Err><?php echo $oldPassErr;?></Err></span>
				</li>
				<li>
					<label>New Password<span class="required">*</span></label>
                    <input type="password" name="newPass1"  class="field-long" value="<?php echo $newPass1;?>"/>
                    <span class="error"> <Err><?php echo $newPass1Err;?></Err></span>
				</li>
					<li>
					<label>New Password again<span class="required">*</span></label>
                     <input type="password" name="newPass2"  class="field-long" />
                     <span class="error"> <Err><?php echo $newPass2Err;?></Err></span>
				</li>
				<li>
					<input  type="Submit" value="submit"/>
				</li>
				</ul>
			</form>
		</div>


		<f1>
		<?php
			readfile("footer.html")
		?>
        </f1>
	</body>
</html>














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
