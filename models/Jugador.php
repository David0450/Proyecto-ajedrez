<?php

class Jugador {
    private string $color;
    public array $piezasVivas = [];
    public array $piezasMuertas = [];

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

    public function matarFicha($ficha) {
        unset($this->piezasVivas[array_search($ficha,$this->piezasVivas)]);
        $this->piezasMuertas[] = $ficha;
    }

    public function mostrarMuertas($tipo = null) {
        if ($tipo == null) {
            foreach($this->piezasMuertas as $pieza) {
                echo $pieza;
            }
        } else {
            foreach($this->piezasMuertas as $pieza) {
                if ($pieza->getTipo() == $tipo) {
                    echo $pieza;
                }
            }
        }
    }
}