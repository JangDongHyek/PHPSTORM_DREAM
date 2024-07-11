<?php


$filters = array(
    "page" => "",
    "limit" => "",
    "search_key1" => "name",
    "search_value1" => "11",
    "search_key2" => "age",
    "search_value2" => "22",
);

$filter = array();
foreach ($filters as $key => $value) {
    if(strpos($key,"search_key") !== false) $column = $key;
    if(strpos($key,"search_value") !== false) $filter[$column] = $value;
}

var_dump($filter);
?>