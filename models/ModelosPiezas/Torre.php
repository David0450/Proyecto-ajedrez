<?php
class Torre extends Pieza {
    public string $tipo = "Torre";

    public function movimiento($tablero) {
        $fila = $this->fila;
        $columna = $this->columna;
        $casillas = [];

        while($tablero->getCasilla($fila.$columna) != false) {
            $casillas[] = ($fila.$columna);
            $fila++;
        }
        $columna = $this->columna;
        $fila = $this->fila;
        while($tablero->getCasilla($fila.$columna) != false) {
            $casillas[] = ($fila.$columna);
            $fila--;
        }
        $columna = $this->columna;
        $fila = $this->fila;
        while($tablero->getCasilla($fila.$columna) != false) {
            $casillas[] = ($fila.$columna);
            $columna++;
        }
        $columna = $this->columna;
        $fila = $this->fila;
        while($tablero->getCasilla($fila.$columna) != false) {
            $casillas[] = ($fila.$columna);
            $columna--;
        }
        return $casillas;
    }

    public function __toString(){
        return $this->getColor() == "negra" ? '<i class="fa-solid fa-chess-rook"></i>' : '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-rook"></i>';
    }
}