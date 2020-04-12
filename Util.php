<?php 
class Util {       
    public function clearAuthCookie() {
        if (isset($_COOKIE["token"])) {
            setcookie("token", "");
        }

    }
}
?>