<?php

class Profissional {
    private $id;
    private $nome;
    private $cnpj;
    private $telefone;
    private $servico;
    private $preco_hora;
    private $email;
    private $senha;

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setServico($servico) {
        $this->servico = $servico;
    }

    public function getServico() {
        return $this->servico;
    }

    public function setPrecoHora($preco_hora) {
        $this->preco_hora = $preco_hora;
    }

    public function getPrecoHora() {
        return $this->preco_hora;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getSenha() {
        return $this->senha;
    }
}