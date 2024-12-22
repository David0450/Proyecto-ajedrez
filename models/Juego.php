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
    private object $jugadorActual;
    private object $jugadorRival;

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
        $this->jugadorActual = $this->jugadores['blanca'];
        $this->jugadorRival = $this->jugadores['negra'];
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
        $jugadorTemporal = $this->jugadorRival;
        $this->jugadorRival = $this->jugadorActual;
        $this->jugadorActual = $jugadorTemporal;
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
        $color = $this->jugadorActual->getColor().'s';

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
        $this->seleccionarFicha();
        $casilla = $this->tablero->getCasilla($coordenadas);
        $pieza = $casilla->getContenido();
        $casillasMovibles = $this->getMovimientosPosibles($coordenadas);
        //$casillasMovibles = $pieza->movimiento($this->tablero);
        if (count($casillasMovibles) === 0) {
            return;
        }
        foreach($casillasMovibles as $coordenadasCasilla) {
            $casilla = $this->tablero->getCasilla($coordenadasCasilla) ?? null;

            if (is_object($casilla)) {
                if(is_object($casilla->getContenido())) {
                    $casilla->setBoton("<button type='submit' class='matar' name='moverFicha' value='".$casilla->getCoordenadas()." ".$pieza->getCoordenadas()."'>");
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

        if ($this->tablero->getCasilla($casilla)->getContenido() !== '') {
            $this->matarFicha($casilla);
        }


        $ficha = $this->jugadorActual->getFicha($coordenadasFicha);
        if (in_array($ficha->getTipo(),['Rey','Torre'])) {
            $ficha->seHaMovido = true;
            if ($ficha->getTipo() === 'Rey') {
                $this->manejarEnroque($ficha,$casilla,$this->jugadorActual);
            }
        }

        // ! PROMOCION PEON NO FUNCIONAL
        /**if ($ficha->getTipo() === 'Peon') {
            if ($ficha->getColor() === 'blanca' && $casilla[0] === '0') {
                $this->modalPromocionPeon($casilla, $ficha);
            } elseif ($ficha->getColor() === 'negra' && $casilla[0] === '7') {
                $this->modalPromocionPeon($casilla,$ficha);
            }
        }*/

        $this->tablero->casillas[$ficha->getFila()][$ficha->getColumna()]->setContenido("");
        $this->jugadorActual->moverFicha($casilla, $coordenadasFicha);
        $this->setPiezasEnTablero();
    }

    /**
     * Ejecuta la captura de una pieza y mueve la pieza atacante a su posición
     * @param string $coordenadasFichaMatar Coordenadas de la pieza a capturar
     * @param string $coordenadasFichaActual Coordenadas de la pieza que realiza la captura
     * @return void
     */
    public function matarFicha($coordenadasFichaMatar) {

        $fichaMuerta = $this->jugadorRival->getFicha($coordenadasFichaMatar);
        unset($this->jugadorRival->piezasVivas[array_search($fichaMuerta,$this->jugadorRival->getFichasVivas())]);
        $this->jugadorRival->piezasMuertas[] = $fichaMuerta;
        $fichaMuerta->setFila(null);
        $fichaMuerta->setColumna(null);
    }

    /**
     * Verifica si el jugador actual está en jaque
     * @param Juego $copiaJuego Una copia del estado actual del juego
     * @return bool True si el jugador está en jaque, false en caso contrario
     */
    private function estaEnJaque($copiaJuego) {
        $colorActual = $copiaJuego->turno % 2 === 0 ? 'negra' : 'blanca';
        $colorRival = $copiaJuego->turno % 2 === 0 ? 'blanca' : 'negra';

        // Encuentra el rey del jugador actual
        $reyActual = null;
        foreach($copiaJuego->jugadores[$colorActual]->getFichasVivas() as $pieza) {
            if ($pieza->getTipo() === 'Rey') {
                $reyActual = $pieza;
                break;
            }
        }

        if (!$reyActual) {
            return false;
        }

        // Verifica si alguna pieza del rival puede capturar al rey
        foreach($copiaJuego->jugadores[$colorRival]->getFichasVivas() as $piezaRival) {
            $movimientosPosibles = $piezaRival->movimiento($copiaJuego->tablero);
            // Si el rey está en alguna de las casillas donde puede moverse una pieza rival, está en jaque
            if (in_array($reyActual->getCoordenadas(), $movimientosPosibles)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Obtiene todos los movimientos posibles para una pieza que no dejen al rey en jaque
     * @param string $coordenadasPiezaSeleccionada Coordenadas de la pieza a mover
     * @return array Lista de coordenadas donde la pieza puede moverse legalmente
     */
    public function getMovimientosPosibles($coordenadasPiezaSeleccionada) {
        $movimientosPosibles = [];
        $piezaSeleccionada = $this->jugadorActual->getFicha($coordenadasPiezaSeleccionada);
        
        // Obtiene todos los movimientos posibles de la pieza
        $movimientosTeoricosPosibles = $piezaSeleccionada->movimiento($this->tablero);
        
        // Para cada movimiento de la pieza, verifica si deja al rey en jaque
        foreach($movimientosTeoricosPosibles as $movimiento) {
            // Crea una copia del juego
            $copiaJuego = clone $this;
            $copiaPiezaSeleccionada = $copiaJuego->jugadores[$this->jugadorActual->getColor()]->getFicha($coordenadasPiezaSeleccionada);
            
            // Realiza el movimiento en la copia del juego
            $casillaDestino = $copiaJuego->tablero->getCasilla($movimiento);
            if ($casillaDestino->getContenido() !== "") {
                // Si hay una pieza en el la casilla de destino, simula una captura
                $colorRival = $this->jugadorRival->getColor();
                $jugadorRival = $copiaJuego->jugadores[$colorRival];
                $piezaRival = $jugadorRival->getFicha($movimiento);
                if ($piezaRival) {
                    $jugadorRival->matarFicha($piezaRival);
                }
            }
            
            // Actualiza la posición de la pieza en la copia del juego
            $copiaJuego->tablero->casillas[$copiaPiezaSeleccionada->getFila()][$copiaPiezaSeleccionada->getColumna()]->setContenido("");
            $copiaPiezaSeleccionada->setCoordenadas($movimiento);
            $copiaJuego->tablero->setPiezaEnCasilla($copiaPiezaSeleccionada, $movimiento);
            
            // Si el movimiento no deja al rey en jaque, se puede realizar
            if (!$copiaJuego->estaEnJaque($copiaJuego)) {
                $movimientosPosibles[] = $movimiento;
            }
        }
        return $movimientosPosibles;
    }

    /**
     * Comprueba que tipo de enroque se quiere hacer y que jugador lo va a realizar y llama a la función realizarEnroque con estos datos
     * @param object $ficha
     * @param string $casilla
     * @param object $jugadorActual
     * @return void
     */
    private function manejarEnroque($ficha, $casilla, $jugadorActual) {
        $columnaRey = $ficha->getColumna();
        $filaRey = $ficha->getFila();
        $color = $ficha->getColor();
    
        if ($casilla === $filaRey.($columnaRey - 2)) { // Enroque corto
            $this->realizarEnroque($jugadorActual, $color, 'corto');
        } elseif ($casilla === $filaRey.($columnaRey + 2)) { // Enroque largo
            $this->realizarEnroque($jugadorActual, $color, 'largo');
        }
    }
    
    /**
     * Mueve a la torre dependiendo del tipo de enroque y jugador actual
     * @param object $jugadorActual
     * @param string $color
     * @param string $tipoEnroque
     * @return void
     */
    private function realizarEnroque($jugadorActual, $color, $tipoEnroque) {
        if ($tipoEnroque === 'corto') {
            $coordenadasTorreInicial = ($color === 'blanca') ? '70' : '00';
            $coordenadasTorreFinal = ($color === 'blanca') ? '73' : '03';
        } else {
            $coordenadasTorreInicial = ($color === 'blanca') ? '77' : '07';
            $coordenadasTorreFinal = ($color === 'blanca') ? '75' : '05';
        }
    
        $jugadorActual->moverFicha($coordenadasTorreFinal, $coordenadasTorreInicial);
        $this->tablero->casillas[$coordenadasTorreInicial[0]][$coordenadasTorreInicial[1]]->setContenido("");
        $this->setPiezasEnTablero();
    }

    /**
     * Comprueba si el jugador actual no puede realizar ningún movimiento,
     * de ser así llama al método finalPartida()
     * @return bool|void
     */
    public function comprobarJaqueMate() {
        $movimientosPosiblesTotales = [];
        foreach ($this->jugadorActual->getFichasVivas() as $pieza) {
            $movimientosPosiblesTotales[] = $this->getMovimientosPosibles($pieza->getCoordenadas());
        }
        foreach($movimientosPosiblesTotales as $subarrayMovimientos) {
            if (!empty($subarrayMovimientos)) {
                return false;
            }
        }
        $this->finalPartida($this->jugadorRival);
    }

    /**
     * Muestra un modal indicando el final de la partida con un botón para volver a jugar
     * @param object $jugadorGanador
     * @return void
     */
    private function finalPartida($jugadorGanador) {
        echo "<div class='modalBackground'>";
        echo "<div class='modalFinal'>";
        echo "<h2>Ganan ";
        echo $jugadorGanador->getColor() == 'blanca' ? "<span class='blanca'>blancas</span>" : "<span class='negra'>negras</span>";
        echo "</h2>";
        echo "<h3>En el turno ".$this->turno."</h3>";
        echo "<form action='#' method='post'>";
        echo "<button type='submit' class='reiniciarPartida' name='borrarSesion'>Reiniciar partida</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }

    /**
     * Se encarga de modificar el tipo de pieza del peon que va a promocionar
     * @param mixed $coordenadasFicha
     * @param mixed $nuevaFichaTipo
     * @return void
     */
    public function promocionPeon($coordenadasFicha, $nuevaFichaTipo) {
        // ! NO FUNCIONAL
        $ficha = $this->tablero->getCasilla($coordenadasFicha)->getContenido();
        $this->tablero->casillas[$ficha->getFila()][$ficha->getColumna()]->setContenido("");
        $color = $ficha->getColor();
        $nuevasFichasVivas = $this->jugadores[$color]->getFichasVivas();
        $key = array_search($ficha,$nuevasFichasVivas);
        unset($nuevasFichasVivas[$key]);
        if ($nuevaFichaTipo === 'alfil') {
            $nuevaFicha = new Alfil($color,$ficha->getFila(),$ficha->getColumna());
        } elseif ($nuevaFichaTipo === 'caballo') {
            $nuevaFicha = new Caballo($color,$ficha->getFila(),$ficha->getColumna());
        } elseif ($nuevaFichaTipo === 'torre') {
            $nuevaFicha = new Torre($color,$ficha->getFila(),$ficha->getColumna());
        } elseif ($nuevaFichaTipo === 'reina') {
            $nuevaFicha = new Reina($color,$ficha->getFila(),$ficha->getColumna());
        }
        array_push($nuevasFichasVivas,$nuevaFicha);
        $this->jugadores[$color]->setFichasVivas($nuevasFichasVivas);
        $this->tablero->setPiezaEnCasilla($nuevaFicha,$coordenadasFicha);
        print_r($this->jugadores[$color]->getFichasVivas());
        $this->setPiezasEnTablero();
    }

    /**
     * Se encarga de mostrar el modal para promocionar el peon
     * @param string $casilla
     * @param object $ficha
     * @return void
     */
    private function modalPromocionPeon($casilla, $ficha){
        echo "<div class='modalBackground'>";
        echo "<div class='modalPromocion'>";
        echo "<h2>Promoción peón</h2>";
        echo "<form action='#' method='get'>";
        echo "<input type='hidden' name='coordenadasFicha' value='".$casilla."'>";

        echo "<button type='submit' name='tipoPieza' value='alfil'>";
        echo $ficha->getColor() == "negra" ? // Icono alfil 
            '<i class="fa-solid fa-chess-bishop"></i>' : 
            '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-bishop"></i>';
        echo "</button>";

        echo "<button type='submit' name='tipoPieza' value='caballo'>";
        echo $ficha->getColor() == "negra" ? // Icono caballo
            '<i class="fa-solid fa-chess-knight"></i>' : 
            '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-knight"></i>';
        echo "</button>";

        echo "<button type='submit' name='tipoPieza' value='torre'>";
        echo $ficha->getColor() == "negra" ? // Icono torre
            '<i class="fa-solid fa-chess-rook"></i>' : 
            '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-rook"></i>';
        echo "</button>";

        echo "<button type='submit' name='tipoPieza' value='reina'>";
        echo $ficha->getColor() == "negra" ? // Icono reina
            '<i class="fa-solid fa-chess-queen"></i>' : 
            '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-queen"></i>';
        echo "</button>";

        echo "</form>";
        echo "</div>";
        echo "</div>";
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

    public function __clone() {
        $this->tablero = clone $this->tablero;
        foreach($this->jugadores as $color => $jugador) {
            $this->jugadores[$color] = clone $jugador;
        }

        foreach ($this->piezas as $color => $arrayPiezas) {
            foreach ($arrayPiezas as $key => $pieza) {
                $this->piezas[$color][$key] = clone $pieza;
            }
        }
    }
}