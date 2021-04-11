<?php

    class Hero{

        public $Id;
        public $TranFecha;
        public $TranMonto;
        public $TranDescripcion;
       

        public function __construct($id,$tranfecha,$tranmonto,$trandescripcion)
        {

            $this->Id = $id;
            $this->TranFecha= $tranfecha;
            $this->TranMonto = $tranmonto;
            $this->TranDescripcion = $trandescripcion;
            

            
        }

    }

?>