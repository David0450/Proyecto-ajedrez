<?php

/**
 * Clase Jugador - Representa un jugador en un juego de mesa (en este caso ajedrez)
 * Maneja las operaciones relacionadas con sus piezas/fichas
 */
class Jugador {
    /** @var string Color asignado al jugador ('blanco' o 'negro') */
    private string $color;
    
    /** @var array Array que contiene las piezas que aún están en juego */
    public array $piezasVivas = [];
    
    /** @var array Array que contiene las piezas que han sido capturadas */
    public array $piezasMuertas = [];

    /**
     * Constructor de la clase
     * @param string $color Color asignado al jugador
     */
    public function __construct($color) {
        $this->color = $color;
    }

    /**
     * Mueve una ficha a una nueva posición
     * @param string $coordenadasCasillaFinal Coordenadas de destino de la ficha
     * @param string $coordenadasFicha Coordenadas actuales de la ficha a mover
     */
    public function moverFicha($coordenadasCasillaFinal, $coordenadasFicha) {
        $this->getFicha($coordenadasFicha)->setCoordenadas($coordenadasCasillaFinal);
    }

    /**
     * Establece el conjunto de fichas vivas del jugador
     * @param array $piezas Array con las piezas vivas
     */
    public function setFichasVivas(array $piezas) {
        $this->piezasVivas = $piezas;
    }

    /**
     * Obtiene todas las fichas vivas del jugador
     * @return array Array con las piezas vivas
     */
    public function getFichasVivas() {
        return $this->piezasVivas;
    }

    public function getColor() {
        return $this->color;
    }

    /**
     * Busca y devuelve una ficha específica según sus coordenadas
     * @param string $coordenadas Coordenadas de la ficha a buscar
     * @return object|false Retorna la ficha si la encuentra, false si no existe
     */
    public function getFicha($coordenadas) {
        foreach($this->piezasVivas as $pieza) {
            if ($pieza->getCoordenadas() == $coordenadas) {
                return $pieza;
            }
        }
        return false;
    }

    /**
     * Marca una ficha como capturada, moviéndola de piezasVivas a piezasMuertas
     * @param object $ficha Ficha que ha sido capturada
     */
    public function matarFicha($ficha) {
        unset($this->piezasVivas[array_search($ficha,$this->piezasVivas)]);
        $this->piezasMuertas[] = $ficha;
    }

    /**
     * Muestra las fichas capturadas, opcionalmente filtradas por tipo
     * @param string|null $tipo Tipo específico de ficha a mostrar (opcional)
     */
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

    public function __clone() {
        foreach ($this->piezasVivas as $key => $piezaViva) {
            $this->piezasVivas[$key] = clone $piezaViva;
        }
        foreach ($this->piezasMuertas as $key => $piezaMuerta) {
            $this->piezasMuertas[$key] = clone $piezaMuerta;
        }
    }
}