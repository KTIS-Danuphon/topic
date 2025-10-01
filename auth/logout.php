<?php
session_start();
// ทำลาย session
session_destroy();
header("Location: ../login.php");
