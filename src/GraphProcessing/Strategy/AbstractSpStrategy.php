<?php

namespace GraphProcessing\Strategy;

abstract class AbstractSpStrategy implements SpStrategyInterface
{
    protected $nodes = [];

    /**
     * {@inheritDoc}
     */
    public function setNodes(array $nodes)
    {
        $this->nodes = $nodes;
    }
}
