<?php
 // jaa syntymäajan ja yksilönumeron muodostama yhdeksän numeroinen luku 31:llä
 // ota jakojäännös
 // muuta muotoon 0,"jakojäännös"
 // kerro uusi desimaaliluku 31:llä
 // pyöristä lähimpään kokonaislukuun

  $tarkistumerkit = array("0"=>"0", "1"=>"1", "2"=>"2", "3"=>"3", "4"=>"4",
    "5"=>"5", "6"=>"6", "7"=>"7", "8"=>"8", "9"=>"9", "10"=>"A", "11"=>"B",
    "12"=>"C", "13"=>"D", "14"=>"E", "15"=>"F", "16"=>"H", "17"=>"J", "18"=>"K",
    "19"=>"L", "20"=>"M","21"=>"N", "22"=>"P", "23"=>"R", "24"=>"S", "25"=>"T",
    "26"=>"U", "27"=>"V", "28"=>"W", "29"=>"X", "30"=>"Y");

  $valimerkit = array("+", "-", "Y", "A");

  // erotellaan henkilötunnuksen eri osat ja palautetaan ne taulukossa
  function erotteleHetu($hetu) {
    $alku = substr($hetu, 0, 6);
    $valimerkki = substr($hetu, 6, 1);
    $loppu = substr($hetu, 7, 3);
    $tarkistumerkki = substr($hetu, -1, 1);
    $luku = (int) ($alku . $loppu);
    $tulos = array($luku, $valimerkki, $tarkistumerkki);

    return $tulos;
  }

  function tarkistaHetu($hetu) {
    global $tarkistumerkit;
    global $valimerkit;
    // muuttuja, johon hetun pituutta verrataan
    $pituus = 11;
    
    $hetuTaulu = erotteleHetu($hetu);
    $luku = (float) $hetuTaulu[0];
    $valimerkki = $hetuTaulu[1];
    $tarkistumerkki = $hetuTaulu[2];

    if (strlen($hetu) == $pituus) {
      for ($i = 0; $i < count($valimerkit); $i++) {
        if ($valimerkki == $valimerkit[$i]) {
          $ok = true;
          if ($ok) {
            $valiarvo1 = $luku / 31;
            $kokonaisluku = floor($valiarvo1);
            $jakojaannos = $valiarvo1 - $kokonaisluku;
            $valiarvo2 = $jakojaannos * 31;
            $vertaa = round($valiarvo2);

            if ($tarkistumerkit[strval($vertaa)] == $tarkistumerkki) {
              echo "Syöttämäsi hetu $hetu on aito.";
              break;
            }
            else
              echo "Syötä kelvollinen hetu.";
          }
          else
            continue;
        }
      }
    }
    else
      echo "Syötä kelvollinen hetu.";
  }
  tarkistaHetu("131052-308T");

// tarkista pituus
// tarkista välimerkki
// tarkista tarkistusmerkki
// jaa luku 31:llä
// ota jakojäännös, kerro 31:llä
// pyöristä lähimpään kokonaislukuun
// tarkista, onko luku sama kuin tarkistusmerkkiin liitetty luku


echo "<br><br>";

// funktio copilotin yksinkertaistamana
function tarkistaHetu2($hetu) {
  global $tarkistumerkit, $valimerkit;

  // hetun pituus on 11 merkkiä
  if (strlen($hetu) != 11) {
    echo "Syötä kelvollinen hetu";
    return;
  }
  
  // funktio list() alustaa muuttujat kuten ne olisivat taulukon arvoja
  list($luku, $valimerkki, $tarkistumerkki) = erotteleHetu($hetu);
  
  // funktio in_array() tarkistaa, onko annettu muuttuja taulukossa (yksinkertaisempi kuin for-looppi)
  if (!in_array($valimerkki, $valimerkit)) {
    echo "Syötä kelvollinen hetu";
    return;
  }

  // minulla oli vaikeuksia ymmärtää dvv.fi-sivuston selitys jakojäännöksen laskemisesta; luulin, että se pitää laskea tuolla pitkällä tavalla...
  $vertaa = round(($luku % 31));

  if ($tarkistumerkit[strval($vertaa)] == $tarkistumerkki)
    echo "Syöttämäsi hetu $hetu on aito.";
  else
    echo "Syötä kelvollinen hetu";
}

tarkistaHetu("123456-789A");