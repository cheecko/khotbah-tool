<?php
    session_start();
    $_SESSION["user"] = "admin";
    header("Location: ../");
?>