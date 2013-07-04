<?php

namespace Liikka\Entity;

use Liikka\Entity\Ravinto;

include_once 'Ravinto.php';

/**
 * Description of Ruoat
 *
 * @author Make
 */
class Ravinnot {

    private $ravinnot = array();

    public function jarjestaNimenMukaan($r1, $r2) {
        if ($r1->getNimi() == $r2->getNimi()) {
            return self::jarjestaMerkinMukaan($r1, $r2);
        }
        return strcmp($r1->getNimi(), $r2->getNimi());
    }

    public function jarjestaMerkinMukaan($r1, $r2) {
        if ($r1->getMerkki() == $r2->getMerkki()) {
            return self::jarjestaKalorienMukaan($r1, $r2);
        }
    }

    public function jarjestaKalorienMukaan($r1, $r2) {
        return strcmp($r1->getKalorit(), $r2->getKalorit());
    }

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
        
        if(!$tulos){
            // TODO: tämä poistettava myöhemmin
            die("Kysely: <br />". $kysely. "<br />ei tuottanut tuloksia. Tarkista kysely.");
        }
        
        while ($rivi = mysqli_fetch_array($tulos)) {
            $ravinto = new Ravinto(
                    $rivi['r_id'], 
                    $rivi['r_nimi'], 
                    new Tyyppi($rivi['rt_id'], $rivi['rt_nimi'], $rivi['rt_mittayksikko'], $rivi['rt_gr_ml']), 
                    $rivi['r_kalorit'], 
                    $rivi['r_merkki'], 
                    $rivi['r_kommentti']);
            
            array_push($this->ravinnot, $ravinto);
        }
        mysqli_close($conn);
        if (count($this->getRavinnot()) > 0) {
            usort($this->ravinnot, "self::jarjestaNimenMukaan");
        }
    }

    public function getRavinnot() {
        return $this->ravinnot;
    }

    public function setRavinnot($ravinnot) {
        $this->ravinnot = $ravinnot;
        return $this;
    }

}

?>
