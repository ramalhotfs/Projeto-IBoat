<?php

    $codigo = intval($_GET['codigo']);

    session_start();
    
    unset($_SESSION['user']);
    
    echo "<script>location.href='../../fipac.php'</script>";
?>
    