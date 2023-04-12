<?php

require_once '../config/functions.php';
require_once '../classes/login.class.php';

class LoginDAO
{

    public function buscaUsuarioPorEmail(string $email)
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM login WHERE email = ?");
            $stmt->bindValue(1, $email);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $obj = new Login();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setId($rs->id);
                    $obj->setEmail($rs->email);
                    $obj->setSenha($rs->senha);
                    $obj->setAtivo($rs->ativo);
                    $obj->setTipo($rs->tipo);
                    $result = clone $obj;
                }
                return $result;
            } else {
                return NULL;
            }
        } catch (PDOException $ex) {
            echo "Erro: " + $ex->getMessage();
            die();
        }
    }

    public function inserirLogin(Login $login)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO `login` (email, senha, tipo, ativo) VALUES (:email, :senha, :tipo, :ativo)");
            $stmt->bindValue(":email", $login->getEmail());
            $stmt->bindValue(":senha", $login->getSenha());
            $stmt->bindValue(":tipo", $login->getTipo());
            $stmt->bindValue(":ativo", $login->getAtivo());
            
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
}
