<?php
/**
 * Description of delete
 *
 * @author Gabriel Lopes
 */
class delete extends conexao{
    private $Tabela;
    private $Termos;
    private $Armazenamento;
    private $Resultado;
    private $Delete;
    private $Conexao;
    
    public function ExecutaDelete($Tabela, $Termos, $ParseString){
        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;
        parse_str($ParseString, $this->Armazenamento);
        $this->TerSyntax();
        $this->Executar();
    }

    public function ObterResultado(){
        return $this->Resultado;
    }
    
    public function ObterRowCount(){
        return $this->Delete->rowCount();
    }
   
   public function SetarArmazenamento($ParseString){
        parse_str($ParseString, $this->Armazenamento);
        $this->TerSyntax();
        $this->Executar();
   }
   
    private function TerConexao(){
        $this->Conexao = parent::fazercon();
        $this->Delete = $this->Conexao->prepare($this->Delete);
    }

    private function TerSyntax(){
        $this->Delete = "DELETE FROM {$this->Tabela} {$this->Termos}";
    }

    private function Executar(){
        $this->TerConexao();
        try {
            $this->Delete->execute($this->Armazenamento);
            $this->Resultado = TRUE;
        }catch(PDOException $e){
            $this->Resultado = NULL;
            echo "Erro: ".$e->getCode(), $e->getMessage() ,$e->getLine();
        }
    }
    
}