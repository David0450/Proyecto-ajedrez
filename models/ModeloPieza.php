<?php
abstract class Pieza {
    private int|null $fila;

    private int|null $columna;
    private string $color;

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

    abstract public function movimiento();
}