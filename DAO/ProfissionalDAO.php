<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/config/functions.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/classes/profissional.class.php');

class ProfissionalDAO
{

    public function buscarTodos()
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM profissional;");
            $stmt->execute();
            $profissional = new Profissional();
            $retorno = array();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $profissional->setId($rs->id);
                $profissional->setNome(($rs->nome));
                $profissional->setCnpj($rs->cnpj);
                $profissional->setTelefone($rs->telefone);
                $profissional->setServico($rs->servico);
                $profissional->setPreco_hora($rs->preco_hora);

                $retorno[] = clone $profissional;
            }
            return $retorno;
        } catch (PDOException $ex) {
            echo "Erro ao buscar profissional: " . $ex->getMessage();
            die();
        }
    }

    public function buscarUm($id)
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM profissional WHERE id = :id;");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $profissional = new Profissional();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $profissional->setId($rs->id);
                $profissional->setNome(($rs->nome));
                $profissional->setCnpj($rs->cnpj);
                $profissional->setTelefone($rs->telefone);
                $profissional->setServico($rs->servico);
                $profissional->setPreco_hora($rs->preco_hora);

            }
            return $profissional;
        } catch (PDOException $ex) {
            echo "Erro ao buscar profissional: " . $ex->getMessage();
            die();
        }
    }

    public function removeProfissional($id)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('DELETE FROM profissional WHERE id = :id');
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
            }
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo "Erro ao excluir profissional: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function inserirProfissional(Profissional $profissional)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO profissional (nome, cnpj, telefone, servico, preco_hora) VALUES (:nome, :cnpj, :telefone, :servico, :preco_hora)");
            $stmt->bindValue(":nome", $profissional->getNome());
            $stmt->bindValue(":cnpj", $profissional->getCnpj());
            $stmt->bindValue(":telefone", $profissional->getTelefone());
            $stmt->bindValue(":servico", $profissional->getServico());
            $stmt->bindValue(":preco_hora", $profissional->getPreco_hora());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            echo "Erro ao inserir profissional: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function atualizaProfissional(Profissional $profissional)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE profissionais SET nome = :nome, cnpj = :cnpj, telefone = :telefone, servico = :servico, preco_hora = :preco_hora WHERE id = :id");
            $stmt->bindValue(":nome", $profissional->getNome());
            $stmt->bindValue(":cnpj", $profissional->getCnpj());
            $stmt->bindValue(":telefone", $profissional->getTelefone());
            $stmt->bindValue(":servico", $profissional->getServico());
            $stmt->bindValue(":preco_hora", $profissional->getPreco_hora());
            $stmt->bindValue(":id", $profissional->getId());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            $pdo->rollBack();
            echo "Erro ao atualizar profissional: " . $ex->getMessage();
            die();
        }
    }
}