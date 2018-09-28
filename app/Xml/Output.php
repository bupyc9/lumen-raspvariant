<?php

namespace App\Xml;

use Illuminate\Support\Collection;

/**
 * @author Afanasyev Pavel <bupyc9@gmail.com>
 */
class Output
{
    private $graphs;

    public function __construct()
    {
        $this->graphs = collect([]);
    }

    /**
     * @return Collection|Graph[]
     */
    public function getGraphs(): Collection
    {
        return $this->graphs;
    }

    public function addGraph(Graph $graph): self
    {
        $this->graphs->push($graph);

        return $this;
    }
}