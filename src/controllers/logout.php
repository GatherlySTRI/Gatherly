<?php

require_once 'vendor/autoload.php';

session_start();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: login");
exit;