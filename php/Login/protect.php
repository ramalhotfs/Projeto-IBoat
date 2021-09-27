<?php

    
    if(!function_exists("protect")){
        function protect(){
            if (!isset($_SESSION)) {
                session_start();
              }
              
            if ($_SESSION['user'] !=true) {
                // Destrói a sessão por segurança
                session_destroy();
                // Redireciona o visitante de volta pro login
                header("Location: ../fipac.php"); 
            }
                    
        }
            
    }