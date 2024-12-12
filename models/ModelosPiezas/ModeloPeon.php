<?php
require_once("./models/ModeloPieza.php");
class Peon extends Pieza {
    public function movimiento() {
        if ($this->getColor() == "blanca") {
            return [[$this->getFila()-1, $this->getColumna()],[$this->getFila()-2, $this->getColumna()]];
        } elseif ($this->getColor() == "negra") {
            return [[$this->getFila()+1, $this->getColumna()],[$this->getFila()+2, $this->getColumna()]];            
        }
    }

    public function __toString()
    {
        return $this->getColor() == "negra" ? '<i class="fa-solid fa-chess-pawn"></i>' : '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-pawn"></i>';
    }
}