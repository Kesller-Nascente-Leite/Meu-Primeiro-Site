<?php
session_start();
require "../../configdb.php";
require 'verifica_sessao.php';


if (isset($_SESSION['id'])) {
    $paciente = $_SESSION['paciente'];
} else {
    $paciente =  $_SESSION['paciente'] = "Usuario não logado";
}


