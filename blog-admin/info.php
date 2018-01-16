<?php
@session_start();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

echo '<pre>';
print_r($_COOKIE);

echo 'COOKIE: ' . $_COOKIE["user"];
echo '</pre>';
?>