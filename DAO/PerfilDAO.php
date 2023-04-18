<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/config/functions.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/classes/profissional.class.php');


class PerfilDAO
{

    public function buscarTodos()
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM clientes;");
            $stmt->execute();
            $perfil = new Perfil();
            $retorno = array();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $perfil->setId($rs->id);
                $perfil->setNome(($rs->nome));
                $perfil->setCpf_cnpj($rs->cpf_cnpj);
                $perfil->setTelefone($rs->telefone);
                $perfil->setEmail($rs->email);
                $perfil->setSenha($rs->senha);

                $retorno[] = clone $perfil;
            }
            return $retorno;
        } catch (PDOException $ex) {
            echo "Erro ao buscar cliente: " . $ex->getMessage();
            die();
        }
    }

    public function buscarUm($id)
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = :id;");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $perfil = new Perfil();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $perfil->setId($rs->id);
                $perfil->setNome(($rs->nome));
                $perfil->setCpf_cnpj($rs->cpf_cnpj);
                $perfil->setTelefone($rs->telefone);
                $perfil->setEmail($rs->email);
                $perfil->setSenha($rs->senha);
            }
            return $perfil;
        } catch (PDOException $ex) {
            echo "Erro ao buscar cliente: " . $ex->getMessage();
            die();
        }
    }

    public function removePerfil($id)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('DELETE FROM clientes WHERE id = :id');
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
            }
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo "Erro ao excluir cliente: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function inserirPerfil(Perfil $perfil)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO clientes (nome, cpf_cnpj, telefone, email, senha) VALUES (:nome, :cpf_cnpj, :telefone, :email, :senha)");
            $stmt->bindValue(":nome", $perfil->getNome());
            $stmt->bindValue(":cpf_cnpj", $perfil->getCpf_cnpj());
            $stmt->bindValue(":telefone", $perfil->getTelefone());
            $stmt->bindValue(":email", $perfil->getEmail());
            $stmt->bindValue(":senha", $perfil->getSenha());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            echo "Erro ao inserir cliente: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function atualizaPerfil(Perfil $perfil)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE clientes SET nome = :nome, cpf_cnpj = :cpf_cnpj, telefone = :telefone, email = :email, senha = :senha WHERE id = :id");
            $stmt->bindValue(":nome", $perfil->getNome());
            $stmt->bindValue(":descricao", $perfil->getCpf_cnpj());
            $stmt->bindValue(":codigo_barras", $perfil->getTelefone());
            $stmt->bindValue(":qtde_estoque", $perfil->getEmail());
            $stmt->bindValue(":ativo", $perfil->getSenha());
            $stmt->bindValue(":id", $perfil->getId());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            $pdo->rollBack();
            echo "Erro ao atualizar cliente: " . $ex->getMessage();
            die();
        }
    }
}
