<?php
/**
 * Clase Torre - Representa la pieza de la Torre en el juego de ajedrez
 * Hereda de la clase Pieza
 */
class Torre extends Pieza {
    /** @var string Identificador del tipo de pieza */
    public string $tipo = "Torre";

    /**
     * Calcula los movimientos posibles de la torre en el tablero
     * La torre se mueve en perpendicular en cualquier dirección
     * @param Tablero $tablero Instancia del tablero de juego
     * @return array Array con las coordenadas de las casillas donde puede moverse
     */
    public function movimiento($tablero) {
        $casillas = [];
        
        // Movimiento perpendicular inferior
        $fila = $this->fila + 1;
        $columna = $this->columna;
        while($tablero->getCasilla($fila.$columna) != false) {
            if ($tablero->getCasilla($fila.$columna)->getContenido() !== "") {
                if ($tablero->getCasilla($fila.$columna)->getContenido()->getColor() === $this->color) {
                    break;
                } else {
                    $casillas[] = ($fila.$columna);
                    $fila++;
                    break;
                }
            }
            $casillas[] = ($fila.$columna);
            $fila++;
        }

        // Movimiento perpendicular superior
        $columna = $this->columna;
        $fila = $this->fila - 1;
        while($tablero->getCasilla($fila.$columna) != false) {
            if ($tablero->getCasilla($fila.$columna)->getContenido() !== "") {
                if ($tablero->getCasilla($fila.$columna)->getContenido()->getColor() === $this->color) {
                    break;
                } else {
                    $casillas[] = ($fila.$columna);
                    $fila--;
                    break;
                }
            }
            $casillas[] = $fila.$columna;
            $fila--;
        }

        // Movimiento perpendicular derecha
        $columna = $this->columna + 1;
        $fila = $this->fila;
        while($tablero->getCasilla($fila.$columna) != false) {
            if ($tablero->getCasilla($fila.$columna)->getContenido() !== "") {
                if ($tablero->getCasilla($fila.$columna)->getContenido()->getColor() === $this->color) {
                    break;
                } else {
                    $casillas[] = ($fila.$columna);
                    $columna++;
                    break;
                }
            }
            $casillas[] = ($fila.$columna);
            $columna++;
        }

        // Movimiento perpendicular izquierda
        $columna = $this->columna - 1;
        $fila = $this->fila;
        while($tablero->getCasilla($fila.$columna) != false) {
            if ($tablero->getCasilla($fila.$columna)->getContenido() !== "") {
                if ($tablero->getCasilla($fila.$columna)->getContenido()->getColor() === $this->color) {
                    break;
                } else {
                    $casillas[] = ($fila.$columna);
                    $columna--;
                    break;
                }
            }
            $casillas[] = ($fila.$columna);
            $columna--;
        }
        return $casillas;
    }

    /**
     * Devuelve la representación visual HTML de la torre
     * Utiliza los iconos de Font Awesome para mostrar la pieza
     * Aplica estilos diferentes según el color de la pieza
     * @return string Código HTML con el icono de la torre
     */
    public function __toString()
    {
        // Si es negra, retorna el icono sin estilos adicionales
        // Si es blanca, agrega estilos para el color y el borde sombreado
        return $this->getColor() == "negra" ?
            '<i class="fa-solid fa-chess-rook"></i>' : 
            '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-rook"></i>';
    }
}