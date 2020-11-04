<?php
function getCategory($array, $shift, $active = '', $parent = 0){
    foreach ($array as $row){
        if($row->parent == $parent){
            $selected = '';
            if($row->id == $active){
                $selected = 'selected="selected"';
            }
            echo "<option $selected value='$row->id'>$shift$row->name</option>";
            getCategory($array, $shift.'---|', $active, $row->id);
        }
    }
}

function getCategorySecond($array, $shift, $parent = 0){
    $data = '';
    foreach ($array as $row){
        if($row->parent == $parent){
            $data = "<div class='item-menu'><span>$shift$row->name</span>
                        <div class='category-fix' style='width: 130px;'>
                            <a class='btn-category btn-primary' href='admin/category/edit/$row->id'>Sửa</a>
                            <a onclick='return delete_category(\"$row->name\")' class='btn-category btn-danger' href='admin/category/delete/$row->id'>Xóa</a>
                        </div>
                    </div>";
            echo $data;
            getCategorySecond($array, $shift.'---|', $row->id);
        }
    }
}

// $arr = $product->values
function attr_values($arr){
    $result = [];
    foreach ($arr as $value){
        $attr = $value->attributes->name;
        $result[$attr][] = $value->value;
    }
    return $result;
}

// get variant
/*  $array = [
        "1" => [
            0 => "1",
            1 => "2"
        ],
        "2" => [
            0 => "5",
            1 => "6"
        ]
    ]; */
function get_combinations($array){
    $result = array(array());
    //TH1: $property = 1;
    //TH2: $property = 2;
    foreach ($array as $property => $property_values){
        $tmp = [];
        //TH1.1: $result = []; $result_item = [];
        foreach ($result as $result_item){
            //TH1.1: $property_value = "1";
            foreach ($property_values as $property_value){
                //TH1.1: array($property => $property_value) = [1 => "1"];
                $tmp[] = array_merge($result_item, array($property => $property_value));
            }
        }
        $result = $tmp;
    }
    return $result;
}

//check value
function checkValue($product, $value_check){
    foreach ($product->values as $value){
        if ($value->id == $value_check){
            return true;
        }
    }
    return false;
}

function checkVariant($product, $arr_variant_values){
    foreach ($product->variants as $variant){
        $array = [];
        foreach ($variant->values as $variant_value){
            $array[] = $variant_value->id;
        }
        if(array_diff($array, $arr_variant_values) == null){
            return false;
        }
    }
    return true;
}

function getPriceByVariant($product, $attr){
    foreach ($product->variants as $variant){
        $arr = [];
        foreach ($variant->values as $value){
            $arr[] = $value->value;
        }

        if (array_diff($arr, $attr) == NULL){
            if($variant->price == 0){
                return $product->price;
            }
            return $variant->price;
        }
    }
    return $product->price;
}
