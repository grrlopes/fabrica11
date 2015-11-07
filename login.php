<?php
/*
 * Description of login
 *
 * @author Gabriel Lopes
 */
require_once 'config.inc.php';
session_start();
$login = filter_input(INPUT_POST,'login');
$senha = filter_input(INPUT_POST,'senha');
if(empty($login)){
    echo 'login';
    exit;
}elseif(empty($senha)){
    echo 'senha';
    exit;
}else{
$logar = new login;
$logar->Lautentica($login, $senha, 'Infraestrutura');
switch($logar->auth()){
    case 'autenticado':
        echo $logar->auth();
        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;
        $_SESSION['admin'] = $logar->admin();
        break;
    case 'nao autenticado':
        echo $logar->auth();
        break;
    }
}