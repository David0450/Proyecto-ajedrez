<?php

class Jugador {
    private string $color;
    private array $piezasVivas = [];
    private array $piezasMuertas = [];

    public function __construct($color) {
        $this->color = $color;
    }

    public function moverFicha() {
        
    }

    public function setFichasVivas(array $piezas) {
        $this->piezasVivas = $piezas;
    }
}