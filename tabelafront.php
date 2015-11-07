<?php
/*
 * Description of tabelafront
 *
 * @author Gabriel Lopes
 */
session_start();
if(!isset($_SESSION['login']) && !isset($_SESSION['senha'])){
    header("Location: index.php");
    exit;
}
include_once 'config.inc.php';
$tela = new leitura;
$tela->FullLeitura("select distinct sistema from ip_porta");
$tela1 = new leitura;
$tela1->FullLeitura("select * from fabrica");
foreach($tela->ObterResultado() as $v){
echo"   <table id='t1'>
        <h3>$v[sistema]<h3>
            <thead>
                <tr>
                    <th>Hostname</th>
                    <th>IP</th>
                    <th>Porta</th>
                    <th>Status</th>
                </tr>
            </thead>";
foreach($tela1->ObterResultado() as $i){
    if($v['sistema'] == $i['sistema']){
echo"   <tbody>
            <tr>
                <td>$i[host]</td>
                <td>$i[ip]</td>
                <td>$i[porta]</td>
                <td>$i[status]</td>
            </tr>
        </tbody>";
    }
}
echo  "</table>";
}


