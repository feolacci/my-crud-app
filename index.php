<?php
session_start();

// Run application
$stylesheet = ["/assets/css/index.css"];
$script = ["/assets/js/page.class.js"];

require "./views/layouts/header.php";
require "./views/index.php";
require "./views/layouts/footer.php";
