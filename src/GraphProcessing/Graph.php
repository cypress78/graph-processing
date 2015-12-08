<?php

namespace GraphProcessing;

class Graph
{
    /**
     * @var array $nodes [ node => [ neighbor => weight ] ]
     */
    protected $nodes = [];

    protected $directed;

    /**
     * @param boolean $directed Is the graph directed or undirected
     */
    public function __construct($directed = false)
    {
        $this->directed = $directed;
    }

    /**
     * @param array $edges An array of edges [node1, node2, weight]
     */
    public function setByEdges(array $edges)
    {
        foreach ($edges as $edge) {
            $this->nodes[$edge[0]][$edge[1]] = $edge[2];
            if (!$this->directed) {
                $this->nodes[$edge[1]][$edge[0]] = $edge[2];
            }
        }
    }

    /**
     * @param string $start
     * @param string $finish
     * @param string $strategy
     *
     * @return array|null
     */
    public function calculateShortestPath($start, $finish, $strategy = 'dijkstra')
    {
        // @TODO use factory method to instantiate proper strategy

        if ($strategy != 'dijkstra') {
            throw new \InvalidArgumentException("Unsupported strategy: " . $strategy);
        }
        $spStrategy = new Strategy\Dijkstra\DijkstraStrategy();
        $spStrategy->setNodes($this->nodes);
        return $spStrategy->calculate($start, $finish);
    }
}
