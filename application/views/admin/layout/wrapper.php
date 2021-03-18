<?php
//proteksinya admin pake cek login dari simple login
$this->simple_login->cek_login();
//gabungkan semua layout
require('head.php');
require('header.php');
require('nav.php');
require('content.php');
require('footer.php');
?>