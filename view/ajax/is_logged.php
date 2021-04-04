<?php

   // session_cache_expire(10); // Sess\ao expira em 10 minitos
if (!session_start()){
    session_start();

	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../index.php");
		exit;
    }
}