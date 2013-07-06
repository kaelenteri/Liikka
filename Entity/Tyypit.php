<?php

namespace Liikka\Entity;
use Liikka\Entity\ApuMetodit;
use Liikka\Entity\Tyyppi;

include_once $_SERVER['DOCUMENT_ROOT'] . "//Liikka/Entity/ApuMetodit.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "//Liikka/Entity/Tyyppi.php";

/**
 * Description of Tyypit
 *
 * @author Make
 */
class Tyypit {
    /**
     *
     * @var array 
     */
    private $tyypit;
    /**
     * 
     * @return array
     */
    public function getTyypit() {
        return $this->tyypit;
    }

    /**
     * 
     * @param array $tyypit
     * @return \Liikka\Entity\Tyypit
     */
    public function setTyypit($tyypit) {
        $this->tyypit = $tyypit;
        return $this;
    }

public static function hae($id){
    
    $conn = mysqli_connect('localhost', 'make', 'toppi', 'liikka', '3306');
    if (!$conn) {
        die('Could not connect to MySQL: ' . mysqli_connect_error());
    }
    $id = ApuMetodit::muunnaJonoKyselyaVarten($id);
    
    $kysely = "SELECT * FROM ravinto_tyyppi WHERE id = $id";

    $tulos = $conn->query($kysely);
    
    if($tulos->num_rows == 1){
        $rivi = $tulos->fetch_array(MYSQLI_ASSOC);
        $tulos->free();
         $conn->close();
        return new Tyyppi($rivi['id'], $rivi['nimi'], $rivi['mittayksikko'], $rivi['gr_ml']);
    }
    
    $tulos->free();

    $conn->close();
    return null;
}


}

?>
