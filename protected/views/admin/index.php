<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$wers = "0.1";
echo 'test';
echo '<br>';
$url = 'http://www.alexie.pl/wersja.xml'; 
$xml = simpleXML_load_file($url,"SimpleXMLElement",LIBXML_NOCDATA); 
if($xml ===  FALSE) 
{ 
   echo 'wystąpił problem z pobraniem danych!';
} 
else { 
    echo 'Używasz wersji: ';
echo $xml->heading . $wers. "<br>";
        if ($xml->wer == '0.1') {
        echo '<b>Masz aktualną wersję!</b>'; }
        else
        {
            echo "<font color='red'>Najnowsza wersja to: <b>".$xml->wer."</font></b>";
//echo $xml->body;
    }  
        
    } 


?>