<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
//Determines relative file path.
function styleLocation($dir)
{
  echo "<link rel=\"stylesheet\" href=\"".$dir."css/bootstrap.min.css\">";
  echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$dir."css/font-awesome.min.css\">";
  echo "<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,600|Raleway:600,300|Josefin+Slab:400,700,600italic,600,400italic' rel='stylesheet' type='text/css'>";
  echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$dir."css/slick-team-slider.css\">";
  echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$dir."css/style.css\">";
}

//If not on the index page (done due to folder structure)
if($_SERVER["URL"] != "/2019-ac32006/team12/index.php")
{
  styleLocation("");
}
else
{
  styleLocation("PHP/");
}
?>
