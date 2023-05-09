<?php
    function startSessionTimer () {
        $_SESSION['session_last_time'] = time();
    }

    function checkSessionTimer() {
        if (isset($_SESSION["iduser"])) {
            $nowTime = time();
             if($nowTime-$_SESSION['session_last_time'] < 120) {
                $_SESSION['session_last_time'] = $nowTime;
             } else {
                session_destroy();
                header("Location: login.php?err_code=no_longer_time");
                die();
             }
        }
    }
?>