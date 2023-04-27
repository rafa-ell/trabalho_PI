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
            $stmt->bindValue(":id_prof", $orcamento->getIdprof(), pdo::PARAM_INT) ;
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

    private function logData($data) {
        $arquivo = "log.json";
        $json = json_encode($data);
        $file = fopen(__DIR__ . '/' . $arquivo, 'w');
        fwrite($file, $json);
        fclose($file);
    }

    public function buscarTodosPeloCliente($id_cliente)
    {
        $data = array("idCLiente" => $id_cliente);
        $this->logData($data);
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
                $orcamento->setIdprof(($rs->id_prof));

                $retorno[] = clone $orcamento;
                $this->logData(array(
                    "ID" => $orcamento->getId(),
                    "Descricao" => $orcamento->getDescricao(),
                ));
            }
            return $retorno;
        } catch (PDOException $ex) {
            echo "Erro ao buscar orçamento: " . $ex->getMessage();
            die();
        }
    }

    public function buscarTodosPeloProfissional($id_prof)
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT o.*, c.nome AS nomeCliente FROM orcamentos AS o inner join clientes AS c ON o.id_cliente = c.id WHERE o.id_prof = :id_prof;");
            $stmt->bindValue(":id_prof", $id_prof);
            $stmt->execute();
            $orcamento = new Orcamento();
            $retorno = array();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $orcamento->setId($rs->id);
                $orcamento->setEndereco(($rs->endereco));
                $orcamento->setDescricao(($rs->descricao));
                $orcamento->setNomecliente(($rs->nomeCliente));
                $orcamento->setIdprof(($rs->id_prof));

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