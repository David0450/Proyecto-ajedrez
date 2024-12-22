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
        $casillas = [];
        $casillasPosibles = [
            "arribaIzquierda" => ($this->getFila()-2).($this->getColumna()-1),
            "arribaDerecha" => ($this->getFila()-2).($this->getColumna()+1),
            "abajoIzquierda" => ($this->getFila()+2).($this->getColumna()-1),
            "abajoDerecha" => ($this->getFila()+2).($this->getColumna()+1),
            "derechaArriba" => ($this->getFila()-1).($this->getColumna()+2),
            "derechaAbajo" => ($this->getFila()+1).($this->getColumna()+2),
            "izquierdaArriba" => ($this->getFila()-1).($this->getColumna()-2),
            "izquierdaAbajo" => ($this->getFila()+1).($this->getColumna()-2)
        ];
        foreach($casillasPosibles as $casilla) {
            if ($tablero->getCasilla($casilla) !== false) {
                if($tablero->getCasilla($casilla)->getContenido() === "") {
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