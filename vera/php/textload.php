<?php

session_start();

//Derp manier om turkse karakters te ondersteunen maar blijkbaar de enige manier om dit te doen in php (naast iconv(), maar dat wordt standaard niet ondersteund op hostingpakketen)
//Caching zodat array niet elke keer aangemaakt wordt, zou meer advanced kunnen maar zou normaal snel genoeg moeten werken
if (!isset($_SESSION['convert_array'])) {
    $convert_array = array( 'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'Ğ'=>'G', 'İ'=>'I', 'Ş'=>'S', 'ğ'=>'g', 'ı'=>'i', 'ş'=>'s', 'ü'=>'u');
    $_SESSION['convert_array'] = $convert_array;
}

if (isset($_REQUEST['letter'])) {
    $dir = '../txt/';
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                $converted_letter = strtr($_REQUEST['letter'], $_SESSION['convert_array']);
                if (stripos(strtr($file, $_SESSION['convert_array']), $converted_letter) === 0) {
                    $naamZonderTxt = str_ireplace(".txt", "", $file);
                    $fileId = "tekst-" . str_replace(" ", "", $naamZonderTxt);
                    //DA NE MONSTERECHO
                    echo "<a href=\"#\" data-toggle=\"collapse\" data-target=\"#" . $fileId . "\">" . "<h1>" . $naamZonderTxt . "</h1>" . "</a>" . "<div class=\"collapse\" id=\"" . $fileId . "\">" . "<p>" . nl2br(file_get_contents($dir . $file)) . "</p>" . "</div>";
                }
            }
            closedir($dh);
        }
    }
}
