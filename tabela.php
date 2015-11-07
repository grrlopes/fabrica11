<?php
/**
 * Description of tabela
 *
 * @author Gabriel Lopes
 */
session_start();
if(!isset($_SESSION['login']) && !isset($_SESSION['senha'])){
    header("Location: index.php");
    exit;
}
include_once 'config.inc.php';
$id = filter_input(INPUT_POST,'id');
$tabela = new leitura;
$tabela->FullLeitura("select sistema from ip_porta where id = $id");
if(empty($tabela->ObterResultado())){
    echo '{"sistema":"Vazio"}';
}
else{
    foreach($tabela->ObterResultado() as $v){
        echo json_encode($v);
    }
}