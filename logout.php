<?php
require_once 'common.php';
require_once 'dbfuncs.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
	session_destroy();
	header('Location:/login.php');
	exit();
}
elseif($_SESSION['authed'] == true){
?>
<form method="POST">
    <input type="submit" value="Logout">
</form>
<?php
}
else {
	echo 'Not connected';
}
