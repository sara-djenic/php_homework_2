<?php 

require_once "TarifniDodatak.php";
require_once "InternetProvajder.php";
require_once "TarifniPaket.php";
require_once "ListingUnos.php";
require_once "PostpaidKorisnik.php";
require_once "PrepaidKorisnik.php";

$tarifniDodatakFB = new TarifniDodatak(200, "facebook");
$tarifniDodatakViber = new TarifniDodatak(150, "viber");
$tarifniDodatakIPTV = new TarifniDodatak(220, "iptv");
$tarifniPaket1 = new TarifniPaket(100, 1500, false, 2048, 5.5);
$tarifniPaket2 = new TarifniPaket(110, 2000, true, 2048,3.7);
$internetProvajder1 = new InternetProvajder("mts");
$korisnik1 = new PostpaidKorisnik($internetProvajder1, "0001","Sara", "DJenic", "Jug Bogdanova 7", $tarifniPaket1);
$korisnik2 = new PrepaidKorisnik($internetProvajder1, "0002", "Pera", "Peric", "Kraljevska 5", $tarifniPaket1, 500);
$korisnik3 = new PrepaidKorisnik($internetProvajder1, "0003", "Mika", "Mikic", "Nika Miljanica 55", $tarifniPaket2, 1000);
echo "Dopunili ste kredit! Iznos kredita: " . $korisnik2->dopuniKredit(200) . "<br>";
$korisnik2->surfuj("facebook", 50);
echo $korisnik2->dodajTarifniDodatak($tarifniDodatakViber);
echo $korisnik2->dodajTarifniDodatak($tarifniDodatakIPTV);
echo $korisnik3->dodajTarifniDodatak($tarifniDodatakViber);
echo $korisnik1->dodajTarifniDodatak($tarifniDodatakFB);
$korisnik2->surfuj("youtube", 70);
$internetProvajder1->dodajKorisnika($korisnik1);
$internetProvajder1->dodajKorisnika($korisnik2);
$internetProvajder1->dodajKorisnika($korisnik3);
echo "<br>" . $internetProvajder1->generisiRacune() . "<br>";
echo $internetProvajder1->prikazPrepaidKorisnika();
echo $internetProvajder1->prikazPostpaidKorisnika();
$listingUnos1 = new ListingUnos();
$listingUnos1->url = "facebook";
$listingUnos2 = new ListingUnos();
$listingUnos2->url = "viber";
$korisnik1->dodajListingUnos($listingUnos1);
$korisnik1->dodajListingUnos($listingUnos2);
$korisnik1->dodajListingUnos($listingUnos1);
$korisnik1->dodajListingUnos($listingUnos1);
echo "pravljenje listinga <br/>";
echo $korisnik1->napraviListing();








?>
