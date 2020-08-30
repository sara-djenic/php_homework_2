<?php

require_once "ListingUnos.php";
require_once "IzradaListinga.php";

abstract class Korisnik implements IzradaListinga 
 {

    public $internetProvajder;
    public $ime;
    public $prezime;
    public $adresa;
    public $brojUgovora;    
    public $tarifniDodaci = array();
    public $lista = array(); 
    public $tarifniPaket;

    public function __construct(InternetProvajder $internetProvajder, string $brojUgovora, string $ime, string $prezime, string $adresa, TarifniPaket $tarifniPaket)
    {
        $this->internetProvajder = $internetProvajder;
        $this->brojUgovora = $brojUgovora;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->adresa = $adresa;
        $this->tarifniPaket = $tarifniPaket;
    }

    public function dodajListingUnos(ListingUnos $listingUnos)
    {
        if(count($this->lista) != 0)
        {

            foreach($this->lista as $obj)
            {
                if($obj->url == $listingUnos->url)
                {
                    $obj->dodajMegabajte(30);
                }
                else
                {
                    array_push($this->lista, $listingUnos);

                }
            }
        }
        else
        {
            array_push($this->lista, $listingUnos);

        }

        
    }
    public function napraviListing():string
    {
        usort($this->lista, function($a, $b) {return strcmp($b->megabajti, $a->megabajti);});
        $output = "";
        foreach($this->lista as $item)
        {
            $output .= "URL: $item->url <bt/> Megabajti: $item->megabajti <br/>";
        }
        return $output;
    }
    abstract function surfuj(string $url, int $megabajti):bool;
    
    abstract function dodajTarifniDodatak(TarifniDodatak $tarifniDodatak);


    
 }


?>