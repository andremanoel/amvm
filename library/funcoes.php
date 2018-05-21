<?php

function limitarTexto($texto, $limite){
    $contador = strlen($texto);
    if ( $contador >= $limite ) {
        $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
        return $texto;
    }
    else{
        return $texto;
    }
}

/**
 * Retira acentos
 * 
 * @param $string
 * @return string
 */
function normaliza($string){
	$a = 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïñòóôõöùúûýýþÿŔŕ';
	$b = 'AAAAAACEEEEIIIIDNOOOOOUUUUYaaaaaaceeeeiiiinooooouuuyybyRr';
	$string = utf8_decode($string);
	$string = strtr($string, utf8_decode($a), $b); //substitui letras acentuadas por "normais"
	$string = trim($string);
	$string = str_replace(" ","_",$string); // retira espaco
	$string = str_replace("__","_",$string); // retira underlines duplicados
	$string = strtolower($string); // passa tudo para minusculo
	return utf8_encode($string); //finaliza, gerando uma saída para a funcao
}