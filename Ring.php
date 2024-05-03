<?php


class Ring {


    public $name = "";
    public $health = 0;
    public $strength = 0;


    // Konstruktor, der die Variablen $name und $age entgegennimmt
    public function __construct($name) {
        // Die übergebenen Variablen $name und $age werden den entsprechenden Klassenvariablen zugewiesen
        $this->name = $name;

        if($this->name == "strong_ring") {
            $this->name = "Ring der Stärke";
            $this->strength = 5;
        }

        if($this->name == "lucky_ring") {
            $this->name = "Ring des Glücks";

            $rand = rand(0, 99);
            if($rand <= 20) {
                $this->health = 20;
            }
            if($rand <= 20) {
                $this->strength = 10;
            }
          
         
        }

    }


    function toString() {
        return "$this->name ( Health = $this->health , Strenght = $this->strength )";
    }


}
