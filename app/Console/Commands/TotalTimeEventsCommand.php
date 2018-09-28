<?php

namespace App\Console\Commands;

use App\Xml\Output;
use App\Xml\Parser;
use App\Xml\ParserException;
use Illuminate\Console\Command;

/**
 * @author Afanasyev Pavel <bupyc9@gmail.com>
 */
class TotalTimeEventsCommand extends Command
{
    protected $signature = 'xml:parse:total_time_events {filePath} {num}';

    protected $description = 'Total time events by num';

    /**
     * @throws ParserException
     */
    public function handle(): void
    {
        $filePath = $this->argument('filePath');
        $num = $this->argument('num');

        $collection = Parser::parse($filePath);
        if (!$collection->has($num)) {
            throw new \RuntimeException('Not found output by `num`');
        }
        /** @var Output $output */
        $output = $collection[$num];
        $this->output->text($output->totalTimeEvents() . ' minutes');
    }
}