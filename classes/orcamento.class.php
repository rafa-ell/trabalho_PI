<?php

class Orcamento {
    private $id;
    private $endereco;
    private $descricao;
    private $idcliente;
    private $nomecliente;
    private $idprof;
    private $nomeprof;

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getDescricao() {
        return $this->descricao;
    }
    public function setIdCliente($id) {
        $this->idcliente = $id;
    }

    public function getIdCliente() {
        return $this->idcliente;
    }
    public function setIdprof($idprof) {
        $this->idprof = $idprof;
    }

    public function getIdprof() {
        return $this->idprof;
    }
    public function setNomeprof($nomeprof) {
        $this->nomeprof = $nomeprof;
    }

    public function getNomeprof() {
        return $this->nomeprof;
    }
    public function setNomecliente($nome) {
        $this->nomecliente = $nome;
    }

    public function getNomecliente() {
        return $this->nomecliente;
    }
}