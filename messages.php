<?php
require_once 'common.php';
require_once 'dbfuncs.php';

if(!empty($_SESSION['authed']) && $_SESSION['authed'] === true) {
    if(!empty($_SESSION['userid'])) {
        $msgSQL = "select * from messages where user_id = " .
                    $_SESSION['userid'];
        $messages = getSelect($msgSQL);
        echo "<div id='message-background'>";
        echo "<div id='message-container'>";
        echo "<h2>Here are messages people have sent you!</h2>";
        echo "<table width='50%'>";
        echo "<tr><td><strong>Subject</strong></td><td><strong>Message</strong></td>";
        if(!empty($messages) && is_array($messages)) {
            foreach($messages as $message) {
                echo "<tr><td>" . $message[2] . "</td><td><i>" . $message[3] . "</i></td></tr>";
            }
        }
        echo "</table>";
        echo "</div>";
        echo "</div>";
    }
}
else {
    header('location: /');
    die;
}
