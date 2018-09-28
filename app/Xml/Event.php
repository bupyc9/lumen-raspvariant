<?php

namespace App\Xml;

use Illuminate\Support\Collection;

/**
 * @author Afanasyev Pavel <bupyc9@gmail.com>
 */
class Event
{
    /** @var int */
    private $id;

    /** @var string */
    private $start;

    /** @var string */
    private $end;

    /** @var Collection */
    private $stops;

    public function __construct(int $id, string $start, string $end)
    {
        $this->id = $id;
        $this->start = $start;
        $this->end = $end;
        $this->stops = collect([]);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStart(): string
    {
        return $this->start;
    }

    public function getEnd(): string
    {
        return $this->end;
    }

    /**
     * @return Collection|Stop[]
     */
    public function getStops(): Collection
    {
        return $this->stops;
    }

    public function addStop(Stop $stop): self
    {
        $this->stops->push($stop);

        return $this;
    }
}