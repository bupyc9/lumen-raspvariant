<?php

namespace App\Console\Commands;

use App\Xml\Event;
use App\Xml\Graph;
use App\Xml\Output;
use App\Xml\Parser;
use App\Xml\ParserException;
use App\Xml\Stop;
use Illuminate\Console\Command;

/**
 * @author Afanasyev Pavel <bupyc9@gmail.com>
 */
class StopsCommand extends Command
{
    protected $signature = 'xml:parse:stops {filePath} {num} {from} {to}';

    protected $description = 'Stops by num';

    /**
     * @throws ParserException
     */
    public function handle(): void
    {
        $filePath = $this->argument('filePath');
        $num = $this->argument('num');
        $from = $this->argument('from');
        $to = $this->argument('to');

        $collection = Parser::parse($filePath);

        if (!$collection->has($num)) {
            throw new \RuntimeException('Not found output by `num`');
        }
        /** @var Output $output */
        $output = $collection[$num];

        $items = $output->getStops($from, $to);
        $rows = [];
        foreach ($items as $item) {
            /** @var Graph $graph */
            $graph = $item['graph'];
            /** @var Event $event */
            $event = $item['event'];
            /** @var Stop $stop */
            $stop = $item['stop'];

            $rows[] = [
                $graph->getSmena(),
                $event->getId(),
                $stop->getName(),
                $stop->getTime(),
            ];
        }

        $this->output->table(['smena', 'event_id', 'stop_name', 'stop_time',], $rows);
    }
}