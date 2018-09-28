<?php

namespace App\Xml;

/**
 * @author Afanasyev Pavel <bupyc9@gmail.com>
 */
class Stop
{
    /** @var int */
    private $id;

    /** @var string */
    private $time;

    /** @var string */
    private $name;

    public function __construct(int $id, string $time, string $name)
    {
        $this->id = $id;
        $this->time = $time;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function getName(): string
    {
        return $this->name;
    }
}