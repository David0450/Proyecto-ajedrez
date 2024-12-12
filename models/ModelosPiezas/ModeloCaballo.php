<?php
require_once("./models/ModeloPieza.php");
class Caballo extends Pieza {
    public function movimiento() {
        return [[$this->getFila()-1, $this->getColumna()-2],[$this->getFila()+1,$this->getColumna()-2],[$this->getFila()-1, $this->getColumna()+2],[$this->getFila()+1,$this->getColumna()+2],[$this->getFila()-2, $this->getColumna()-1],[$this->getFila()-2,$this->getColumna()+1], [$this->getFila()+2, $this->getColumna()-1],[$this->getFila()+2,$this->getColumna()+1]];
    }

    public function __toString()
    {
        return $this->getColor() == "negra" ? '<i class="fa-solid fa-chess-knight"></i>' : '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-knight"></i>';
    }
}