<?php
session_start();
session_unset($_SESSION['access']);
session_destroy($_SESSION['access']);
?>