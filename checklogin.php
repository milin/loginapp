<?
$username="root";
$password="signature";
$database="contacts";

$username1=$_POST['username1'];
$password1=$_POST['password1'];

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");


$sql = "SELECT * FROM contacts where username1='$username1' AND password1='$password1'";
#echo "$sql";
$result=mysql_query($sql);
$num=mysql_numrows($result);

#echo "$num";
 echo " <head>";
 echo "<title>MEMBER REGISTRATION </title>";
echo  "<link rel=\"stylesheet\" href=\"css/blueprint/screen.css\" type=\"text/css\" media=\"screen, projection\">";
echo  "<link rel=\"stylesheet\" href=\"css/blueprint/print.css\" type=\"text/css\" media=\"print\">";  
echo  "</head>";
if($num==1)
  echo " <div class=\"success\"> <h1>You Have Logged On</h1>";
else
 echo "<div class = \"error\"> <h1>log in failed </h1></div>";


?>
