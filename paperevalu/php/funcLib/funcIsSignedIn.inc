<?php
function isSignedIn() {
    if( isset($_SESSION['usr'] ) && isset( $_SESSION[ 'pwd' ] ) ) {
        return true;
    } else {
        return false;
    }
}
?>
