<?php
require_once 'common.php';
require_once 'dbfuncs.php';

if(!empty($_SESSION['authed']) && $_SESSION['authed'] === true) {
    if(!empty($_SESSION['userid'])) {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(!empty($_REQUEST['firstname']) && !empty($_REQUEST['surname'])
                && !empty($_REQUEST['email'])) {

                $updateSQL = "update users set firstname = '" . $_REQUEST['firstname']
                            . "', surname = '" . $_REQUEST['surname'] . "', email='" .
                            $_REQUEST['email'] . "' where id = " .  $_SESSION['userid'];

                $updated = insertQuery($updateSQL, true);
                if($updated === false) {
                    echo 'Unable to update your profile.';
                }
                else {
                    echo 'Details updated! Excellent.';
                }
            }
        }
        else {
            $userSQL  = "select email, firstname, surname from users where id = " .  $_SESSION['userid'];
            $userList = getSelect($userSQL);

            if(empty($userList) && is_array($userList)) {
                die('Unable to retrieve your settings. Doh!');
            }
            $user = $userList[0];
        ?>
        <form>
            <div class="contact-clean">
                <div class="col-md-8">
                    <h1>Profile </h1>
                    <hr>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Firstname </label><input class="form-control" type="text" name="firstname" value="<?=$user[1]?>"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Lastname </label><input class="form-control" type="text" name="surname" value="<?=$user[2]?>"></div>
                        </div>
                    </div>
                    <div class="form-group"><label>Email </label><input class="form-control" type="email" autocomplete="off" required="" name="email" value="<?=$user[0]?>"></div>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-12 content-right"><button class="btn btn-primary form-btn"  type="submit" value="Update profile">SAVE </button><button class="btn btn-danger form-btn" type="reset">CANCEL </button></div>
                    </div>
                </div>
            </div>
        </form>
        <?php
        }
    }
}
else {
    header('location: /');
    die;
}

