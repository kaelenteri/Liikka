<?php

namespace Liikka\Entity;

use Liikka\Entity\Painonmittaus;
use Liikka\Entity\ApuMetodit;
use Liikka\Entity\Kayttaja;

include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/Entity/Painonmittaus.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/Entity/Kayttaja.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/Entity/ApuMetodit.php";

/**
 * Description of Painonmittaukset
 *
 * @author Make
 */
class Painonmittaukset {

    /**
     *
     * @var array 
     */
    private $painonmittaukset = array();

    /**
     * 
     * @return array
     */
    public function getPainonmittaukset() {
        return $this->painonmittaukset;
    }

    /**
     * 
     * @param array $painonmittaukset
     * @return \Liikka\Entity\Painonmittaukset
     */
    public function setPainonmittaukset($painonmittaukset) {
        $this->painonmittaukset = $painonmittaukset;
        return $this;
    }


/**
 * Tämä on hieman hitaampi kutsua kuin etsiNimella, jos Kayttaja-oliota ei ole vielä alustettu kutsupaikassa.
 * @param \Liikka\Entity\Kayttaja $kayttaja
 * @return \Liikka\Entity\Painonmittaukset
 */
    public function etsi(Kayttaja $kayttaja, $alku = "0000-01-01", $loppu = "3000-01-01", $rajoitus = 100) {
        $conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
        if (!$conn) {
            die('Could not connect to MySQL: ' . mysqli_connect_error());
        }

        $kayttajanimi = $kayttaja->getKayttajanimi();
        $kayttajanimi = ApuMetodit::muunnaJonoKyselyaVarten($kayttajanimi);
        
        $alku = ApuMetodit::muunnaJonoKyselyaVarten($alku);
        $loppu = ApuMetodit::muunnaJonoKyselyaVarten($loppu);
        
        $kysely = "
            SELECT * FROM painonmittaus 
            WHERE kayttajanimi = $kayttajanimi 
            AND pvm BETWEEN $alku AND $loppu 
            LIMIT $rajoitus 
            ";

        $tulos = mysqli_query($conn, $kysely);
        if (mysqli_num_fields($tulos) > 0) {
            while ($rivi = mysqli_fetch_assoc($tulos)) {
                $pm = new Painonmittaus($rivi['id'], $kayttaja, $rivi['lukema'], $rivi['pvm'], $rivi['kommentti']);
                
                
                array_push($this->painonmittaukset, $pm);
            }
        }

        mysqli_close($conn);
        
        return $this;
    }
    
        public function etsiNimella($kayttajanimi, $alku = "0000-01-01", $loppu = "3000-01-01", $rajoitus = 100) {
        $conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
        if (!$conn) {
            die('Could not connect to MySQL: ' . mysqli_connect_error());
        }

        $kayttajanimi = ApuMetodit::muunnaJonoKyselyaVarten($kayttajanimi);
        
        $alku = ApuMetodit::muunnaJonoKyselyaVarten($alku);
        $loppu = ApuMetodit::muunnaJonoKyselyaVarten($loppu);
        
        $kysely = "
            SELECT 
            pm.id AS pm_id, 
            pm.kayttajanimi AS pm_kayttajanimi, 
            pm.lukema AS pm_lukema, 
            pm.pvm AS pm_pvm, 
            pm.kommentti AS pm_kommentti, 
            k.kayttajanimi AS k_kayttajanimi, 
            k.etunimi AS k_etunimi, 
            k.sukunimi AS k_sukunimi, 
            k.pituus AS k_pituus
            FROM painonmittaus AS pm, kayttaja AS k 
            WHERE pm.kayttajanimi = $kayttajanimi 
            AND pm.kayttajanimi = k.kayttajanimi 
            AND pvm BETWEEN $alku AND $loppu 
            LIMIT $rajoitus 
            ";

        $tulos = mysqli_query($conn, $kysely);
        if (mysqli_num_fields($tulos) > 0) {
            while ($rivi = mysqli_fetch_assoc($tulos)) {
                $kayttaja = new Kayttaja($kayttajanimi, NULL, $rivi['k_etunimi'], $rivi['k_sukunimi'], $rivi['k_pituus']);
                $pm = new Painonmittaus($rivi['pm_id'], $kayttaja, $rivi['pm_lukema'], $rivi['pm_pvm'], $rivi['pm_kommentti']);
                
                
                array_push($this->painonmittaukset, $pm);
            }
        }

        mysqli_close($conn);
        
        return $this;
    }

    /**
     * 
     * @param Painonmittaus $pm1
     * @param Painonmittaus $pm2
     * @return int
     */
     public function vertaaPvm($pm1, $pm2) {
        return strcmp($pm1->getPvm(), $pm2->getPvm());
    }

    /**
     * 
     * @return array
     */
    public function jarjestaPvmMukaan() {
        usort($this->painonmittaukset, "self::vertaaPvm");
        return $this;
    }

}

?>
