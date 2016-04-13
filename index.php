<?php
ini_set("display_errors", 1); 
error_reporting(E_ALL);

require_once("EgyptionFractions.php");

$numerator   = 0;
$denominator = 0;

if(!empty($argv)) {
    if(!empty($argv[1])) {
        $numerator = $argv[1];
    }
    
    if(!empty($argv[2])) {
        $denominator = $argv[2];
    }
} else if(!empty($_GET)) {
    if(!empty($_GET['numerator'])) {
        $numerator = $_GET['numerator'];
    }
    
    if(!empty($_GET['denominator'])) {
        $denominator = $_GET['denominator'];
    }
}

$obj = new EgyptionFractions();
$obj->calculateFractions($numerator, $denominator);


echo "The ratio of $numerator and $denominator is : \n";
echo $obj->getFractions() . "\n";
?>