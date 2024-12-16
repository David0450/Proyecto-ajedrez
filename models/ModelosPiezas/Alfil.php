<?php
class Alfil extends Pieza {
    public string $tipo = "Alfil";

    public function movimiento($tablero) {
        $fila = $this->fila;
        $columna = $this->columna;
        $casillas = [];

        while($tablero->getCasilla($fila.$columna) != false) {
            $casillas[] = ($fila.$columna);
            $fila++;
            $columna++;
        }
        $columna = $this->columna;
        $fila = $this->fila;
        while($tablero->getCasilla($fila.$columna) != false) {
            $casillas[] = ($fila.$columna);
            $fila++;
            $columna--;
        }
        $columna = $this->columna;
        $fila = $this->fila;
        while($tablero->getCasilla($fila.$columna) != false) {
            $casillas[] = ($fila.$columna);
            $fila--;
            $columna--;
        }
        $columna = $this->columna;
        $fila = $this->fila;
        while($tablero->getCasilla($fila.$columna) != false) {
            $casillas[] = ($fila.$columna);
            $fila--;
            $columna++;
        }
        return $casillas;
    }

    public function __toString()
    {
        return $this->getColor() == "negra" ? '<i class="fa-solid fa-chess-bishop"></i>' : '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-bishop"></i>';
    }
}