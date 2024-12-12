<?php
require_once("./models/ModeloTablero.php");

class Juego {
    private $turno = 1;
    private $tablero;
    public function __construct() {
        $this->tablero = new Tablero();
    }

    public function mostrarTablero() {
        return $this->tablero;
    }

    public function getTurno() {
        return $this->turno;
    }

    public function getTablero() {
        return $this->tablero;
    }

    public function pasarTurno() {
        $this->turno = ($this->turno % 2) + 1;
    }

    public function seleccionarFicha() {
        $this->limpiarBotones();
        foreach($this->tablero->casillas as $fila) {
            foreach($fila as $casilla) {
                if ($this->turno == 1) {
                    if(is_object($casilla->getContenido()) && $casilla->getContenido()->getColor() == "blanca") {
                        $casilla->setBoton("<button type='submit' class='seleccionarFicha' name='seleccionarFicha' value='".$casilla->getCoordenadas()."'>");
                    }   
                } elseif ($this->turno == 2) {
                    if(is_object($casilla->getContenido()) && $casilla->getContenido()->getColor() == "negra") {
                        $casilla->setBoton("<button type='submit' class='seleccionarFicha' name='seleccionarFicha' value='".$casilla->getCoordenadas()."'>");
                    }
                }
            }
        }
    }

    public function mostrarMovimientos($coordenadas) {
        $this->limpiarBotones();
        $ficha = $this->tablero->casillas[$coordenadas[0]][$coordenadas[1]]->getContenido();
        $casillasMovibles = $ficha->movimiento();
        foreach($casillasMovibles as $coordenadasCasilla) {
            $casilla = $this->tablero->casillas[$coordenadasCasilla[0]][$coordenadasCasilla[1]] ?? '';
            if (is_object($casilla)) {
                if(is_object($casilla->getContenido())) {
                    if($casilla->getContenido()->getColor() == $ficha->getColor()) {
                        echo "blanca";
                    } else {
                        $casilla->setBoton("<button type='submit' class='matar' name='moverFicha' value='".$casilla->getCoordenadas()." ".$ficha->getCoordenadas()."'>");
                    }
                } else {
                    $casilla->setMovible(true);
                    $casilla->setBoton("<button type='submit' class='movimiento' name='moverFicha' value='".$casilla->getCoordenadas()." ".$ficha->getCoordenadas()."'>");
                }
            }
        }
    }
 
    public function moverFicha($casilla, $ficha) {
        $this->limpiarBotones();
        $pieza = $this->tablero->casillas[$ficha[0]][$ficha[1]]->getContenido();
        $pieza->setFila($casilla[0]);
        $pieza->setColumna($casilla[1]);
        $this->tablero->casillas[$casilla[0]][$casilla[1]]->setContenido($pieza);
        $this->tablero->casillas[$ficha[0]][$ficha[1]]->setContenido("");
        $this->pasarTurno();
    }

    public function limpiarBotones() {
        foreach($this->tablero->casillas as $fila) {
            foreach ($fila as $casilla) {
                $casilla->setBoton("");
            }
        }
    }
}