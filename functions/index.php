<?php


function generateId(int $value = 8): string {
    $id = "";
    $prefix = ['A', 'B', 'C', 'D', 'E'];

    $id .= $prefix[rand(0, 4)];
    $id .= $prefix[rand(0, 4)];

    for ($i = 0; $i < $value - 2; $i++) {
        $id .= rand(0, 9);
    }

    return $id;
}
