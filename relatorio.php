<?php
/*
 * Description of relatorio
 *
 * @author Gabriel Lopes
 */
session_start();
if(!isset($_SESSION['login']) && !isset($_SESSION['senha'])){
    header("Location: index.php");
    exit;
}
include_once 'config.inc.php';
    $relatorio = new leitura;
    $relatorio->FullLeitura("select sistema,host,ip,porta,status from fabrica");
$arquivo = 'relatorio-FabricaTeste.xls';
$tabela = '';
$tabela.= '<table>';
$tabela.= '<tr>';
$tabela.= '<td colspan="5">Relatório Fabrica de teste</td>';
$tabela.= '</tr>';
$tabela.= '<tr>';
$tabela.= '<td><b>Sistema</b></td>';
$tabela.= '<td><b>Hostname</b></td>';
$tabela.= '<td><b>IP</b></td>';
$tabela.= '<td><b>Porta</b></td>';
$tabela.= '<td><b>Status</b></td>';
$tabela.= '</tr>';
    foreach($relatorio->ObterResultado()as$v){
$tabela.= '<tr>';
$tabela.= "<td>$v[sistema]</td>";
$tabela.= "<td>$v[host]</td>";
$tabela.= "<td>$v[ip]</td>";
$tabela.= "<td>$v[porta]</td>";
$tabela.= "<td>$v[status]</td>";
$tabela.= '</tr>';}
$tabela.= '</table>';
header ("Expires: Mon, 26 Jul 2020 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: Dev: Gabriel Lopes" );
echo $tabela;
exit;
