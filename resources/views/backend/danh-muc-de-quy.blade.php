<?php
$array = [
    ['id' => 1, 'name' => 'Nam', 'parent' => 0],
    ['id' => 2, 'name' => 'Áo nam', 'parent' => 1],
    ['id'=>3, 'name'=>'Quần nam', 'parent'=>1],
    ['id' => 4, 'name' => 'Áo phông', 'parent' => 2],
    ['id' => 5, 'name' => 'Áo sơ mi', 'parent' => 2],
    ['id'=>6, 'name'=>'Nữ', 'parent'=>0],
    ['id' => 7, 'name' => 'Áo nữ', 'parent' => 6],
    ['id' => 8, 'name' => 'Quần nữ', 'parent' => 6],
];

function getCategory($array, $shift, $parent = 0){
    foreach ($array as $row){
        if($row['parent'] == $parent){
            echo $shift.$row['name'].'<br/>';
            getCategory($array, $shift.'---|', $row['id']);
        }
    }
}

echo getCategory($array, '');
?>
