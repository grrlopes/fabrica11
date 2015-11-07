<?php
/*
 * Description of tabelarota
 *
 * @author Gabriel Lopes
 */
session_start();
if(!isset($_SESSION['login']) && !isset($_SESSION['senha'])){
    header("Location: index.php");
    exit;
}
    include_once 'config.inc.php';
    $sys = filter_input(INPUT_POST,'sys');
    if(empty($sys)){
        exit;
    }
    $sistema = new leitura;
    $sistema->FullLeitura("select * from fabrica where sistema = '$sys'");
?>
    <table id='t1'>
<?php   echo "<h3>$sys</h3>";?>
            <thead>
                <tr>
                    <th>Hostname</th>
                    <th>IP</th>
                    <th>Porta</th>
                    <th>Status</th>
                </tr>
            </thead>
<?php
    foreach($sistema->ObterResultado() as $v){
    echo"
            <tbody>
                <tr>
                    <td>$v[host]</td>
                    <td>$v[ip]</td>
                    <td>$v[porta]</td>
                    <td>$v[status]</td>
                </tr>
            </tbody>";
}?>
        </table>

