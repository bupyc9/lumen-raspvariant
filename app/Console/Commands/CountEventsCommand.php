<?php

namespace App\Console\Commands;

use App\Xml\Output;
use App\Xml\Parser;
use App\Xml\ParserException;
use Illuminate\Console\Command;

/**
 * @author Afanasyev Pavel <bupyc9@gmail.com>
 */
class CountEventsCommand extends Command
{
    protected $signature = 'xml:parse:count_events {filePath} {num}';

    protected $description = 'Count events by num';

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
        $this->output->text($output->countEvents());
    }
}