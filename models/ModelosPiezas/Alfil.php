<?php
/**
 * Clase Alfil - Representa la pieza del Alfil en el juego de ajedrez
 * Hereda de la clase Pieza
 */
class Alfil extends Pieza {
    /** @var string Identificador del tipo de pieza */
    public string $tipo = "Alfil";

    /**
     * Calcula los movimientos posibles del alfil en el tablero
     * El alfil se mueve en diagonal en cualquier dirección
     * @param Tablero $tablero Instancia del tablero de juego
     * @return array Array con las coordenadas de las casillas donde puede moverse
     */
    public function movimiento($tablero) {
        $casillas = [];
        
        // Movimiento diagonal inferior derecha
        $columna = $this->columna + 1;
        $fila = $this->fila + 1;
        while($tablero->getCasilla($fila.$columna) != false) { // Mientras la casilla existe
            if ($tablero->getCasilla($fila.$columna)->getContenido() !== "") {
                if ($tablero->getCasilla($fila.$columna)->getContenido()->getColor() === $this->color) {
                    break;
                } else {
                    $casillas[] = ($fila.$columna);
                    $fila++;
                    $columna++;
                    break;
                }
            }
            $casillas[] = ($fila.$columna);
            $fila++;
            $columna++;
        }

        // Movimiento diagonal inferior izquierda
        $columna = $this->columna - 1;
        $fila = $this->fila + 1;
        while($tablero->getCasilla($fila.$columna) != false) {
            if ($tablero->getCasilla($fila.$columna)->getContenido() !== "") {
                if ($tablero->getCasilla($fila.$columna)->getContenido()->getColor() === $this->color) {
                    break;
                } else {
                    $casillas[] = ($fila.$columna);
                    $fila++;
                    $columna--;
                    break;
                }
            }
            $casillas[] = ($fila.$columna);
            $fila++;
            $columna--;
        }

        // Movimiento diagonal superior izquierda
        $columna = $this->columna - 1;
        $fila = $this->fila - 1;
        while($tablero->getCasilla($fila.$columna) != false) {
            if ($tablero->getCasilla($fila.$columna)->getContenido() !== "") {
                if ($tablero->getCasilla($fila.$columna)->getContenido()->getColor() === $this->color) {
                    break;
                } else {
                    $casillas[] = ($fila.$columna);
                    $fila--;
                    $columna--;
                    break;
                }
            }
            $casillas[] = ($fila.$columna);
            $fila--;
            $columna--;
        }

        // Movimiento diagonal superior derecha
        $columna = $this->columna + 1;
        $fila = $this->fila - 1;
        while($tablero->getCasilla($fila.$columna) != false) {
            if ($tablero->getCasilla($fila.$columna)->getContenido() !== "") {
                if ($tablero->getCasilla($fila.$columna)->getContenido()->getColor() === $this->color) {
                    break;
                } else {
                    $casillas[] = ($fila.$columna);
                    $fila--;
                    $columna++;
                    break;
                }
            }
            $casillas[] = ($fila.$columna);
            $fila--;
            $columna++;
        }

        return $casillas;
    }

    /**
     * Devuelve la representación visual HTML del alfil
     * Utiliza los iconos de Font Awesome para mostrar la pieza
     * Aplica estilos diferentes según el color de la pieza
     * @return string Código HTML con el icono del alfil
     */
    public function __toString()
    {
        // Si es negra, retorna el icono sin estilos adicionales
        // Si es blanca, agrega estilos para el color y el borde sombreado
        return $this->getColor() == "negra" ? 
            '<i class="fa-solid fa-chess-bishop"></i>' : 
            '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-bishop"></i>';
    }
}