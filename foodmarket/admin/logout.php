<?php
//include  constants php for HOMEURL
include('../config/constants.php');

//destroy the session
session_destroy(); //unsets $_SESSION['user']

//redirect to login page
header('location:'.HOMEURL.'admin/login.php');
?>