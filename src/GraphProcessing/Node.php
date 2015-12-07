<?php

namespace Graph;


class Node
{
    /**
     * @var string $name Name of the node
     */
    private $name;

    /**
     * @var array[string, int] $neighbors List of the neighbor nodes and their weights
     */
    private $neighbors = [];

    /**
     * @return array
     */
    public function getNeighbors()
    {
        return $this->neighbors;
    }

    /**
     * @param array $neighbors
     */
    public function setNeighbors($neighbors)
    {
        $this->neighbors = $neighbors;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}
