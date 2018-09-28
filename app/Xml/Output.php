<?php

namespace App\Xml;

use Illuminate\Support\Collection;

/**
 * @author Afanasyev Pavel <bupyc9@gmail.com>
 */
class Output
{
    /** @var Collection|Graph[] */
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

    public function countEvents(): int
    {
        $count = 0;
        foreach ($this->graphs as $graph) {
            $count += $graph->getEvents()->count();
        }

        return $count;
    }

    public function totalTimeEvents(): int
    {
        $time = 0;
        foreach ($this->graphs as $graph) {
            foreach ($graph->getEvents() as $event) {
                [$startHour, $startMinute] = explode(':', $event->getStart());
                $start = $startHour * 60 + $startMinute;

                [$endHour, $endMinute] = explode(':', $event->getEnd());
                $end = $endHour * 60 + $endMinute;

                $time += $end - $start;
            }
        }

        return $time;
    }
}