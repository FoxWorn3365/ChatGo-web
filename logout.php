<?php
session_start();
$_COOKIE["__auth"] = "";
session_destroy();
header("Location: /");