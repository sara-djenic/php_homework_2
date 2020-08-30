<?php

class InternetProvajder
{
    public $ime;
    public $listaKorisnika = array();
    public $saobracaj;

    public function __construct($ime)
    {
        $this->ime = $ime;
    }

    public function generisiRacune()
    {
            $a = "";
            foreach($this->listaKorisnika as $value)
            {
                if($value instanceof PostpaidKorisnik)
                {
                    $a .= $value->generisiRacun();
                }
            }
            return $a;

    }
    public function zabeleziSaobracaj(Korisnik $korisnik, string $url, int $mb)
    {
        echo "Uspeli internet saobracaj<br>
                Broj ugovora: $korisnik->brojUgovora<br>
                Url: $url<br> Megabajti: $mb<br>";
    }
    public function prikazPrepaidKorisnika()
    {
        $a = "";
        foreach($this->listaKorisnika as $value)
        {
            if($value instanceof PrepaidKorisnik)
            {
                $dodaci = "";
                foreach ($value->tarifniDodaci as $item)
                {
                    $dodaci .= $item->tipDodatka.",";
                }
                $a .= "Broj ugovora: $value->brojUgovora<br>
                        Ime i prezime: $value->ime $value->prezime<br>
                        Stanje kredita: $value->kreditKorisnika<br>
                        Tarifni dodaci: $dodaci<br>";
            }
        }
        return $a;
    }
    public function prikazPostpaidKorisnika()
    {
        $a = "";
        foreach($this->listaKorisnika as $value)
        {
            if($value instanceof PostpaidKorisnik)
            {
                $dodaci = "";
                $cenaTarPak = $value->tarifniPaket->cenaPaketa;

                foreach ($value->tarifniDodaci as $item) {

                    $dodaci .= $item->tipDodatka;
                }
                $a .= "Broj ugovora: $value->brojUgovora<br>
                        Ime i prezime: $value->ime $value->prezime<br>
                        Tarifni paket cena: $cenaTarPak<br>
                        Tarifni dodaci: $dodaci<br>";
            }
        }
        return $a;
    }
    public function dodajKorisnika(Korisnik $korisnik)
    {
        if(count($this->listaKorisnika) == 0)
        {
            array_push($this->listaKorisnika, $korisnik);
            return "Dodali ste novog korisnika";
        }
        else
        {
            foreach ($this->listaKorisnika as $value)
            {
                if($korisnik->brojUgovora != $value->brojUgovora)
                {
                    array_push($this->listaKorisnika, $korisnik);
                }
                else
                {
                    return "Vec postoji korisnik sa tim brojem ugovora";
                }
            }
            return "Dodali ste novog korisnika";
        }

    } 
}


?>