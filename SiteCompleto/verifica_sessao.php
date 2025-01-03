<?php
//Define o tempo que a sessão irá durar
if (isset($_SESSION['ULTIMA_ATIVIDADE']) && (time() - $_SESSION['ULTIMA_ATIVIDADE'] > 1800)){
    
    #mudar 1800 para fazer testes 
    unset($_SESSION['ULTIMA_ATIVIDADE']); 
    unset($_SESSION['paciente']); 
    
    header("Location: index.php");
    $_SESSION['msg'] = "Sua sessão Expirou";
    exit();
}
$_SESSION['ULTIMA_ATIVIDADE'] = time();
$msg = '';
