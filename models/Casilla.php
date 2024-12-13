<?php

class Casilla {
    private bool $movible = false;
    private int $fila;
    private int $columna;
    private object|string $contenido = "";
    private $boton;

    public function __construct($fila, $columna) {
        $this->fila = $fila;
        $this->columna = $columna;
    }

    
    public function getCoordenadas() {
        return $this->fila.$this->columna;
    }

    public function getFila() {
        return $this->fila;
    }

    public function getColumna() {
        return $this->columna;
    }
    
    public function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    public function getContenido() {
        return $this->contenido;
    }

    public function getMovible() {
        return $this->movible;
    }

    public function setMovible(bool $esMovible) {
        $this->movible = $esMovible;
    }

    public function setFila($fila) {
        $this->fila = $fila;
    }

    public function setColumna($columna) {
        $this->columna = $columna;
    }

    public function setBoton($boton) {
        $this->boton = $boton;
    }

    public function __toString()
    {
        return "<td class='".$this->getMovible()."' id='casilla".$this->getCoordenadas()."'>".$this->contenido.$this->boton."</td>";
    }
}