<?php

require_once "Korisnik.php";
require_once "TarifniDodatak.php";
require_once "InternetProvajder.php";
require_once "TarifniPaket.php";
require_once "ListingUnos.php";

class PrepaidKorisnik extends Korisnik
{
    public $kreditKorisnika;

    public function __construct(InternetProvajder $internetProvajder, string $brojUgovora, string $ime, string $prezime, string $adresa, TarifniPaket $tarifniPaket, float $kreditKorisnika)
    {
        parent::__construct( $internetProvajder,  $brojUgovora,  $ime,  $prezime,  $adresa,  $tarifniPaket);
        $this->kreditKorisnika = $kreditKorisnika;
    }

    public function dopuniKredit(float $kredit)
    {
        return $this->kreditKorisnika += $kredit;
    }
    public function surfuj(string $url, int $megabajta):bool
    {
        $isTrue = false;
        foreach($this->tarifniDodaci as $item)
        {
            $potroseniKr = $megabajta * $this->tarifniPaket->cenaPoMegabajtu ;
            if($url == $item->tipDodatka)
            {
                $this->internetProvajder->saobracaj += $megabajta;
                $listingUn = new ListingUnos();
                $listingUn->megabajti = $megabajta;
                $listingUn->url = $url;
                $this->internetProvajder->zabeleziSaobracaj($this, $url, $megabajta);
                $isTrue =  true;
            }
            else if($this->kreditKorisnika >= $potroseniKr)
            {

                $this->kreditKorisnika -= $potroseniKr;
                $this->internetProvajder->saobracaj += $megabajta;
                $listingUn = new ListingUnos();
                $listingUn->megabajti = $megabajta;
                $listingUn->url = $url;
                $this->internetProvajder->zabeleziSaobracaj($this, $url, $megabajta);
                $isTrue =  true;
            }

        }
        return $isTrue;

    }
    public function dodajTarifniDodatak(TarifniDodatak $tarifniDodatak)
    {
        if($tarifniDodatak->tipDodatka != "iptv" && $tarifniDodatak->tipDodatka != "fiksna_telefonija")
        {
            if($tarifniDodatak->cena <= $this->kreditKorisnika)
            {
                $this->kreditKorisnika -= $tarifniDodatak->cena;
            
                array_push($this->tarifniDodaci, $tarifniDodatak);

                return "Kupili ste dodatak<br>";
            }  
        
            return "Nemate dovoljno kredita<br>";
            
        }
        return "Izabrali ste nedozvoljeni paket<br>";
          
    }
}

?>