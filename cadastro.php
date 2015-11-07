<?php
/*
 * Description of cadastro
 *
 * @author Gabriel Lopes
 */
require 'config.inc.php';
session_start();
$sistema = filter_input(INPUT_POST, 'sistema');
$ip = filter_input(INPUT_POST, 'ip');
$porta = filter_input(INPUT_POST, 'porta');
$insere = new criacao;
if($_SESSION['admin'] == 'admin'){
$Dados = ['sistema' => $sistema, 'ip' => $ip, 'porta' => $porta];
$insere->ExecutaCriacao('ip_porta', $Dados);
    echo 'Cadastrado com sucesso!!!';
}else{
    echo 'Login:'.' '.$_SESSION['login'].' '.'sem permissão';
}