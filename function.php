<?php

$dic = [
    'a' =>['а','э'],
    'c' =>['ц','к'],
    'j' =>['ж','дж'],
    'k' =>['к'],
    'ck'=>['к'],
];

$input = 'Jack';

uksort($dic, function ($a, $b) {
    $a = strlen($a);
    $b = strlen($b);
    if ($a == $b) {
        return 0;
    }
    return ($a > $b) ? -1 : 1;
});

$i = strtolower($input);
$res = [$i => $i];


function asdf($dic, $res) {
    $resBefore = $res;
    foreach ($dic as $token => $variants) {
        do {
            $input = array_shift($res);
            if (strpos($input, $token) !== false) {
                foreach ($variants as $variant) {

                    $replaced = str_replace($token, $variant, $input);
                    if (!empty($replaced) && $replaced !== $input) {
                        $res[$replaced] = $replaced;

                    }
                }
                if (strlen($token) > 1) {
                    $res[$input] = $input;
                }
            } else {
                $res[$input] = $input;
                break;
            }
        } while ($input !== null);
    }
    if (!empty(array_diff($res, $resBefore))) {
        $res = asdf($dic, $res);
    }
    return $res;
}
$result = array_values(asdf($dic, $res));

var_dump($result);
