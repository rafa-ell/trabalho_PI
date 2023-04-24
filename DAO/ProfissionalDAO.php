<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/config/functions.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/classes/profissional.class.php');

class ProfissionalDAO
{

    public function buscarTodos()
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM profissionais;");
            $stmt->execute();
            $profissional = new Profissional();
            $retorno = array();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                // $profissional->setId($rs->id);
                $profissional->setNome($rs->nome);
                $profissional->setCnpj($rs->cnpj);
                $profissional->setTelefone($rs->telefone);
                $profissional->setServico($rs->servico);
                $profissional->setPrecoHora($rs->preco_hora);
                // $profissional->setEmail($rs->email);
                $retorno[] = clone $profissional;
            }
            return $retorno;
        } catch (PDOException $ex) {
            echo "Erro ao buscar profissional: " . $ex->getMessage();
            die();
        }
    }
    public function buscarPeloEmail($email)
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM profissionais WHERE email = :email;");
            $stmt->bindValue(":email", $email);
            $stmt->execute();
            $profissional = new Profissional();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $profissional->setId($rs->id);
                $profissional->setNome($rs->nome);
                $profissional->setCnpj($rs->cnpj);
                $profissional->setTelefone($rs->telefone);
                $profissional->setServico($rs->servico);
                $profissional->setPrecoHora($rs->preco_hora);
                $profissional->setEmail($rs->email);                
            }
            return $profissional;
        } catch (PDOException $ex) {
            echo "Erro ao buscar profissional: " . $ex->getMessage();
            die();
        }
    }

    public function buscarServico($servico)
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM profissionais WHERE servico = :servico;");
            $stmt->bindValue(":servico", $servico);
            $stmt->execute();
            $profissional = new Profissional();
            $retorno = array();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                // $profissional->setId($rs->id);
                $profissional->setNome($rs->nome);
                // $profissional->setCnpj($rs->cnpj);
                $profissional->setTelefone($rs->telefone);
                $profissional->setServico($rs->servico);
                $profissional->setPrecoHora($rs->preco_hora);
                // $profissional->setEmail($rs->email);
                // $profissional->setSenha($rs->senha);
                $retorno[] = clone $profissional;
            }
            return $retorno;
        } catch (PDOException $ex) {
            echo "Erro ao buscar profissional: " . $ex->getMessage();
            die();
        }
    }

    // public function removeCliente($id)
    // {
    //     $pdo = connectDb();
    //     $pdo->beginTransaction();
    //     try {
    //         $stmt = $pdo->prepare('DELETE FROM clientes WHERE id = :id');
    //         $stmt->bindValue(":id", $id);
    //         $stmt->execute();
    //         if ($stmt->rowCount()) {
    //             $pdo->commit();
    //         }
    //         return $stmt->rowCount();
    //     } catch (PDOException $ex) {
    //         echo "Erro ao excluir cliente: " . $ex->getMessage();
    //         $pdo->rollBack();
    //         die();
    //     }
    // }

    public function inserirProfissional(Profissional $profissional)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO profissionais (nome, cnpj, telefone, servico, preco_hora, email, senha) VALUES (:nome, :cnpj, :tel, :servico, :preco_hora, :email, :senha)");
            $stmt->bindValue(":nome", $profissional->getNome());
            $stmt->bindValue(":cnpj", $profissional->getCnpj());
            $stmt->bindValue(":tel", $profissional->getTelefone());
            $stmt->bindValue(":servico", $profissional->getServico());
            $stmt->bindValue(":preco_hora", $profissional->getPrecoHora());
            $stmt->bindValue(":email", $profissional->getEmail());
            $stmt->bindValue(":senha", $profissional->getSenha());
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

    // public function atualizaCliente(Cliente $cliente)
    // {
    //     $pdo = connectDb();
    //     $pdo->beginTransaction();
    //     try {
    //         $stmt = $pdo->prepare("UPDATE clientes SET nome = :nome, cpf_cnpj = :cpf, telefone = :tel WHERE id = :id");
    //         $stmt->bindValue(":nome", $cliente->getNome());
    //         $stmt->bindValue(":cpf", $cliente->getCpfCnpj());
    //         $stmt->bindValue(":tel", $cliente->getTelefone());
    //         $stmt->bindValue(":id", $cliente->getId());
    //         $stmt->execute();
    //         if ($stmt->rowCount()) {
    //             $pdo->commit();
    //             return TRUE;
    //         }
    //         return FALSE;
    //     } catch (PDOException $ex) {
    //         $pdo->rollBack();
    //         echo "Erro ao atualizar cliente: " . $ex->getMessage();
    //         die();
    //     }
    // }
}
