<?php

namespace App\Sites\Admin\Entities;

use App\Sites\Admin\Entities\Usuario;

class Atualizacao
{
    private ?int $id;
    private string $titulo;
    private ?string $descricao;
    private Usuario $usuario;

    public function setId(?int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setTitulo(string $titulo)
    {
        $this->titulo = mb_substr(strip_tags($titulo), 0, 100);
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setDescricao(?string $descricao)
    {
        $this->descricao = $descricao;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    public function getUsuario() : Usuario
    {
        return $this->usuario;
    }
}
