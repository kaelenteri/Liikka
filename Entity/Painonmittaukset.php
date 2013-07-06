<?php

namespace Liikka\Entity;

use Liikka\Entity\Painonmittaus;
use Liikka\Entity\ApuMetodit;

include_once include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/Entity/Painonmittaus.php";
include_once include_once $_SERVER['DOCUMENT_ROOT'] . "/Liikka/Entity/ApuMetodit.php";

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
    private $painonmittaukset;

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
     * 
     * @param array $painonmittaukset
     */
    function __construct($painonmittaukset) {
        $this->painonmittaukset = $painonmittaukset;
    }

    public function hae($kayttajanimi) {
        $conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
        if (!$conn) {
            die('Could not connect to MySQL: ' . mysqli_connect_error());
        }

        $kayttajanimi = ApuMetodit::muunnaJonoKyselyaVarten($kayttajanimi);
        $kysely = "SELECT * FROM painonmittaus WHERE kayttajanimi = $kayttajanimi";
        $tulos = mysqli_query($conn, $kysely);
        if (mysqli_num_fields($tulos) > 0) {
            while ($rivi = mysqli_fetch_assoc($tulos)) {
                $pm = new Painonmittaus($rivi['id'], $rivi['kayttajanimi'], $rivi['lukema'], $rivi['pvm'], $rivi['kommentti']);
                array_push($this->painonmittaukset, $pm);
            }
        }

        mysqli_close($conn);
    }

    /**
     * 
     * @param type $pm1
     * @param type $pm2
     * @return int
     */
    public function vertaaPvm($pm1, $pm2) {
        return strcmp($pm1, $pm2);
    }

    /**
     * 
     * @return array
     */
    public function jarjestaPvmMukaan() {
        return usort($this->painonmittaukset, "self::vertaaPvm");
    }

}

?>
