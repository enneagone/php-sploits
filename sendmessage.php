<?php
require_once 'common.php';
require_once 'dbfuncs.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(!empty($_REQUEST['user']) && !empty($_REQUEST['subject'])
        && !empty($_REQUEST['message'])) {
        $msgSQL = "insert into messages(user_id, subject, message) values('" . 
                    $_REQUEST['user'] . "','" . $_REQUEST['subject'] . "','"
                    . $_REQUEST['message'] . "')";

        $inserted = insertQuery($msgSQL);
        if($inserted === false) {
            echo 'Unable to send message. Sorry.';
        }
        else {
            echo 'Message successfully sent! Hooray!';
        }
    }
}
else {
    $userSQL  = "select id, firstname, surname from users";
    $userList = getSelect($userSQL);

    if(!$userList) die('Unable to retrieve users to message');
    $select = "<select name='user' id='user' class='form-control'>";
    foreach($userList as $user)
        $select .= "<option value='" . $user[0] . "'>" . $user[1]
        . " " . $user[2] . "</option>";
    $select .= "</select>";
?>
<div class="contact-clean">
    <form method="POST">
        <h2 class="text-center"><br>Select a user you wish to message<br></h2>
        <div class="form-group">
                <h1>User:</h1>
                <?=$select?>
        </div>
        <div class="form-group">
                <h1>Subject :</h1><input class="form-control" type="text"  name="subject"><small class="form-text text-danger"></small>
        </div>
        <div class="form-group"><textarea class="form-control" name="message" placeholder="Message" rows="14"></textarea></div>
        <div class="form-group"><button class="btn btn-primary" type="submit" value="Send pigeon">send </button></div>
    </form>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/Profile-Edit-Form.js"></script>
<?php
}
