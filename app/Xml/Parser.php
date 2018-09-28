<?php

namespace App\Xml;

use App\StopPoint;
use Illuminate\Support\Collection;

/**
 * @author Afanasyev Pavel <bupyc9@gmail.com>
 */
class Parser
{
    /**
     * @param string $filePath
     * @return Collection|Output[]
     * @throws ParserException
     */
    public static function parse(string $filePath): Collection
    {
        if (!\file_exists($filePath)) {
            throw new ParserException('File does not exist');
        }

        $stopPoints = StopPoint::all()->pluck('name', 'external_id');

        $xml = \simplexml_load_string(\file_get_contents($filePath));
        $collection = collect([]);

        $graphElements = $xml->xpath('graph');
        foreach ($graphElements as $graphElement) {
            $output = $collection->get((int)$graphElement['num']);
            if (null === $output) {
                $output = new Output();
                $collection->put((int)$graphElement['num'], $output);
            }

            $graph = new Graph((int)$graphElement['num'], (int)$graphElement['smena']);
            $output->addGraph($graph);

            $eventElements = $graphElement->xpath('event');
            self::processEvents($eventElements, $graph, $stopPoints);
        }

        return $collection;
    }

    /**
     * @param \SimpleXMLElement[] $eventElements
     * @param Graph $graph
     * @param Collection $stopPoints
     */
    private static function processEvents($eventElements, Graph $graph, Collection $stopPoints): void
    {
        foreach ($eventElements as $eventElement) {
            $event = new Event(
                (int)$eventElement['ev_id'],
                (string)$eventElement['start'],
                (string)$eventElement['end']
            );
            $graph->addEvent($event);

            $stopElements = $eventElement->xpath('stop');
            self::processStop($stopElements, $event, $stopPoints);
        }
    }

    /**
     * @param \SimpleXMLElement[] $stopElements
     * @param Event $event
     * @param Collection $stopPoints
     */
    private static function processStop($stopElements, Event $event, Collection $stopPoints): void
    {
        foreach ($stopElements as $stopElement) {
            $stop = new Stop(
                (int)$stopElement['st_id'],
                (string)$stopElement['time'],
                $stopPoints[(int)$stopElement['st_id']]
            );

            $event->addStop($stop);
        }
    }
}