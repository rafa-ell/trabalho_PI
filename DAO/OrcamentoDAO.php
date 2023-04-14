<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)). '/config/functions.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/classes/orcamento.class.php');

class OrcamentoDAO{
    public function inserirOrcamento(Orcamento $orcamento)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO orcamento (endereco, descricao) VALUES (:endereco, :descricao)");
            $stmt->bindValue(":endereco", $orcamento->getEndereco());
            $stmt->bindValue(":descricao", $orcamento->getDescricao());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            echo "Erro ao solicitar orçamento: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }
}