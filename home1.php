<?php
include_once 'config.inc.php';
$sys = filter_input(INPUT_POST, 'id');
$dash = new leitura;
$sistema = new leitura;
$dash->FullLeitura("select distinct sistema from ip_porta");
$sistema->FullLeitura("select * from fabrica where sistema ='$sys'");
if(!isset($sys)){
foreach($dash->ObterResultado() as $k => $dash){
    echo    "<span><ol id='$dash[sistema]'>$dash[sistema]</ol></span>";
    }
}else{
echo"   <table id='t1'>
        <h3>$sys<h3>
            <thead>
                <tr>
                    <th>Hostname</th>
                    <th>IP</th>
                    <th>Porta</th>
                    <th>Status</th>
                </tr>
            </thead>";
foreach($sistema->ObterResultado() as $i){
    if($sys == $i['sistema']){
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