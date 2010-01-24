<?
$user="root";
$password="signature";
$database="contacts";
mysql_connect(localhost,$user,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="CREATE TABLE contacts (id int(8) NOT NULL auto_increment,first varchar(15) NOT NULL,last varchar(15) NOT NULL,username1 varchar(15) NOT NULL,password1 varchar(15) NOT NULL,position varchar(15) NOT NULL,phone varchar(20) NOT NULL,mobile varchar(20) NOT NULL,fax varchar(20) NOT NULL,priority varchar(20) NOT NULL,email varchar(30) NOT NULL,web varchar(30) NOT NULL,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
$query1="CREATE TABLE member ( 
  id int NOT NULL auto_increment, 
  username varchar(20) NOT NULL default '', 
  password char(32) binary NOT NULL default '', 
  cookie char(32) binary NOT NULL default '', 
  session char(32) binary NOT NULL default '', 
  ip varchar(15) binary NOT NULL default '', 
  PRIMARY KEY (id), 
  UNIQUE KEY username (username) 
); ";

mysql_query($query);
mysql_query($query1);
echo " Database Creation Successful";
mysql_close();
?>
