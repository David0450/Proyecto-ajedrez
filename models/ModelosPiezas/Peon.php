<?php
/**
 * Clase Peón - Representa la pieza del Peón en el juego de ajedrez
 * Hereda de la clase base Pieza
 */
class Peon extends Pieza {
    /** @var string Identificador del tipo de pieza */
    public string $tipo = "Peon";

    /**
     * Calcula los movimientos posibles del peón en el tablero
     * El peón tiene un movimiento especial:
     * - Solo puede moverse hacia adelante
     * - En su primera jugada puede avanzar una o dos casillas
     * - Después de la primera jugada, solo puede avanzar una casilla
     * - La dirección del movimiento depende del color (blancas hacia arriba, negras hacia abajo)
     * @param Tablero $tablero Instancia del tablero de juego
     * @return array Array con las coordenadas de las casillas donde puede moverse
     */
    public function movimiento($tablero) {
        $casillas = [];

        // Movimientos para peones blancos (se mueven hacia arriba en el tablero)
        if ($this->getColor() == "blanca") {
            // Si está en la posición inicial (fila 6), puede moverse dos casillas
            if ($this->getFila() == 6) {
                $casillas[] = ($this->getFila()-2).$this->getColumna();
            }
            // Siempre puede moverse una casilla hacia adelante
            $casillas[] = ($this->getFila()-1).$this->getColumna();
        } 
        // Movimientos para peones negros (se mueven hacia abajo en el tablero)
        elseif ($this->getColor() == "negra") {
            // Si está en la posición inicial (fila 1), puede moverse dos casillas
            if ($this->getFila() == 1) {
                $casillas[] = ($this->getFila()+2).$this->getColumna();
            }
            // Siempre puede moverse una casilla hacia adelante
            $casillas[] = ($this->getFila()+1).$this->getColumna();
        }

        return $casillas;
    }

    /**
     * Devuelve la representación visual HTML del peón
     * Utiliza los iconos de Font Awesome para mostrar la pieza
     * Aplica estilos diferentes según el color de la pieza
     * @return string Código HTML con el icono del peón
     */
    public function __toString()
    {
        // Si es negra, retorna el icono sin estilos adicionales
        // Si es blanca, agrega estilos para el color y el borde sombreado
        return $this->getColor() == "negra" ? 
            '<i class="fa-solid fa-chess-pawn"></i>' : 
            '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-pawn"></i>';
    }
}