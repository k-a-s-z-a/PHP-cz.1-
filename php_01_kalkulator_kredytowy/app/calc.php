<?php
require_once dirname(__FILE__).'/../config.php';


$x = $_REQUEST['x'];
$y = $_REQUEST['y'];
$operation = $_REQUEST['op'];


$kwota = $_REQUEST['kwota'];
$lata = $_REQUEST['lata'];
$procent = $_REQUEST['procent'];


$messages = [];

if (!(isset($x) && isset($y) && isset($operation))) {
    $messages[] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

if ($x == "") { $messages[] = 'Nie podano liczby 1'; }
if ($y == "") { $messages[] = 'Nie podano liczby 2'; }
if ($kwota == "") { $messages[] = 'Nie podano kwoty kredytu'; }
if ($lata == "") { $messages[] = 'Nie podano ilości lat'; }
if ($procent == "") { $messages[] = 'Nie podano oprocentowania'; }

if (empty($messages)) {
    if (!is_numeric($x)) { $messages[] = 'Pierwsza wartość nie jest liczbą całkowitą'; }
    if (!is_numeric($y)) { $messages[] = 'Druga wartość nie jest liczbą całkowitą'; }
    if (!is_numeric($kwota)) { $messages[] = 'Kwota kredytu musi być liczbą'; }
    if (!is_numeric($lata)) { $messages[] = 'Ilość lat musi być liczbą'; }
    if (!is_numeric($procent)) { $messages[] = 'Oprocentowanie musi być liczbą'; }
}


if (empty($messages)) {
    $x = intval($x);
    $y = intval($y);

    switch ($operation) {
        case 'minus':
            $result = $x - $y;
            break;
        case 'times':
            $result = $x * $y;
            break;
        case 'div':
            if ($y != 0) {
                $result = $x / $y;
            } else {
                $messages[] = 'Nie można dzielić przez zero!';
            }
            break;
        default:
            $result = $x + $y;
            break;
    }

   
    $kwota = floatval($kwota);
    $lata = intval($lata);
    $procent = floatval($procent);

    $miesiace = $lata * 12;
    $miesieczna_stopa = ($procent / 100) / 12;

    if ($miesieczna_stopa > 0) {
        $rata = ($kwota * $miesieczna_stopa) / (1 - pow(1 + $miesieczna_stopa, -$miesiace));
    } else {
        $rata = $kwota / $miesiace; 
    }
}


include 'calc_view.php';
