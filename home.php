<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset='utf-8'>
<link href='css/fabrica.css' rel='stylesheet'/>
<link href="css/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet"/>
<script src='js/jquery.js'></script>
<script src="js/fabrica.js"></script>
</head>
<body>
<?php
    include_once 'config.inc.php';
    session_start();
    $log = $_SESSION['login'];
    if(!isset($_SESSION['login']) && !isset($_SESSION['senha'])){
        header("Location: index.php");
    exit;
}
    $data = new leitura;
    $data->FullLeitura("select data from fabrica where id = '1'");
?>    
<div id="conteudo1">
    <nav>
    <div id="menu1">
        <ul>
        <li><a href="#10"><i class="fa fa-home"></i>&nbsp;Home</a></li>
        <li><a href="#20"><i class="fa fa-adjust"></i>&nbsp;View</a></li>
        <li><a href="#30"><i class="fa fa-search"></i>&nbsp;Pesquisa</a></li>
        <li><a href="relatorio.php"><i class="fa fa-file-excel-o"></i>&nbsp;Relatório</a></li>
        <li><a href="#40"><i class="fa fa-pencil-square-o"></i>&nbsp;Alteração</a>
            <ul>
                <li class="cad"><a href="#31">Cadastro</a></li>
                <li class="alt"><a href="#32">Alteração</a></li>
                <li class="exc"><a href="#33">Exclusão</a></li>
            </ul>
        </li>
        <input class="check" type="checkbox" value="ok"><span>Refresh</span>
        <li><a href="sair.php"><i class="fa fa-times"></i>&nbsp;Sair</a></li>
        </ul>
    </div>
        <p>Ultima atualização: <?php foreach($data->ObterResultado() as $v){
            $tempo =  explode(' ', $v['data']);
            $data = explode('-',$tempo[0]);
            echo $data[2],'/',$data[1],'/', $data[0],' ',$tempo[1]."<br>";
            }echo 'Login: '.$_SESSION['login'];?>
        </p>
    </nav>
    <div id="alter">
        <form>
            <input type="text" name="id" class="id" placeholder="id" disabled>
            <select class="sistema">
            <option class="selec">Selecione</option>
            </select>
            <input type="text" name="ip" class="ip" placeholder="Endereço de rede" required>
            <input type="text" name="porta" class="porta" placeholder="Porta" required>
            <input type="submit" name="sub" class="submeter">
            <input type="button" class="botao" value="Fechar">
        </form>
        <div id="altermsg"></div>
    </div>
    <div id="cadastro">
        <form>
            <input type="text" name="cadsistema" class="cadsistema" placeholder="Sistema" required autofocus>
            <input type="text" name="cadip" class="cadip" placeholder="Endereço de rede" required>
            <input type="text" name="cadporta" class="cadporta" placeholder="Porta" required>
            <input type="submit" name="cadsub" class="cadsubmeter">
            <input type="button" class="cadbotao" value="Fechar">
        </form>
        <div id="cadmsg"></div>
    </div>
    <div id="exclui">
        <form>
            <input type="text" name="id" class="excid" placeholder="id" disabled>
            <select class="sistema">
            <option class="selec">Selecione</option>
            </select>
            <input type="submit" name="excsub" class="excsubmeter" value="Excluir">
            <input type="button" class="excbotao" value="Fechar">
        </form>
        <div id="excmsg"></div>
    </div>
    <div id="conteudo0"></div>
    <div id="conteudo2">
<?php
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
?>   
    </div>
    <footer></footer>
</div>
</body>