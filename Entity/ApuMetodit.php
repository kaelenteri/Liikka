<?php

namespace Liikka\Entity;

/**
 * Description of ApuMetodit
 *
 * @author Make
 */
class ApuMetodit {

    /**
     * 
     * @param string $jono
     * @return string
     */
    public static function muunnaJonoKyselyaVarten($jono) {
        return self::lisaaAlkuunJaLoppuun($jono, "\"");
    }

    public static function lisaaAlkuun($jono, $alku) {
        return $alku . $jono;
    }

    public static function lisaaLoppuun($jono, $loppu) {
        return $jono . $loppu;
    }

    public static function lisaaAlkuunJaLoppuun($jono, $lisays) {
        $jono = self::lisaaAlkuun($jono, $lisays);
        $jono = self::lisaaLoppuun($jono, $lisays);
        return $jono;
    }

    /**
     * Muuntaa taulukon key => valuet SQL kyselya varten sopiviksi
     * @param array $taulukko
     */
    public static function muunnaTaulukkoKyselyaVarten($taulukko) {
        foreach ($taulukko as $key => $value) {
            echo  "Key: " . $key . ", Value: " . $value . "<br />";
            self::muunnaJonoKyselyaVarten($value);
        }

    }

}
?>

