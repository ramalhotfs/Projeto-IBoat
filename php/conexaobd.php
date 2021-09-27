<?php
    $mysqli = new mysqli("localhost", "root", "", "tcc");
    /* check connection */
    if ($mysqli->connect_errno)     
        echo "Erro de conexão:  (". $mysqli->connect_error.") ".$mysqli->connect_error;