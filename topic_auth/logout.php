<?php
session_start();
session_unset();
session_destroy();

header("Location: index_login.php?expired=1");
exit;