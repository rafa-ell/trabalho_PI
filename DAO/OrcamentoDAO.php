<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)). '/config/functions.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/classes/orcamento.class.php');

class OrcamentoDAO{
    public function inserirOrcamento(Orcamento $orcamento)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO orcamentos (endereco, descricao, id_cliente) VALUES (:endereco, :descricao , :id_cliente)");
            $stmt->bindValue(":endereco", $orcamento->getEndereco());
            $stmt->bindValue(":descricao", $orcamento->getDescricao());
            $stmt->bindValue(":id_cliente",$_SESSION['usuario_id']) ;
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

    public function buscarTodos()
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM orcamentos WHERE id_cliente = :id_cliente;");
            $stmt->bindValue(":id_cliente", $_SESSION['usuario_id']);
            $stmt->execute();
            $orcamento = new Orcamento();
            $retorno = array();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $orcamento->setId($rs->id);
                $orcamento->setEndereco(($rs->endereco));

                $retorno[] = clone $orcamento;
            }
            return $retorno;
        } catch (PDOException $ex) {
            echo "Erro ao buscar orçamento: " . $ex->getMessage();
            die();
        }
    }

    public function removeOrcamento($id)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('DELETE FROM orcamentos WHERE id = :id');
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
            }
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo "Erro ao excluir orçamento: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }
}