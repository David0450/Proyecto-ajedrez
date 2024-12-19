<?php

/**
 * Clase Juego - Representa una partida de ajedrez
 * Gestiona el tablero, los jugadores, las piezas y la lógica del juego
 */
class Juego {
    /** @var int Número de turno actual de la partida */
    private int $turno = 1;

    /** @var object Objeto tablero del juego */
    private object $tablero;

    /** @var array Lista de jugadores de la partida */
    public array $jugadores;

    /** @var array Lista de piezas de cada color */
    private array $piezas;

    /**
     * Constructor de la clase
     * Inicializa el tablero, genera las piezas y configura los jugadores
     */
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

    /**
     * Obtiene el turno actual de la partida
     * @return int Número de turno
     */
    public function getTurno() {
        return $this->turno;
    }

    /**
     * Obtiene el objeto tablero del juego
     * @return object Objeto tablero
     */
    public function getTablero() {
        return $this->tablero;
    }

    /**
     * Obtiene la lista de jugadores del juego
     * @return array lista de jugadores
     */
    public function getJugadores() {
        return $this->jugadores;
    }

    /**
     * Aumenta en 1 el turno de la partida
     * @return void
     */
    public function pasarTurno() {
        $this->turno++;
    }

    /**
     * Genera todas las piezas iniciales del juego
     * Crea las 16 piezas de cada color en sus posiciones iniciales
     * @return array<Alfil|Caballo|Peon|Reina|Rey|Torre>[] Lista de objetos de las piezas de cada color
     */
    private function generarPiezas() {
        $piezas = [
            "blancas" => [
                // Primera fila de piezas blancas
                new Torre("blanca",7,0),
                new Caballo("blanca",7,1),
                new Alfil("blanca",7,2),
                new Reina("blanca",7,3),
                new Rey("blanca",7,4),
                new Alfil("blanca",7,5),
                new Caballo("blanca",7,6),
                new Torre("blanca",7,7),
                // Peones blancos
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
                // Primera fila de piezas negras
                new Torre("negra",0,0),
                new Caballo("negra",0,1),
                new Alfil("negra",0,2),
                new Reina("negra",0,3),
                new Rey("negra",0,4),
                new Alfil("negra",0,5),
                new Caballo("negra",0,6),
                new Torre("negra",0,7),
                // Peones negros
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

    /**
     * Asigna las piezas correspondientes a cada jugador
     * Establece las piezas vivas iniciales para cada jugador
     * @return void
     */
    public function asociarPiezasJugadores() {
        $this->jugadores["blanca"]->setFichasVivas($this->piezas["blancas"]);
        $this->jugadores["negra"]->setFichasVivas($this->piezas["negras"]);
    }
    
    /**
     * Coloca todas las piezas en sus posiciones en el tablero
     * @return void
     */
    public function setPiezasEnTablero() {
        foreach($this->piezas as $piezasColor) {
            foreach($piezasColor as $pieza) {
                if(is_int($pieza->getColumna())) {
                    $this->tablero->setPiezaEnCasilla($pieza, $pieza->getCoordenadas());
                }
            }
        }
    }

    /**
     * Habilita la selección de fichas para el jugador del turno actual
     * Añade botones de selección a las casillas que contienen piezas del color actual
     * @return void
     */
    public function seleccionarFicha() {
        $this->limpiarBotones();
        if ($this->turno % 2 !== 0) {
            $color = "blancas";
        } elseif ($this->turno % 2 === 0) {
            $color = "negras";
        }

        foreach($this->piezas[$color] as $piezas) {
            if(is_int($piezas->getFila())) {
                $this->tablero->casillas[$piezas->getFila()][$piezas->getColumna()]->setBoton("<button type='submit' class='seleccionarFicha' name='seleccionarFicha' value='".$piezas->getCoordenadas()."'>");
            }
        }
    }

    /**
     * Muestra los movimientos posibles para una pieza seleccionada
     * Añade botones en las casillas donde la pieza puede moverse o capturar
     * @param string $coordenadas Coordenadas de la pieza seleccionada
     * @return void
     */
    public function mostrarMovimientos($coordenadas) {
        
        $casilla = $this->tablero->getCasilla($coordenadas);
        $pieza = $casilla->getContenido();
        $casillasMovibles = $pieza->movimiento($this->tablero);
        if (count($casillasMovibles) === 0) {
            return;
        }
        $this->limpiarBotones();
        foreach($casillasMovibles as $coordenadasCasilla) {
            $casilla = $this->tablero->getCasilla($coordenadasCasilla) ?? null;

            if (is_object($casilla)) {
                if(is_object($casilla->getContenido())) {
                    $casilla->setBoton("<button type='submit' class='matar' name='matarFicha' value='".$casilla->getCoordenadas()." ".$pieza->getCoordenadas()."'>");
                } else {
                    $casilla->setBoton("<button type='submit' class='movimiento' name='moverFicha' value='".$casilla->getCoordenadas()." ".$pieza->getCoordenadas()."'>");
                }
            }
        }
    }
 
    /**
     * Mueve una pieza a una nueva posición en el tablero
     * @param string $casilla Coordenadas de la casilla destino
     * @param string $coordenadasFicha Coordenadas de la pieza a mover
     * @return void
     */
    public function moverFicha($casilla, $coordenadasFicha) {
        $this->limpiarBotones();
        
        if ($this->turno % 2 !== 0) {
            $jugadorActual = $this->jugadores['blanca'];
        } elseif ($this->turno % 2 === 0) {
            $jugadorActual = $this->jugadores['negra'];
        }

        $ficha = $jugadorActual->getFicha($coordenadasFicha);
        $this->tablero->casillas[$ficha->getFila()][$ficha->getColumna()]->setContenido("");
        $jugadorActual->moverFicha($casilla, $coordenadasFicha);
        $this->setPiezasEnTablero();
    }

    /**
     * Ejecuta la captura de una pieza y mueve la pieza atacante a su posición
     * @param string $coordenadasFichaMatar Coordenadas de la pieza a capturar
     * @param string $coordenadasFichaActual Coordenadas de la pieza que realiza la captura
     * @return void
     */
    public function matarFicha($coordenadasFichaMatar, $coordenadasFichaActual) {
        if ($this->turno % 2 !== 0) {
            $jugadorRival = $this->jugadores['negra'];
        } elseif ($this->turno % 2 === 0) {
            $jugadorRival = $this->jugadores['blanca'];
        }  
        $fichaMuerta = $jugadorRival->getFicha($coordenadasFichaMatar);
        unset($jugadorRival->piezasVivas[array_search($fichaMuerta,$jugadorRival->getFichasVivas())]);
        $jugadorRival->piezasMuertas[] = $fichaMuerta;
        $fichaMuerta->setFila(null);
        $fichaMuerta->setColumna(null);
        $this->moverFicha($coordenadasFichaMatar, $coordenadasFichaActual);
    }

    /**
     * Elimina todos los botones de acción del tablero
     * @return void
     */
    public function limpiarBotones() {
        foreach($this->tablero->casillas as $fila) {
            foreach ($fila as $casilla) {
                $casilla->setBoton("");
            }
        }
    }
}