<?php
abstract class Pieza {
    protected int|null $fila;

    protected int|null $columna;
    protected string $color;

    private bool $estado;

    public function __construct($color, $fila, $columna) {
        $this->color = $color;
        $this->columna = $columna;
        $this->fila = $fila;
    }

    public function getColor() {
        return $this->color;
    }
    
    public function getFila() {
        return $this->fila;
    }

    public function getColumna() {
        return $this->columna;
    }

    public function getCoordenadas() {
        return $this->fila.$this->columna;
    }

    public function setFila($fila) {
        $this->fila = $fila;
    }

    public function setColumna($columna) {
        $this->columna = $columna;
    }

    public function setCoordenadas($coordenadas) {
        $this->fila = $coordenadas[0];
        $this->columna = $coordenadas[1];
    }

    abstract public function movimiento();
}