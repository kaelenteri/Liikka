<?php

namespace Liikka\Entity;

use Liikka\Entity\Ravinto;
use Liikka\Entity\Tyypit;
use Liikka\Entity\Tyyppi;


include_once $_SERVER['DOCUMENT_ROOT']."/Liikka/Entity/Ravinto.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Liikka/Entity/Tyyppi.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Liikka/Entity/Tyypit.php";


/**
 * Description of Ruoat
 *
 * @author Make
 */
class Ravinnot {

    /**
     *
     * @var Ravinto[] 
     */
    private $ravinnot = array();

    /**
     * 
     * @param Ravinto $r1
     * @param Ravinto $r2
     * @return int
     */
    public function jarjestaNimenMukaan($r1, $r2) {
        if ($r1->getNimi() == $r2->getNimi()) {
            return self::jarjestaMerkinMukaan($r1, $r2);
        }
        return strcmp($r1->getNimi(), $r2->getNimi());
    }

    /**
     * 
     * @param Ravinto $r1
     * @param Ravinto $r2
     * @return int
     */
    public function jarjestaMerkinMukaan($r1, $r2) {
        if ($r1->getMerkki() == $r2->getMerkki()) {
            return self::jarjestaKalorienMukaan($r1, $r2);
        }
    }

    /**
     * 
     * @param Ravinto $r1
     * @param Ravinto $r2
     * @return int
     */
    public function jarjestaKalorienMukaan($r1, $r2) {
        return strcmp($r1->getKalorit(), $r2->getKalorit());
    }

    /**
     * Hakee kaikki ravinnot tietokannasta taulukkoon
     */
    public function alusta() {
        $conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
        if (!$conn) {
            die('Could not connect to MySQL: ' . mysqli_connect_error());
        }

        $kysely = "SELECT r.id AS r_id, 
                    r.nimi AS r_nimi, 
                    r.merkki AS r_merkki, 
                    r.kalorit AS r_kalorit, 
                    r.kommentti AS r_kommentti, 
                    rt.id AS rt_id, 
                    rt.nimi AS rt_nimi,   
                    rt.mittayksikko AS rt_mittayksikko, 
                    rt.gr_ml AS rt_gr_ml 
                    FROM ravinto AS r, ravinto_tyyppi AS rt 
                    WHERE r.tyyppi = rt.id";
        $tulos = mysqli_query($conn, $kysely);

        if (!$tulos) {
            // TODO: tämä poistettava myöhemmin
            die("Kysely: <br />" . $kysely . "<br />ei tuottanut tuloksia. Tarkista kysely.");
        }

        while ($rivi = mysqli_fetch_array($tulos)) {
            $tyyppi = Tyypit::hae($rivi['rt_id']);
            if ($tyyppi == null){
                die("Ei voitu hakea ravinnon tyyppiä. Tietokannassa on joku rikki. Ota yhteyttä järjestelmänvalvojaan.");
            }
            $ravinto = new Ravinto(
                    $rivi['r_id'], $rivi['r_nimi'], $tyyppi, $rivi['r_kalorit'], $rivi['r_merkki'], $rivi['r_kommentti']);

            array_push($this->ravinnot, $ravinto);
        }
        mysqli_close($conn);
        if (count($this->getRavinnot()) > 0) {
            usort($this->ravinnot, "self::jarjestaNimenMukaan");
        }
    }

    /**
     * 
     * @return array
     */
    public function getRavinnot() {
        return $this->ravinnot;
    }

    /**
     * 
     * @param array
     * @return \Liikka\Entity\Ravinnot
     */
    public function setRavinnot($ravinnot) {
        $this->ravinnot = $ravinnot;
        return $this;
    }

}

?>
