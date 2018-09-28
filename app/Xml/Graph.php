<?php

namespace App\Xml;

use Illuminate\Support\Collection;

/**
 * @author Afanasyev Pavel <bupyc9@gmail.com>
 */
class Graph
{
    /** @var int */
    private $num;

    /** @var int */
    private $smena;

    /** @var Collection */
    private $events;

    /**
     * Graph constructor.
     * @param int $num
     * @param int $smena
     */
    public function __construct(int $num, int $smena)
    {
        $this->num = $num;
        $this->smena = $smena;
        $this->events = collect([]);
    }

    public function getNum(): int
    {
        return $this->num;
    }

    public function getSmena(): int
    {
        return $this->smena;
    }

    public function addEvent(Event $event): self
    {
        $this->events->push($event);

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }
}