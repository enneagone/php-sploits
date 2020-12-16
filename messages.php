<?php
require_once 'common.php';
require_once 'dbfuncs.php';

if(!empty($_SESSION['authed']) && $_SESSION['authed'] === true) {
    if(!empty($_SESSION['userid'])) {
        $msgSQL = "select * from messages where user_id = " .
                    $_SESSION['userid'];
        $messages = getSelect($msgSQL);
        echo "<div class='message-container'>";
        echo "<h2>Here are messages people have sent you!</h2>";
        echo "<table width='50%'>";
        echo "<tr><td>Subject</td><td>Message</td>";
        if(!empty($messages) && is_array($messages)) {
            foreach($messages as $message) {
                echo "<tr><td><strong>" . $message[2] . "</strong></td><td>" . $message[3] .
                "</td></tr>";
            }
        }
        echo "</table>";
        echo "</div>";
    }
}
else {
    header('location: /');
    die;
}
