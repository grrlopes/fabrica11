<?php
/*
 * Description of cadastro
 *
 * @author Gabriel Lopes
 */
require 'config.inc.php';
session_start();
$id = filter_input(INPUT_POST, 'id');
if(empty($id)){
    exit;
}
$exclui = new delete;
if($_SESSION['admin'] == 'admin'){
$exclui->ExecutaDelete("ip_porta","WHERE id = :id", "id=$id");
    if($exclui->ObterResultado()){
        echo "{$exclui->ObterRowCount()}.registro deletado, recarregue";
    }
}    
else{
    echo 'Login:'.' '.$_SESSION['login'].' '.'sem permissão';
}