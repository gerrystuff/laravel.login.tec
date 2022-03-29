<?php
namespace App\Models;

class Usuario {

    private $correo,$nip,$nip_especial;
    public $tipo;
    public $nombre;

    public function __construct($correo,$nip,$tipo = 0,$nip_especial = "",$nombre = ""){
        $this->nombre  = $nombre;
        $this->correo = $correo;
        $this->nip = $nip;
        $this->tipo = $tipo;
        $this->nip_especial = $nip_especial;
    }



    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */ 
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get the value of nip
     */ 
    public function getNip()
    {
        return $this->nip;
    }

    /**
     * Set the value of nip
     *
     * @return  self
     */ 
    public function setNip($nip)
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of nip_especial
     */ 
    public function getNip_especial()
    {
        return $this->nip_especial;
    }

    /**
     * Set the value of nip_especial
     *
     * @return  self
     */ 
    public function setNip_especial($nip_especial)
    {
        $this->nip_especial = $nip_especial;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}


