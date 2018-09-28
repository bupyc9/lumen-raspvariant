<?php

namespace App\Console\Commands;

use App\StopPoint;
use App\Xml\ParserException;
use Illuminate\Console\Command;
use App\Xml\Parser;
use Illuminate\Support\Str;

/**
 * @author Afanasyev Pavel <bupyc9@gmail.com>
 */
class ParseCommand extends Command
{
    protected $signature = 'xml:parse {filePath}';

    protected $description = 'Parsing xml';

    /**
     * @throws ParserException
     */
    public function handle(): void
    {
        $filePath = $this->argument('filePath');

        $collection = Parser::parse($filePath);

        $stops = [];
        foreach ($collection as $output) {
            foreach ($output->getGraphs() as $graph) {
                foreach ($graph->getEvents() as $event) {
                    foreach ($event->getStops() as $stop) {
                        $id = $stop->getId();
                        $stops[$id] = [
                            'external_id' => $id,
                            'name' => Str::random(),
                        ];
                    }
                }
            }
        }

        StopPoint::query()->delete();
        foreach ($stops as $stop) {
            $stopPoint = new StopPoint();
            $stopPoint->fill($stop);
            $stopPoint->save();
        }
    }
}