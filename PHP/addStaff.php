<html>
<head>
</head>
<body>
<?php
	include("header.php");
	include "db.php";
	if( isset($_POST['submit']) ){

		// Recieve staff details
		$branch = $_POST['branch'];
		$firstname = $_POST['firstname'];
		$surname = $_POST['surname'];
		$dob = $_POST['dob'];
		$phone = $_POST['phone'];
		$job = $_POST['job_title'];
		$salary = $_POST['salary'];

		// Create account for staff
		$stmt = $mysql->prepare("INSERT INTO accountinfo (username,password,email,type)
		VALUE (:Username,:Password,:Email,'Staff')");
		$stmt->bindParam(":Username", $username);
		$stmt->bindParam(":Password", $password);
		$stmt->bindParam(":Email", $email);

		$username = str_replace(' ', '', $firstname.$surname);
		$email = strtolower ($username)."@aerodestiny.com";
		// Sha1 password
		$password = SHA1("password1234");
		$stmt->execute();

		// Select id of the newly created account
		$stmt = $mysql->prepare("SELECT id FROM accountinfo where username = :Username");
		$stmt->bindParam(":Username", $username);
		$stmt->execute();

		// Get staff id
		$result = $stmt->fetchAll();
		foreach($result as $row) {
    		echo $row['id'];
				$id = $row['id'];
		}
		// Insert new staff row into staffinfo view
		$stmt = $mysql->prepare("INSERT INTO staffinfo (id,branch_name,forename,surname, date_of_birth, phone_number,job_title,annual_salary)
		VALUE (:ID,:Branch,:First,:Last,:DOB,:Phone,:Job,:Salary)");

		$stmt->bindParam(":ID", $id);
		$stmt->bindParam(":Branch", $branch);
		$stmt->bindParam(":First", $firstname);
		$stmt->bindParam(":Last", $surname);
		$stmt->bindParam(":DOB", $dob);
		$stmt->bindParam(":Phone", $phone);
		$stmt->bindParam(":Job", $job);
		$stmt->bindParam(":Salary", $salary);

		$stmt->execute();

		// Check if staff was added
		$stmt = $mysql->prepare("SELECT * from staffinfo where id = :ID");
		$stmt->bindParam(":ID", $id);
		$stmt->execute();
		$results=$stmt->fetchall();

		// If signup is Successful
		if($stmt->rowCount() == 1){
		$message = "Staff Successfully Added";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script>window.location = 'https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/php/displayStaff.php'</script>";
		}
		else{
			$message = "Failed to Add Staff ";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo "<script>window.location = 'https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/php/NewStaff.php'</script>";
		}
	}
?>
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
