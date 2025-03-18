<?php
require_once dirname(__FILE__).'/../config.php';

include _ROOT_PATH.'/app/security/check.php';

function getParams(&$amount, &$years, &$rate){
    $amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : null;
    $years = isset($_REQUEST['years']) ? $_REQUEST['years'] : null;
    $rate = isset($_REQUEST['rate']) ? $_REQUEST['rate'] : null;
}

function validate(&$amount, &$years, &$rate, &$messages){
    if (!isset($amount, $years, $rate)) {
        return false;
    }

    if ($amount == "") {
        $messages[] = 'Nie podano kwoty kredytu';
    }
    if ($years == "") {
        $messages[] = 'Nie podano liczby lat';
    }
    if ($rate == "") {
        $messages[] = 'Nie podano oprocentowania';
    }

    if (count($messages) != 0) return false;

    if (!is_numeric($amount) || $amount <= 0) {
        $messages[] = 'Kwota kredytu musi być liczbą dodatnią';
    }
    if (!is_numeric($years) || $years <= 0) {
        $messages[] = 'Liczba lat musi być liczbą dodatnią';
    }
    if (!is_numeric($rate) || $rate < 0) {
        $messages[] = 'Oprocentowanie musi być liczbą nieujemną';
    }

    return count($messages) == 0;
}

function process(&$amount, &$years, &$rate, &$messages, &$result){
    $amount = floatval($amount);
    $years = floatval($years);
    $rate = floatval($rate) / 100 / 12;
    $months = $years * 12;

    if ($rate > 0) {
        $result = ($amount * $rate) / (1 - pow(1 + $rate, -$months));
    } else {
        $result = $amount / $months;
    }
    $result = round($result, 2);
}

$amount = null;
$years = null;
$rate = null;
$result = null;
$messages = array();

getParams($amount, $years, $rate);
if (validate($amount, $years, $rate, $messages)) {
    process($amount, $years, $rate, $messages, $result);
}

include 'calc_view.php';

