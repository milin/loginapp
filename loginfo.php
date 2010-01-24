<?
$username="root";
$password="signature";
$database="contacts";






function session_defaults() { 
$_SESSION['logged'] = false; 
$_SESSION['uid'] = 0; 
$_SESSION['username1'] = ''; 
$_SESSION['cookie'] = 0; 
$_SESSION['remember'] = false; 
}



class User { 
var $db = null; // PEAR::DB pointer 
var $failed = false; // failed login attempt 
//var $date; // current date GMT 
var $id = 0; // the current user's id 
function User(&$db) { 
$this->db = $db; 
$this->date = $GLOBALS['date']; 
if ($_SESSION['logged']) { 
$this->_checkSession(); 
} elseif ( isset($_COOKIE['mtwebLogin']) ) { 
$this->_checkRemembered($_COOKIE['mtwebLogin']); 
} 
}


//$date = gmdate("'Y-m-d'"); 
$db = db_connect(); 
$user = new User($db);

function _checkLogin($username1, $password1, $remember) { 
$username1 = $this->db->quote($username); 
$password1 = $this->db->quote(md5($password)); 
$sql = "SELECT * FROM member WHERE " . 
"username = $username1 AND " . 
"password = $password1"; 
$result = $this->db->getRow($sql); 
if ( is_object($result) ) { 
$this->_setSession($result, $remember); 
return true; 
} else { 
$this->failed = true; 
$this->_logout(); 
return false; 
} 
}



function _setSession(&$values, $remember, $init = true) { 
$this->id = $values->id; 
$_SESSION['uid'] = $this->id; 
$_SESSION['username1'] = htmlspecialchars($values->username); 
$_SESSION['cookie'] = $values->cookie; 
$_SESSION['logged'] = true; 
if ($remember) { 
$this->updateCookie($values->cookie, true); 
} 
if ($init) { 
$session = $this->db->quote(session_id()); 
$ip = $this->db->quote($_SERVER['REMOTE_ADDR']);

$sql = "UPDATE member SET session = $session, ip = $ip WHERE " . 
"id = $this->id"; 
$this->db->query($sql); 
} 
}


function updateCookie($cookie, $save) { 
$_SESSION['cookie'] = $cookie; 
if ($save) { 
$cookie = serialize(array($_SESSION['username1'], $cookie) ); 
set_cookie('mtwebLogin', $cookie, time() + 31104000, '/directory/'); 
} 
}

function _checkRemembered($cookie) { 
list($username1, $cookie) = @unserialize($cookie); 
if (!$username1 or !$cookie) return; 
$username1 = $this->db->quote($username1); 
$cookie = $this->db->quote($cookie); 
$sql = "SELECT * FROM member WHERE " . 
"(username1 = $username1) AND (cookie = $cookie)"; 
$result = $this->db->getRow($sql); 
if (is_object($result) ) { 
$this->_setSession($result, true); 
} 
}



function _checkSession() { 
$username1 = $this->db->quote($_SESSION['username1']); 
$cookie = $this->db->quote($_SESSION['cookie']); 
$session = $this->db->quote(session_id()); 
$ip = $this->db->quote($_SERVER['REMOTE_ADDR']); 
$sql = "SELECT * FROM member WHERE " . 
"(username1 = $username1) AND (cookie = $cookie) AND " . 
"(session = $session) AND (ip = $ip)"; 
$result = $this->db->getRow($sql); 
if (is_object($result) ) { 
$this->_setSession($result, false, false); 
} else { 
$this->_logout(); 
} 
}

?>
