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
                $start = (int)$startHour * 60 + (int)$startMinute;

                [$endHour, $endMinute] = explode(':', $event->getEnd());
                $end = (int)$endHour * 60 + (int)$endMinute;

                $time += $end - $start;
            }
        }

        return $time;
    }

    public function getStops(string $from, string $to): Collection
    {
        $collection = collect([]);

        [$fromHour, $fromMinute] = explode(':', $from);
        $from = (int)$fromHour * 60 + (int)$fromMinute;

        [$toHour, $toMinute] = explode(':', $to);
        $to = (int)$toHour * 60 + (int)$toMinute;

        foreach ($this->graphs as $graph) {
            foreach ($graph->getEvents() as $event) {
                /** @var Collection|Stop[] $stops */
                $stops = $event->getStops()->filter(
                    function (Stop $stop) use ($from, $to) {
                        [$timeHour, $timeMinute] = explode(':', $stop->getTime());
                        $time = $timeHour * 60 + $timeMinute;

                        return $time >= $from && $time <= $to;
                    }
                );

                foreach ($stops as $stop) {
                    $collection->push(
                        [
                            'stop' => $stop,
                            'graph' => $graph,
                            'event' => $event,
                        ]
                    );
                }
            }
        }

        return $collection;
    }
}