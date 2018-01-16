<?php
@session_start();
// error_reporting(0);
require_once 'conn.session.php';
$cms = new conn_session();
$cms->session_destroyer();
header('Location: ../');
?>