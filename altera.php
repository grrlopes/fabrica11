<?php
/*
 * Description of cadastro
 *
 * @author Gabriel Lopes
 */
require 'config.inc.php';
session_start();
$id = filter_input(INPUT_POST, 'id');
$ip = filter_input(INPUT_POST, 'ip');
$porta = filter_input(INPUT_POST, 'porta');
$Dados = ['id' => "$id",'ip' => "$ip",'porta' => "$porta"];
$altera = new edicao;
if($_SESSION['admin'] == 'admin'){
$altera->ExecutaEdicao("ip_porta", $Dados, "WHERE id = :id", "id=$id");
    echo 'Alterado com sucesso !!!';
}else{
    echo 'Login:'.' '.$_SESSION['login'].' '.'sem permissão';
}