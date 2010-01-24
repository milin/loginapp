<?
$username="root";
$password="signature";
$database="contacts";

$first=$_POST['first'];
$last=$_POST['last'];
$username1=$_POST['username1'];
$password1=$_POST['password1'];
$position=$_POST['position'];
$phone=$_POST['phone'];
$mobile=$_POST['mobile'];
$fax=$_POST['fax'];
$email=$_POST['email'];
$priority=$_POST['priority'];
$web=$_POST['web'];

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$query = "INSERT INTO contacts VALUES ('','$first','$last','$username1','$password1','$position','$phone','$mobile','$fax','$email','$priority','$web')";
mysql_query($query);
echo "success";

mysql_close();
?>
