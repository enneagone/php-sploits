<?php
require_once 'common.php';
require_once 'dbfuncs.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(!empty($_REQUEST['username']) && !empty($_REQUEST['password'])) {
        $authSQL = "select * from users where username = '" . $_REQUEST['username'] .
           "' and password = '" . $_REQUEST['password'] . "'";
        $authed = getSelect($authSQL);

        if(!$authed) {
            echo 'Invalid login.<br>';
	    error_log('Loglevel: WARNING | Connection failed: ' . $_REQUEST['username']);
            die;
        }
        else {
            echo 'Success, you authed! <br>';
            echo 'SQL Used: ' . $authSQL;
            $_SESSION['authed'] = true;
            $_SESSION['userid'] = $authed[0][0];
            $_SESSION['username'] = $authed[0][1];
        }
    }
}
else if(!empty($_SESSION['authed']) && $_SESSION['authed'] === true) {
    header('location: /messages.php');
    die;
}
else {
?>
<div class="login-dark">
    <form method="POST">
        <h2 class="sr-only">Login Form</h2>
        <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
        <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Usernale"></div>
        <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
        <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div>
    </form>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/Profile-Edit-Form.js"></script>
<?php
} 
