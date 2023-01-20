<?php
require 'config.php';

if( isset($_SESSION['login']) ) {
    if( $_SESSION['login']['login_sebagai'] == 'Admin' ) {
        header('Location: admin/index.php');
    } else {
        header('Location: teknisi/index.php');
    }

} else {
    header('Location: login.php');
}