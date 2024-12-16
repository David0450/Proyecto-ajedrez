<?php
class Torre extends Pieza {
    public string $tipo = "Torre";

    public function movimiento($tablero) {
        $fila = $this->fila;
        $columna = $this->columna;
        $casillas = [];
        while($tablero->getCasilla($fila.$columna) != false) {
            if ($tablero->getCasilla($fila.$columna)->getContenido() == null) {
                $casillas[] = ($fila.$columna);
                $fila++;
            }
        }
        $fila = $this->fila;
        while($tablero->getCasilla($fila.$columna) != false) {
            if ($tablero->getCasilla($fila.$columna)->getContenido() == null) {
                $casillas[] = ($fila.$columna);
                $fila--;
            }
        }
        $fila = $this->fila;
        while($tablero->getCasilla($fila.$columna) != false) {
            if ($tablero->getCasilla($fila.$columna)->getContenido() == null) {
                $casillas[] = ($fila.$columna);
                $columna++;
            }
        }
        $columna = $this->columna;
        while($tablero->getCasilla($fila.$columna) != false) {
            if ($tablero->getCasilla($fila.$columna)->getContenido() == null) {
                $casillas[] = ($fila.$columna);
                $columna--;
            }
        }
        return $casillas;
    }

    public function __toString(){
        return $this->getColor() == "negra" ? '<i class="fa-solid fa-chess-rook"></i>' : '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-rook"></i>';
    }
}