<?php

class Tablero {
    public $casillas = [];

    public function __construct() {
        for($i = 0; $i < 8; $i++) {
            for($j = 0; $j < 8; $j++) {
                $this->casillas[$i][$j] = new Casilla($i, $j);
            }
        }
    }

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

    public function setPiezaEnCasilla($ficha, $coordenadas) {
        $this->casillas[$coordenadas[0]][$coordenadas[1]]->setContenido($ficha);
    }

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
}