<?php
/**
 * Description of editacao
 *
 * @author Gabriel Lopes
 */
class edicao extends conexao{
    private $Tabela;
    private $Dados;
    private $Termos;
    private $Armazenamento;
    private $Resultado;
    private $Edicao;
    private $Conexao;
    
    public function ExecutaEdicao($Tabela, array $Dados, $Termos, $ParseString){
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        $this->Termos = $Termos;
        parse_str($ParseString, $this->Armazenamento);
        $this->TerSyntax();
        $this->Executar();
    }

    public function ObterResultado(){
        return $this->Resultado;
    }
    
    public function ObterRowCount(){
        return $this->Edicao->rowCount();
    }
   
   public function SetarArmazenamento($ParseString){
        parse_str($ParseString, $this->Armazenamento);
        $this->TerSyntax();
        $this->Executar();
   }
   
    private function TerConexao(){
        $this->Conexao = parent::fazercon();
        $this->Edicao = $this->Conexao->prepare($this->Edicao);
    }

    private function TerSyntax(){
        foreach($this->Dados as $Key => $Valores){
            $Valor[] = $Key . '= :' . $Key;
        }
        $Valor = implode(', ',$Valor);
        $this->Edicao = "UPDATE {$this->Tabela} SET {$Valor} {$this->Termos}";
    }

    private function Executar(){
        $this->TerConexao();
        try {
            $this->Edicao->execute(array_merge($this->Dados, $this->Armazenamento));
            $this->Resultado = TRUE;
        }catch(PDOException $e){
            $this->Resultado = NULL;
            echo "Erro: ".$e->getCode(), $e->getMessage() ,$e->getLine();
        }
    }  
}
