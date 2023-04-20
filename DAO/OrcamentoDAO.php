<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)). '/config/functions.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/classes/orcamento.class.php');

class OrcamentoDAO{
    public function inserirOrcamento(Orcamento $orcamento)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO orcamentos (endereco, descricao, id_cliente, id_prof) VALUES (:endereco, :descricao , :id_cliente, :id_prof)");
            $stmt->bindValue(":endereco", $orcamento->getEndereco());
            $stmt->bindValue(":descricao", $orcamento->getDescricao());
            $stmt->bindValue(":id_cliente",$orcamento->getIdCliente()) ;
            $stmt->bindValue(":id_prof", 1) ;
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

    public function buscarTodos($id_cliente)
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT o.*, p.nome AS nomeProf FROM orcamentos AS o inner join profissionais AS p ON o.id_prof = p.id WHERE o.id_cliente = :id_cliente;");
            $stmt->bindValue(":id_cliente", $id_cliente);
            $stmt->execute();
            $orcamento = new Orcamento();
            $retorno = array();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $orcamento->setId($rs->id);
                $orcamento->setEndereco(($rs->endereco));
                $orcamento->setDescricao(($rs->descricao));
                $orcamento->setNomeprof(($rs->nomeProf));

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