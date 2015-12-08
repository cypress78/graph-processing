<?php

require_once(__DIR__ . '/vendor/autoload.php');

$edges = [
    ['1', '2', 1], // from point 1 to point 2 - distance 1
    ['1', '4', 2], // from point 1 to point 4 - distance 2
    ['2', '3', 3], // from point 2 to point 3 - distance 3
    ['2', '4', 3], // from point 2 to point 4 - distance 3
    ['3', '4', 1], // from point 3 to point 4 - distance 1
    ['3', '5', 5], // from point 3 to point 5 - distance 5
    ['4', '5', 1], // from point 4 to point 5 - distance 1
];

// instantiating undirected graph
$graph = new GraphProcessing\Graph(false);
$graph->setByEdges($edges);

// calculate shortest path from point 1 to point 5, path and distance returned
print_r($graph->calculateShortestPath('1', '5', 'dijkstra'));
