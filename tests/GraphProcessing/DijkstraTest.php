<?php

namespace GraphProcessing\Tests;

class DijkstraStrategyTest extends \PHPUnit_Framework_TestCase
{
    protected $connectedGraph = [
        '1' => ['2' => 1, '4' => 2],
        '2' => ['1' => 1, '3' => 3, '4' => 3],
        '3' => ['2' => 3, '4' => 1, '5' => 5],
        '4' => ['1' => 2, '2' => 3, '3' => 1, '5' => 1],
        '5' => ['3' => 5, '4' => 1],
    ];
    protected $unconnectedGraph = [
        '1' => ['2' => 1, '4' => 2],
        '2' => ['1' => 1, '3' => 3, '4' => 3],
        '3' => ['2' => 3, '4' => 1],
        '4' => ['1' => 2, '2' => 3, '3' => 1],
        '5' => ['6' => 5],
        '6' => ['5' => 5],
    ];

    protected $dijkstraStrategy;

    protected function setUp()
    {
        parent::setUp();

        $this->dijkstraStrategy = new \GraphProcessing\Strategy\Dijkstra\DijkstraStrategy();
    }

    public function testShortestPathConnectedGraph()
    {
        $this->dijkstraStrategy->setNodes($this->connectedGraph);
        $result = $this->dijkstraStrategy->calculate('1', '5');

        $this->assertEquals(3, $result['distance']);
        $this->assertEquals(1, $result['path'][0]);
        $this->assertEquals(4, $result['path'][1]);
        $this->assertEquals(5, $result['path'][2]);
    }

    public function testShortestPathUnConnectedGraph()
    {
        $this->dijkstraStrategy->setNodes($this->unconnectedGraph);
        $result = $this->dijkstraStrategy->calculate('1', '6');

        $this->assertNull($result);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testShortestPathUnexistingStart()
    {
        $this->dijkstraStrategy->setNodes($this->connectedGraph);

        $this->dijkstraStrategy->calculate('100', '6');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testShortestPathUnexistingFinish()
    {
        $this->dijkstraStrategy->setNodes($this->connectedGraph);

        $this->dijkstraStrategy->calculate('1', '100');
    }
}
