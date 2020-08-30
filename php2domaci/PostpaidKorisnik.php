<?php

require_once "Korisnik.php";
require_once "TarifniPaket.php";
require_once "ListingUnos.php";

class PostpaidKorisnik extends Korisnik
{
    public $prekoracenje;
    public $ukupnaNaplata;

    public function ukupnoZaNaplatu()
    {
        $suma = 0;
        foreach($this->tarifniDodaci as $dodatak){
            $suma += $dodatak->cena;
        }
        return $this->ukupnaNaplata = $this->prekoracenje + $this->tarifniPaket->cenaPaketa + $suma;
    }
    public function surfuj(string $url, int $megabajta):bool
    {

        if($this->tarifniPaket->neogranicenSaobracaj == true)
        { 
            $this->internetProvajder->saobracaj += $megabajta;
            $listingUn = new ListingUnos();
            $listingUn->megabajti = $megabajta;
            $listingUn->url = $url;
            array_push($this->lista, $listingUn);
            $this->internetProvajder->zabeleziSaobracaj($this, $url, $megabajta);
            return true;
        }
        else
        {
            return false;
        }
    }
    public function generisiRacun()
    {
        $x = $this->ukupnoZaNaplatu();
        $b = "";
        $paket = $this->tarifniPaket->cenaPaketa;
        foreach($this->tarifniDodaci as $item)
        {
            $b .= "Ime dodatka: $item->tipDodatka Cena: $item->cena";
        }
        return "Broj ugovora: $this->brojUgovora<br>Ime i prezime: $this->ime $this->prezime<br>
                Cena paketa: $paket<br>
               $b<br>
                Prekoracenje: $this->prekoracenje<br>Ukupna cena: $x";
    }
    public function dodajTarifniDodatak(TarifniDodatak $tarifniDodatak)
    {
        if($this->tarifniPaket->neogranicenSaobracaj == true)
        {
            if($tarifniDodatak->tipDodatka == "iptv" && $tarifniDodatak->tipDodatka == "fiksna_telefonija")
            {
                array_push($this->tarifniDodaci, $tarifniDodatak);
            }
        }
        else
        {
            array_push($this->tarifniDodaci, $tarifniDodatak);
        }
    }
}


?>