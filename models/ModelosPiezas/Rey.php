<?php
class Rey extends Pieza {
    public string $tipo = "Rey";

    public function movimiento() {
        
    }

    public function __toString() {
        return $this->getColor() == "negra" ? '<i class="fa-solid fa-chess-king"></i>' : '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-king"></i>';
    }
}