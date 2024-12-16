<?php

class Juego {
    private $turno = 1;
    private $tablero;
    public $jugadores;
    private $piezas;
    public function __construct() {
        $this->piezas = $this->generarPiezas();
        $this->tablero = new Tablero();
        $this->jugadores = [
            "blanca" => new Jugador("blanca"),
            "negra" => new Jugador("negra")
        ];
        $this->setPiezasEnTablero();
        $this->asociarPiezasJugadores();
    }

    public function mostrarTablero() {
        return $this->tablero;
    }

    private function generarPiezas() {
        $piezas = [
            "blancas" => [
                new Torre("blanca",7,0),
                new Caballo("blanca",7,1),
                new Alfil("blanca",7,2),
                new Reina("blanca",7,3),
                new Rey("blanca",7,4),
                new Alfil("blanca",7,5),
                new Caballo("blanca",7,6),
                new Torre("blanca",7,7),
                new Peon("blanca",6,0),
                new Peon("blanca",6,1),
                new Peon("blanca",6,2),
                new Peon("blanca",6,3),
                new Peon("blanca",6,4),
                new Peon("blanca",6,5),
                new Peon("blanca",6,6),
                new Peon("blanca",6,7),
            ],
            "negras" => [
                new Torre("negra",0,0),
                new Caballo("negra",0,1),
                new Alfil("negra",0,2),
                new Reina("negra",0,3),
                new Rey("negra",0,4),
                new Alfil("negra",0,5),
                new Caballo("negra",0,6),
                new Torre("negra",0,7),
                new Peon("negra",1,0),
                new Peon("negra",1,1),
                new Peon("negra",1,2),
                new Peon("negra",1,3),
                new Peon("negra",1,4),
                new Peon("negra",1,5),
                new Peon("negra",1,6),
                new Peon("negra",1,7),  
            ]
        ];
        return $piezas; 
    }

    public function asociarPiezasJugadores() {
        $this->jugadores["blanca"]->setFichasVivas($this->piezas["blancas"]);
        $this->jugadores["negra"]->setFichasVivas($this->piezas["negras"]);
    }

    public function setPiezasEnTablero() {
        foreach($this->piezas as $piezasColor) {
            foreach($piezasColor as $pieza) {
                if(is_int($pieza->getColumna())) {
                    $this->tablero->setPiezaEnCasilla($pieza, $pieza->getCoordenadas());
                }
            }
        }
    }

    public function getTurno() {
        return $this->turno;
    }

    public function getTablero() {
        return $this->tablero;
    }

    public function getJugadores() {
        return $this->jugadores;
    }

    public function pasarTurno() {
        $this->turno = ($this->turno % 2) + 1;
    }

    public function seleccionarFicha() {
        $this->limpiarBotones();
        if ($this->turno == 1) {
            $color = "blancas";
        } elseif ($this->turno == 2) {
            $color = "negras";
        }

        foreach($this->piezas[$color] as $piezas) {
            if(is_int($piezas->getFila())) {
                $this->tablero->casillas[$piezas->getFila()][$piezas->getColumna()]->setBoton("<button type='submit' class='seleccionarFicha' name='seleccionarFicha' value='".$piezas->getCoordenadas()."'>");
            }
        }
    }

    public function mostrarMovimientos($coordenadas) {
        $this->limpiarBotones();

        $casilla = $this->tablero->getCasilla($coordenadas);
        $pieza = $casilla->getContenido();
        $casillasMovibles = $pieza->movimiento($this->tablero);
        foreach($casillasMovibles as $coordenadasCasilla) {
            $casilla = $this->tablero->getCasilla($coordenadasCasilla) ?? null;

            if (is_object($casilla)) {
                if(is_object($casilla->getContenido())) {
                    if($casilla->getContenido()->getColor() != $pieza->getColor()) {
                        $casilla->setBoton("<button type='submit' class='matar' name='matarFicha' value='".$casilla->getCoordenadas()." ".$pieza->getCoordenadas()."'>");
                    }
                } else {
                    $casilla->setBoton("<button type='submit' class='movimiento' name='moverFicha' value='".$casilla->getCoordenadas()." ".$pieza->getCoordenadas()."'>");
                }
            }
        }
    }

    private function validarMovimientos($casillaDestino, $pieza) {
        if (is_object($casillaDestino)) {
            if($casillaDestino->getContenido()->getColor() == $pieza->getColor()) {
                return false;
            } elseif($casillaDestino->getContenido()->getColor() != $pieza->getColor()) {

            } else {

            }
        } else {
            return false;
        }
    }
 
    public function moverFicha($casilla, $coordenadasFicha) {
        $this->limpiarBotones();
        
        if ($this->turno == 1) {
            $jugadorActual = $this->jugadores['blanca'];
        } elseif ($this->turno == 2) {
            $jugadorActual = $this->jugadores['negra'];
        }

        $ficha = $jugadorActual->getFicha($coordenadasFicha);
        $this->tablero->casillas[$ficha->getFila()][$ficha->getColumna()]->setContenido("");
        $jugadorActual->moverFicha($casilla, $coordenadasFicha);
        $this->setPiezasEnTablero();

        $this->pasarTurno();
    }

    public function matarFicha($coordenadasFichaMatar, $coordenadasFichaActual) {
        if ($this->turno == 1) {
            $jugadorRival = $this->jugadores['negra'];
        } elseif ($this->turno == 2) {
            $jugadorRival = $this->jugadores['blanca'];
        }  
        $fichaMuerta = $jugadorRival->getFicha($coordenadasFichaMatar);
        unset($jugadorRival->piezasVivas[array_search($fichaMuerta,$jugadorRival->getFichasVivas())]);
        $jugadorRival->piezasMuertas[] = $fichaMuerta;
        $fichaMuerta->setFila(null);
        $fichaMuerta->setColumna(null);
        $this->moverFicha($coordenadasFichaMatar, $coordenadasFichaActual);
    }

    public function limpiarBotones() {
        foreach($this->tablero->casillas as $fila) {
            foreach ($fila as $casilla) {
                $casilla->setBoton("");
            }
        }
    }
}