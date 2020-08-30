<?php

class TarifniPaket
{
    public  $maxBrzina;
    public $cenaPaketa;
    public  $neogranicenSaobracaj;
    public  $megabajti;
    public  $cenaPoMegabajtu;

    /**
     * TarifniPaket constructor.
     * @param $maxBrzina
     * @param $cenaPaketa
     * @param $neogranicenSaobracaj
     * @param $megabajti
     * @param $cenaPoMegabajtu
     */
    public function __construct(int $maxBrzina, float $cenaPaketa, bool $neogranicenSaobracaj, int $megabajti, float $cenaPoMegabajtu)
    {
        $this->maxBrzina = $maxBrzina;
        $this->cenaPaketa = $cenaPaketa;
        $this->neogranicenSaobracaj = $neogranicenSaobracaj;
        $this->megabajti = $megabajti;
        $this->cenaPoMegabajtu = $cenaPoMegabajtu;
    }

}


?>