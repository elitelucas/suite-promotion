<?php

function filterTree($arr, $parent, $query)
{
    $filtered = [];

    $roots = array_filter($arr, function ($item) use ($parent) {
        return $item->parent == $parent;
    });

    foreach ($roots as $root) {
        if (stripos($root->label, $query) !== false) {
            $filtered[] = $root;
        } else {
            $results = filterTree($arr, $root->id, $query);
            if (count($results) > 0) {
                $filtered = array_merge($filtered, $results);
                $filtered[] = $root;
            }
        }
    }

    return $filtered;
}

$contents = json_decode(file_get_contents("millery-data-single.json"), false);
$parent = isset($_GET["parent"]) ? $_GET["parent"] : null;
$query = isset($_GET["query"]) ? $_GET["query"] : "";

$results = filterTree($contents, $parent, $query);

echo json_encode($results);
