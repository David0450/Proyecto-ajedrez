<?php
/**
 * Clase Torre - Representa la pieza del Rey en el juego de ajedrez
 * Hereda de la clase Pieza
 */
class Rey extends Pieza {
    /** @var string Identificador del tipo de pieza */
    public string $tipo = "Rey";

    /**
     * Calcula los movimientos posibles del rey en el tablero
     * El rey se mueve una casilla en cualquier dirección
     * @param Tablero $tablero Instancia del tablero de juego
     * @return array Array con las coordenadas de las casillas donde puede moverse
     */
    public function movimiento($tablero, $movimientosRival = null) {
        $casillas = [];
        $casillasPosibles = [
            "arriba" => ($this->getFila()-1).$this->getColumna(), // Arriba
            "abajo" => ($this->getFila()+1).$this->getColumna(), // Abajo
            "derecha" => ($this->getFila()).$this->getColumna()+1, // Derecha
            "izquierda" => ($this->getFila()).$this->getColumna()-1, // Izquierda
            "arribaIzquierda" => ($this->getFila()-1).$this->getColumna()-1, // Arriba izquierda
            "arribaDerecha" => ($this->getFila()-1).$this->getColumna()+1, // Arriba derecha
            "abajoIzquierda" => ($this->getFila()+1).$this->getColumna()-1, // Abajo izquierda
            "abajoDerecha" => ($this->getFila()+1).$this->getColumna()+1 // Abajo derecha
        ];
        foreach($casillasPosibles as $casilla) {
            if ($tablero->getCasilla($casilla) !== false) {
                if($tablero->getCasilla($casilla)->getContenido() === '') {
                    $casillas[] = $casilla;
                } else {
                    if($tablero->getCasilla($casilla)->getContenido()->getColor() !== $this->color) {
                        $casillas[] = $casilla;
                    }
                }
            }
        }
        return $casillas;
    }

    /**
     * Devuelve la representación visual HTML del rey
     * Utiliza los iconos de Font Awesome para mostrar la pieza
     * Aplica estilos diferentes según el color de la pieza
     * @return string Código HTML con el icono del rey
     */
    public function __toString() 
    {
        // Si es negra, retorna el icono sin estilos adicionales
        // Si es blanca, agrega estilos para el color y el borde sombreado
        return $this->getColor() == "negra" ? 
            '<i class="fa-solid fa-chess-king"></i>' : 
            '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-king"></i>';
    }
}