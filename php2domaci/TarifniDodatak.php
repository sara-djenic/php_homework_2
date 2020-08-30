<?php

class TarifniDodatak
{
    public $cena;
    public $tipDodatka;
    public $dozvoljeniDodaci = ["facebook", "instagram", "iptv", "twitter", "viber", "fiksna_telefonija"];
    public function __construct($cena, $tipDodatka)
    {
        if(in_array($tipDodatka, $this->dozvoljeniDodaci))
        {
            $this->tipDodatka = $tipDodatka;
            $this->cena = $cena;
        }
        else
        {
            return "Doslo je do greske";
        }
    }

}



?>