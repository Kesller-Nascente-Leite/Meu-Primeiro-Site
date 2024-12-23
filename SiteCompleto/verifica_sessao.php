<?php
//Define o tempo que a sessão irá durar
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)){
    
    #mudar 1800 para fazer testes 
    unset($_SESSION['LAST_ACTIVITY']); 
    unset($_SESSION['paciente']); 
    
    header("Location: index.php");
    $_SESSION['msg'] = "Sua sessão Expirou";
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();
$msg = '';
