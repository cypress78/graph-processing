<?php

namespace GraphProcessing\Strategy\Dijkstra;

/**
 * Class DijkstraStrategy
 *
 * Calculates shortest path between two nodes using Dijkstra algorithm
 *
 * @see https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm
 *
 */
class DijkstraStrategy extends \GraphProcessing\Strategy\AbstractSpStrategy
{
    /**
     * {@inheritdoc}
     */
    public function calculate($start, $finish)
    {

        // check if the nodes exist
        if (!isset($this->nodes[$start])) {
            throw new \InvalidArgumentException("The starting node '" . $start . "' is not found");
        }
        if (!isset($this->nodes[$finish])) {
            throw new \InvalidArgumentException("The ending node '" . $finish . "' is not found");
        }

        $distances = [];
        $distances[$start] = 0;

        $visited = [];
        $previous = [];

        $queue = new PriorityQueue();
        $queue->insert($start, $distances[$start]);

        $queue->top();
        while ($queue->valid()) {
            $smallest = $queue->current();

            if ($smallest == $finish) {
                // trying to make path
                $path = array();
                while (isset($previous[$smallest])) {
                    $path[] = $smallest;
                    $smallest = $previous[$smallest];
                }
                $path[] = $start;
                return [
                    'distance' => $distances[$finish],
                    'path' => array_reverse($path)
                ];
            }

            if (isset($visited[$smallest])) {
                $queue->next();
                continue;
            }
            $visited[$smallest] = true;

            foreach ($this->nodes[$smallest] as $neighbor => $weight) {
                if (isset($visited[$neighbor])) {
                    continue;
                }
                $alt = $distances[$smallest] + $weight;
                if (!isset($distances[$neighbor]) || $alt < $distances[$neighbor]) // treat undefined distance as infinity
                {
                    $distances[$neighbor] = $alt;
                    $previous[$neighbor] = $smallest;
                    $queue->insert($neighbor, $alt);
                }
            }
            $queue->next();
        }

        // there is no available path if the graph is unconnected
        return null;
    }
}
