<?php

class ListingUnos
{
    public $url;
    public $megabajti = 0;

    public function dodajMegabajte(int $dodatniMegabajti)
    {
        return $this->megabajti += $dodatniMegabajti;
    }
}

?>