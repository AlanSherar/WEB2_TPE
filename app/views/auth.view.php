<?php 

class AuthView {
    public static function showLogin($error = null) {
        require './templates/login.phtml';
    }
}
?>
