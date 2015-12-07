<?php

namespace GraphProcessing\Strategy;

interface SpStrategyInterface
{
    /**
     * Calculates shortest path between two nodes
     *
     * @param string $start  starting point
     * @param string $finish ending point
     *
     * @throws \InvalidArgumentException
     *
     * @return array|null
     */
    public function calculate($start, $finish);

    /**
     * Setting up the graph
     *
     * @param array $nodes array of nodes
     *
     * @return mixed
     */
    public function setNodes(array $nodes);
}
