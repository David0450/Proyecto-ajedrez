<?php

class Jugador {
    private string $color;
    private array $piezasVivas = [];
    private array $piezasMuertas = [];

    public function __construct($color) {
        $this->color = $color;
    }

    public function moverFicha($casillaFinal, $coordenadasFicha) {
        $this->getFicha($coordenadasFicha)->setCoordenadas($casillaFinal);
    }

    public function setFichasVivas(array $piezas) {
        $this->piezasVivas = $piezas;
    }

    public function getFichasVivas() {
        return $this->piezasVivas;
    }

    public function getFicha($coordenadas) {
        foreach($this->piezasVivas as $pieza) {
            if ($pieza->getCoordenadas() == $coordenadas) {
                return $pieza;
            }
        }
        return false;
    }
}