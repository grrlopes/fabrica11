<?php
/*
 * Description of criacao
 *
 * @author Gabriel Lopes
 */
class criacao extends conexao{
    
    private $Tabela;
    private $Dados;
    private $Resultado;
    private $Criacao;
    private $Con;
    
    public function ExecutaCriacao($Tabela, array $Dados){
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        
        $this->TerSyntax();
        $this->Executar();
    }
    
    public function ObterResultado(){
        return $this->Resultado;
    }
    
    private function TerConexao(){
        $this->Con = parent::fazercon();
        $this->Criacao = $this->Con->prepare($this->Criacao);
    }
    
    private function TerSyntax(){
        $campos = implode(', ',  array_keys($this->Dados));
        $lugar =  ':' . implode(', :', array_keys($this->Dados));
        $this->Criacao = "INSERT INTO {$this->Tabela} ({$campos}) VALUES ({$lugar})";
    }
   
    private function Executar(){
        $this->TerConexao();
        try {
            $this->Criacao->execute($this->Dados);
            $this->Resultado = $this->Con->lastInsertId();
        }catch(PDOException $e){
            echo "Error: ".$e->getCode(), $e->getMessage() ,$e->getLine();
            die();
        }
    }
}
