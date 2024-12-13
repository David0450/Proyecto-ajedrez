<?php
class Peon extends Pieza {
    public function movimiento() {
        $casillas = [];
        if ($this->getColor() == "blanca") {
            if ($this->getFila() == 6) {
                $casillas[] = ($this->getFila()-2).$this->getColumna();
            }
            $casillas[] = ($this->getFila()-1).$this->getColumna();
            return $casillas;
        } elseif ($this->getColor() == "negra") {
            if ($this->getFila() == 1) {
                $casillas[] = ($this->getFila()+2).$this->getColumna();
            }
            $casillas[] = ($this->getFila()+1).$this->getColumna();
            return $casillas;
        }
    }

    public function __toString()
    {
        return $this->getColor() == "negra" ? '<i class="fa-solid fa-chess-pawn"></i>' : '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-pawn"></i>';
    }
}