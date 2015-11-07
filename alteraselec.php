<?php
/*
 * Description of alteraselec
 *
 * @author Gabriel Lopes
 */
require_once 'config.inc.php';
$id = filter_input(INPUT_POST,'id');
$selec = new leitura;
$selec->FullLeitura("select id,sistema from ip_porta");
$ident = new leitura;
$ident->FullLeitura("select * from ip_porta where id='$id'");
if(empty($id)){
echo "<option>Selecione</option>";
    foreach($selec->ObterResultado() as $v){
        echo "<option value=$v[id]>$v[sistema]</option>";
    }
}else{
    foreach($ident->ObterResultado() as $v){
        echo json_encode($v);
    }
}