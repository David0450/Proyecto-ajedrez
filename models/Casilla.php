<?php

/**
 * Clase Casilla - Representa una casilla en un tablero
 * Cada casilla tiene una posición (fila, columna), contenido y estado de movimiento
 */
class Casilla {
    /** @var bool Indica si la casilla se puede mover */
    private bool $movible = false;
    
    /** @var int Número de fila en la que se encuentra la casilla */
    private int $fila;
    
    /** @var int Número de columna en la que se encuentra la casilla */
    private int $columna;
    
    /** @var object|string Contenido que almacena la casilla */
    private object|string $contenido = "";
    
    /** @var mixed Elemento botón asociado a la casilla */
    private $boton;

    /**
     * Constructor de la clase
     * @param int $fila Fila donde se ubicará la casilla
     * @param int $columna Columna donde se ubicará la casilla
     */
    public function __construct($fila, $columna) {
        $this->fila = $fila;
        $this->columna = $columna;
    }

    /**
     * Obtiene las coordenadas de la casilla concatenando fila y columna
     * @return string Coordenadas en formato "filacolumna"
     */
    public function getCoordenadas() {
        $coordenadas = $this->fila.$this->columna;
        return $coordenadas;
    }

    /**
     * Obtiene el número de fila de la casilla
     * @return int Número de fila
     */
    public function getFila() {
        return $this->fila;
    }

    /**
     * Obtiene el número de columna de la casilla
     * @return int Número de columna
     */
    public function getColumna() {
        return $this->columna;
    }
    
    /**
     * Establece el contenido de la casilla
     * @param mixed $contenido Nuevo contenido para la casilla
     */
    public function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    /**
     * Obtiene el contenido actual de la casilla
     * @return object|string Contenido de la casilla
     */
    public function getContenido() {
        return $this->contenido;
    }

    /**
     * Obtiene el estado de movimiento de la casilla
     * @return bool True si la casilla es movible, false en caso contrario
     */
    public function getMovible() {
        return $this->movible;
    }

    /**
     * Establece si la casilla se puede mover o no
     * @param bool $esMovible Estado de movimiento a establecer
     */
    public function setMovible(bool $esMovible) {
        $this->movible = $esMovible;
    }

    /**
     * Establece el número de fila de la casilla
     * @param int $fila Nueva fila para la casilla
     */
    public function setFila($fila) {
        $this->fila = $fila;
    }

    /**
     * Establece el número de columna de la casilla
     * @param int $columna Nueva columna para la casilla
     */
    public function setColumna($columna) {
        $this->columna = $columna;
    }

    /**
     * Establece el botón asociado a la casilla
     * @param mixed $boton Botón a asociar con la casilla
     */
    public function setBoton($boton) {
        $this->boton = $boton;
    }

    /**
     * Convierte la casilla en una representación HTML
     * @return string Representación HTML de la casilla como celda de una tabla
     */
    public function __toString()
    {
        return "<td class='".$this->getMovible()."' id='casilla".$this->getCoordenadas()."'>".$this->contenido.$this->boton."</td>";
    }
}