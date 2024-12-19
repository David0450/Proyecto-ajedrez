<?php
/**
 * Clase Caballo - Representa la pieza del Caballo en el juego de ajedrez
 * Hereda de la clase base Pieza
 */
class Caballo extends Pieza {
    /** @var string Identificador del tipo de pieza */
    public string $tipo = "Caballo";

    /**
     * Calcula los movimientos posibles del caballo en el tablero
     * El caballo se mueve en forma de "L": 
     * - Dos casillas en una dirección (vertical u horizontal)
     * - Una casilla perpendicular a la dirección inicial
     * @param Tablero $tablero Instancia del tablero de juego
     * @return array Array con las coordenadas de las casillas donde puede moverse
     */
    public function movimiento($tablero) {
        return [
            // Movimientos hacia la izquierda (2 casillas) + arriba/abajo (1 casilla)
            ($this->getFila()-1).$this->getColumna()-2,  // Arriba-izquierda
            ($this->getFila()+1).$this->getColumna()-2,  // Abajo-izquierda
            
            // Movimientos hacia la derecha (2 casillas) + arriba/abajo (1 casilla)
            ($this->getFila()-1).$this->getColumna()+2,  // Arriba-derecha
            ($this->getFila()+1).$this->getColumna()+2,  // Abajo-derecha
            
            // Movimientos hacia arriba (2 casillas) + izquierda/derecha (1 casilla)
            ($this->getFila()-2).$this->getColumna()-1,  // Arriba-izquierda
            ($this->getFila()-2).$this->getColumna()+1,  // Arriba-derecha
            
            // Movimientos hacia abajo (2 casillas) + izquierda/derecha (1 casilla)
            ($this->getFila()+2).$this->getColumna()-1,  // Abajo-izquierda
            ($this->getFila()+2).$this->getColumna()+1   // Abajo-derecha
        ];
    }

    /**
     * Devuelve la representación visual HTML del caballo
     * Utiliza los iconos de Font Awesome para mostrar la pieza
     * Aplica estilos diferentes según el color de la pieza
     * @return string Código HTML con el icono del caballo
     */
    public function __toString()
    {
        // Si es negra, retorna el icono sin estilos adicionales
        // Si es blanca, agrega estilos para el color y el borde sombreado
        return $this->getColor() == "negra" ? 
            '<i class="fa-solid fa-chess-knight"></i>' : 
            '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-knight"></i>';
    }
}