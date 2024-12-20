<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use NumberToWords\NumberToWords;

define( 'COMPANY_LIST',
 value: [
    'Son light IMPRIMERIE',
    'DEALER GROUP',
    'BUFI TECHNOLOGIE',
    'NOVA TECH',
    'AFRO BUSINESS GROUP',
    'SOCIETE ANONYME'
]);

// DEFINIR LES CLES COMPANY PAR LES ID
define('COMPANY_KEYS', value: [
    1 => 'Son light IMPRIMERIE',
    2 => 'DEALER GROUP',
    3 => 'BUFI TECHNOLOGIE',
    4 => 'NOVA TECH',
    5 => 'AFRO BUSINESS GROUP',
    6 => 'SOCIETE ANONYME'
]);



define('TVA_RANGE',value: [0, 4, 10, 18, 22]);



// function getNumberToWord($number , $language='fr'){
//     // create the number to words "manager" class
//     $numberToWords = new NumberToWords();
//     // build a new number transformer using the RFC 3066 language identifier
//     $numberTransformer = $numberToWords->getNumberTransformer($language);
//     return  $numberTransformer->toWords($number);
// }
