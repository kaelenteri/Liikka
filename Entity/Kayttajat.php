<?php

namespace Liikka\Entity;

use Liikka\Entity\Kayttaja;
use Liikka\Entity\ApuMetodit;

include_once 'Kayttaja.php';
include_once 'ApuMetodit.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kayttajat
 *
 * @author Make
 */
class Kayttajat {

    /**
     *
     * @var Kayttaja[] 
     */
    private $kayttajat;

    /**
     * 
     * @return Kayttaja[]
     */
    public function getKayttajat() {
        return $this->kayttajat;
    }

    /**
     * 
     * @param array $kayttajat
     * @return \Liikka\Entity\Kayttajat
     */
    public function setKayttajat(array $kayttajat) {
        $this->kayttajat = $kayttajat;
        return $this;
    }

    /**
     * Etsitään löytyykö käyttänimeä vastaava käyttäjänimi tietokannasta. 
     * Palautetaan käyttäjä-olio. Jos ei löydy niin palautetaan null.
     * @param string $kayttajanimi
     * @return \Liikka\Entity\Kayttaja|null 
     */
    public static function etsi($kayttajanimi) {

        $kayttajanimi = ApuMetodit::muunnaJonoKyselyaVarten($kayttajanimi);
        $conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
        if (!$conn) {
            die('Could not connect to MySQL: ' . mysqli_connect_error());
        }

        $kysely = "SELECT * FROM kayttaja WHERE kayttajanimi = $kayttajanimi";
        $tulos = mysqli_query($conn, $kysely);

        if (mysqli_num_rows($tulos) == 1) {
            echo "<br/ ><br /> jjahuu <br/ ><br />";
            $rivi = $tulos->fetch_array(MYSQLI_ASSOC);

            $kayttaja = new Kayttaja($rivi['kayttajanimi'], $rivi['salasana'], $rivi['etunimi'], $rivi['sukunimi'], $rivi['pituus']);

            mysqli_close($conn);
            return $kayttaja;
        }
        mysqli_close($conn);
        return NULL;
    }

    /**
     * 
     * @param string $kayttajanimi
     * @param string $salasana
     * @return boolean
     */
    public static function kirjautuminenOk($kayttajanimi, $salasana) {
        
        /* @var $kayttaja Kayttaja */
        $kayttaja = self::etsi($kayttajanimi);
        if ($kayttaja != NULL) {
            
            if ($kayttaja->getSalasana() == $salasana) {
                
                return true;
            }
        }
        return false;
    }

}

?>
