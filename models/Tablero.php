<?php

/**
 * Clase Tablero - Representa un tablero de juego de 8x8 casillas.
 * Gestiona sus casillas y el contenido de estas
 */
class Tablero {
    /**
     * @var array Array bidimensional que contiene las casillas del tablero
     */
    public $casillas = [];

    /**
     * Constructor de la clase
     * Inicializa el tablero creando un array 8x8 de objetos Casilla
     * Cada casilla se crea con sus coordenadas correspondientes
     */
    public function __construct() {
        for($i = 0; $i < 8; $i++) {
            for($j = 0; $j < 8; $j++) {
                $this->casillas[$i][$j] = new Casilla($i, $j);
            }
        }
    }

    /**
     * Obtiene una casilla específica del tablero
     * @param string $coordenadas Array con las coordenadas [fila, columna]
     * @return Casilla|false Retorna el objeto Casilla si existe, false si no se encuentra
     */
    public function getCasilla($coordenadas) {
        foreach ($this->casillas as $fila) {
            foreach ($fila as $casilla) {
                if ($casilla->getCoordenadas() == $coordenadas) {
                    return $casilla;
                }
            }
        }
        return false;
    }

    /**
     * Coloca una pieza en una casilla específica del tablero
     * @param mixed $ficha La pieza a colocar en la casilla
     * @param string $coordenadas Array con las coordenadas [fila, columna] donde colocar la pieza
     */
    public function setPiezaEnCasilla($ficha, $coordenadas) {
        $this->casillas[$coordenadas[0]][$coordenadas[1]]->setContenido($ficha);
    }

    /**
     * Convierte el tablero en una representación HTML
     * @return string Representación HTML del tablero como una tabla
     */
    public function __toString()
    {
        $tabla = "<table id='tabla'>";
        for ($i = 0; $i < 8; $i++) {
            $tabla .= "<tr id='fila".$i."'>";
            for ($j = 0; $j < 8; $j++) {
                $tabla .= $this->casillas[$i][$j];
            }
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";
        return $tabla;
    }

    public function __clone() {
        foreach ($this->casillas as $fila => $arrayColumna) {
            foreach($arrayColumna as $columna => $casilla) {
                $this->casillas[$fila][$columna] = clone $casilla;
            }
        }
    }
}