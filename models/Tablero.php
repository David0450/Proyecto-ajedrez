<?php

class Tablero {
    public $casillas = [];

    public function __construct() {
        for ($i = 0; $i < 8; $i++) {
            for($j = 0; $j < 8; $j++) {
                $this->casillas[$i][$j] = new Casilla($i, $j);
            }
        }
        $this->casillas[0][0]->setContenido(new Torre("negra", $this->casillas[0][0]->getFila(), $this->casillas[0][0]->getColumna()));
        $this->casillas[0][1]->setContenido(new Caballo("negra", $this->casillas[0][1]->getFila(), $this->casillas[0][1]->getColumna()));
        $this->casillas[0][2]->setContenido(new Alfil("negra", $this->casillas[0][2]->getFila(), $this->casillas[0][2]->getColumna()));
        $this->casillas[0][3]->setContenido(new Reina("negra", $this->casillas[0][3]->getFila(), $this->casillas[0][3]->getColumna()));
        $this->casillas[0][4]->setContenido(new Rey("negra", $this->casillas[0][4]->getFila(), $this->casillas[0][4]->getColumna()));
        $this->casillas[0][5]->setContenido(new Alfil("negra", $this->casillas[0][5]->getFila(), $this->casillas[0][5]->getColumna()));
        $this->casillas[0][6]->setContenido(new Caballo("negra", $this->casillas[0][6]->getFila(), $this->casillas[0][6]->getColumna()));
        $this->casillas[0][7]->setContenido(new Torre("negra",$this->casillas[0][7]->getFila(), $this->casillas[0][7]->getColumna()));
        $this->casillas[1][0]->setContenido(new Peon("negra",$this->casillas[1][0]->getFila(), $this->casillas[1][0]->getColumna()));
        $this->casillas[1][1]->setContenido(new Peon("negra",$this->casillas[1][1]->getFila(), $this->casillas[1][1]->getColumna()));
        $this->casillas[1][2]->setContenido(new Peon("negra",$this->casillas[1][2]->getFila(), $this->casillas[1][2]->getColumna()));
        $this->casillas[1][3]->setContenido(new Peon("negra",$this->casillas[1][3]->getFila(), $this->casillas[1][3]->getColumna()));
        $this->casillas[1][4]->setContenido(new Peon("negra",$this->casillas[1][4]->getFila(), $this->casillas[1][4]->getColumna()));
        $this->casillas[1][5]->setContenido(new Peon("negra",$this->casillas[1][5]->getFila(),$this->casillas[1][5]->getColumna()));        
        $this->casillas[1][6]->setContenido(new Peon("negra",$this->casillas[1][6]->getFila(), $this->casillas[1][6]->getColumna()));
        $this->casillas[1][7]->setContenido(new Peon("negra",$this->casillas[1][7]->getFila(), $this->casillas[1][7]->getColumna()));
        $this->casillas[7][0]->setContenido(new Torre("blanca",$this->casillas[7][0]->getFila(), $this->casillas[7][0]->getColumna()));
        $this->casillas[7][1]->setContenido(new Caballo("blanca", $this->casillas[7][1]->getFila(), $this->casillas[7][1]->getColumna()));
        $this->casillas[7][2]->setContenido(new Alfil("blanca", $this->casillas[7][2]->getFila(), $this->casillas[7][2]->getColumna()));
        $this->casillas[7][3]->setContenido(new Reina("blanca", $this->casillas[7][3]->getFila(), $this->casillas[7][3]->getColumna()));
        $this->casillas[7][4]->setContenido(new Rey("blanca", $this->casillas[7][4]->getFila(), $this->casillas[7][4]->getColumna()));
        $this->casillas[7][5]->setContenido(new Alfil("blanca", $this->casillas[7][5]->getFila(), $this->casillas[7][5]->getColumna()));
        $this->casillas[7][6]->setContenido(new Caballo("blanca", $this->casillas[7][6]->getFila(), $this->casillas[7][6]->getColumna()));
        $this->casillas[7][7]->setContenido(new Torre("blanca",$this->casillas[7][7]->getFila(), $this->casillas[7][7]->getColumna()));
        $this->casillas[6][0]->setContenido(new Peon("blanca",$this->casillas[6][0]->getFila(), $this->casillas[6][0]->getColumna()));
        $this->casillas[6][1]->setContenido(new Peon("blanca",$this->casillas[6][1]->getFila(), $this->casillas[6][1]->getColumna()));
        $this->casillas[6][2]->setContenido(new Peon("blanca",$this->casillas[6][2]->getFila(), $this->casillas[6][2]->getColumna()));
        $this->casillas[6][3]->setContenido(new Peon("blanca",$this->casillas[6][3]->getFila(), $this->casillas[6][3]->getColumna()));
        $this->casillas[6][4]->setContenido(new Peon("blanca",$this->casillas[6][4]->getFila(), $this->casillas[6][4]->getColumna()));
        $this->casillas[6][5]->setContenido(new Peon("blanca",$this->casillas[6][5]->getFila(), $this->casillas[6][5]->getColumna()));
        $this->casillas[6][6]->setContenido(new Peon("blanca",$this->casillas[6][6]->getFila(), $this->casillas[6][6]->getColumna()));
        $this->casillas[6][7]->setContenido(new Peon("blanca",$this->casillas[6][7]->getFila(), $this->casillas[6][7]->getColumna()));
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