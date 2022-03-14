<?php

/**
 * Formata ###.### para ##.###,##
 * 
 * @param float $valor
 * @return string
 */
function currency(float $valor): string {
    $num = number_format($valor, 2, ',', '.');
    if($valor < 0) $num = "<span class='negative'>($num)</span>";
    return $num;
}