<?php
session_start();
echo $_SESSION['username'] ?? '匿名用户';
?>