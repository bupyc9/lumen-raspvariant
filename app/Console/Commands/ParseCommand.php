<?php

namespace App\Console\Commands;

use App\Xml\ParserException;
use Illuminate\Console\Command;
use App\Xml\Parser;

/**
 * @author Afanasyev Pavel <bupyc9@gmail.com>
 */
class ParseCommand extends Command
{
    protected $signature = 'xml:parse {filePath}';

    protected $description = 'Parsing xml';

    /**
     * @throws ParserException
     * @throws \InvalidArgumentException
     */
    public function handle(): void
    {
        $filePath = $this->argument('filePath');

        $collection = Parser::parse($filePath);
    }
}