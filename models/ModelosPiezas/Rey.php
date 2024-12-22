<?php
/**
 * Clase Torre - Representa la pieza del Rey en el juego de ajedrez
 * Hereda de la clase Pieza
 */
class Rey extends Pieza {
    /** @var string Identificador del tipo de pieza */
    public string $tipo = "Rey";

    /** @var bool Identifica si el rey se ha movido o no */
    public bool $seHaMovido = false;

    /**
     * Calcula los movimientos posibles del rey en el tablero
     * El rey se mueve una casilla en cualquier dirección y tiene un movimiento especial:
     * - Si no se ha movido en toda la partida puede moverse 2 casillas en la dirección de la torre de su color que tampoco se haya movido, 
     *   moviendo la torre una casilla al lado del rey en la dirección contraria.
     * @param Tablero $tablero Instancia del tablero de juego
     * @return array Array con las coordenadas de las casillas donde puede moverse
     */
    public function movimiento($tablero) {
        $casillas = [];
        $casillasPosibles = [
            "arriba" => ($this->getFila()-1).$this->getColumna(), // Arriba
            "abajo" => ($this->getFila()+1).$this->getColumna(), // Abajo
            "derecha" => ($this->getFila()).$this->getColumna()+1, // Derecha
            "izquierda" => ($this->getFila()).$this->getColumna()-1, // Izquierda
            "arribaIzquierda" => ($this->getFila()-1).$this->getColumna()-1, // Arriba izquierda
            "arribaDerecha" => ($this->getFila()-1).$this->getColumna()+1, // Arriba derecha
            "abajoIzquierda" => ($this->getFila()+1).$this->getColumna()-1, // Abajo izquierda
            "abajoDerecha" => ($this->getFila()+1).$this->getColumna()+1, // Abajo derecha
            "dosDerecha" => $this->getFila().$this->getColumna()+2, // Dos derecha (enroque)
            "dosIzquierda" => $this->getFila().$this->getColumna()-2, // Dos izquierda (enroque)
        ];
        foreach($casillasPosibles as $key => $casilla) {
            if ($tablero->getCasilla($casilla) !== false) { // Si la casilla existe
                if($tablero->getCasilla($casilla)->getContenido() === '') { // Si está vacía
                    $casillas[$key] = $casilla;
                } else {
                    if($tablero->getCasilla($casilla)->getContenido()->getColor() !== $this->color) {
                        $casillas[$key] = $casilla;
                    }
                }
            }
        }

        if ($this->seHaMovido) {
            unset($casillas['dosIzquierda'], $casillas['dosDerecha']);
        } else {
            if (!$this->puedeEnrocar('derecha', $this->color, $tablero)) {
                unset($casillas['dosDerecha']);
            }
            if (!$this->puedeEnrocar('izquierda', $this->color, $tablero)) {
                unset($casillas['dosIzquierda']);
            }
        }
        return $casillas;
    }

    /**
     * Realiza las comprobaciones necesarias para saber si el rey puede enrocar o no
     * @param string $lado
     * @param string $color
     * @param object $tablero
     * @return bool
     */
    private function puedeEnrocar($lado, $color, $tablero) {
        $torrePosicion = ($color === 'blanca') 
            ? (($lado === 'derecha') ? '77' : '70') 
            : (($lado === 'derecha') ? '07' : '00');
        
        $casillasEntreReyYTorres = ($color === 'blanca')
            ? (($lado === 'derecha') ? ['75', '76'] : ['71', '72', '73'])
            : (($lado === 'derecha') ? ['05', '06'] : ['01', '02', '03']);
        
        // Verificar que esa casilla no está vacía, contiene una torre, es del color correcto, y no se ha movido
        $torre = $tablero->getCasilla($torrePosicion)->getContenido();
        if ($torre === '' || $torre->getTipo() !== 'Torre' || $torre->getColor() !== $color || $torre->seHaMovido === true) {
            return false;
        }
    
        // Verificar que las casillas entre el rey y la torre están vacías
        foreach ($casillasEntreReyYTorres as $posicion) {
            if ($tablero->getCasilla($posicion)->getContenido() !== '') {
                return false;
            }
        }
    
        return true;
    }
    /**
     * Devuelve la representación visual HTML del rey
     * Utiliza los iconos de Font Awesome para mostrar la pieza
     * Aplica estilos diferentes según el color de la pieza
     * @return string Código HTML con el icono del rey
     */
    public function __toString() 
    {
        // Si es negra, retorna el icono sin estilos adicionales
        // Si es blanca, agrega estilos para el color y el borde sombreado
        return $this->getColor() == "negra" ? 
            '<i class="fa-solid fa-chess-king"></i>' : 
            '<i style="color: #f5f5f5;text-shadow: 1px 1px 1px black, 1px -1px 1px black, -1px -1px 1px black, -1px 1px 1px black;" class="fa-solid fa-chess-king"></i>';
    }
}