<?php
/**
 * Clase abstracta Pieza - Representa una pieza genérica en un juego de tablero (en este caso ajedrez)
 * Esta clase sirve como base para implementar diferentes tipos de piezas (en este caso peón, torre, alfil, etc.)
 */
abstract class Pieza {
    /** @var int|null Posición vertical en el tablero (0-7 para ajedrez) */
    protected int|null $fila;
    
    /** @var int|null Posición horizontal en el tablero (0-7 para ajedrez) */
    protected int|null $columna;
    
    /** @var string Color de la pieza ('blanco' o 'negro' para ajedrez) */
    protected string $color;
    
    /** @var string Tipo de pieza ('peon', 'torre', etc.) */
    protected string $tipo;

    /**
     * Constructor de la pieza
     * @param string $color Color de la pieza
     * @param int|null $fila Posición vertical inicial
     * @param int|null $columna Posición horizontal inicial
     */
    public function __construct(string $color, ?int $fila, ?int $columna) {
        $this->color = $color;
        $this->columna = $columna;
        $this->fila = $fila;
    }

    /**
     * Obtiene el color de la pieza
     * @return string Color de la pieza
     */
    public function getColor(): string {
        return $this->color;
    }
    
    /**
     * Obtiene la fila actual de la pieza
     * @return int|null Número de fila o null si no está en el tablero
     */
    public function getFila(): ?int {
        return $this->fila;
    }

    /**
     * Obtiene la columna actual de la pieza
     * @return int|null Número de columna o null si no está en el tablero
     */
    public function getColumna(): ?int {
        return $this->columna;
    }

    /**
     * Obtiene las coordenadas como string (ejemplo: "34" para fila 3, columna 4)
     * @return string Coordenadas concatenadas
     */
    public function getCoordenadas(): string {
        return $this->fila . $this->columna;
    }

    /**
     * Obtiene el tipo de pieza
     * @return string Tipo de pieza
     */
    public function getTipo(): string {
        return $this->tipo;
    }

    /**
     * Establece la fila de la pieza
     * @param int|null $fila Nueva fila
     */
    public function setFila(?int $fila): void {
        $this->fila = $fila;
    }

    /**
     * Establece la columna de la pieza
     * @param int|null $columna Nueva columna
     */
    public function setColumna(?int $columna): void {
        $this->columna = $columna;
    }

    /**
     * Establece las coordenadas de la pieza
     * @param string $coordenadas Array con [fila, columna]
     */
    public function setCoordenadas(string $coordenadas): void {
        $this->fila = $coordenadas[0];
        $this->columna = $coordenadas[1];
    }

    /**
     * Método abstracto que debe implementar cada tipo de pieza
     * para definir sus movimientos válidos
     * 
     * @param mixed $tablero Estado actual del tablero
     * @return array Array de movimientos válidos
     */
    abstract public function movimiento($tablero, $movimientosRival);
}