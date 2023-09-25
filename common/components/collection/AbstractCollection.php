<?php

namespace common\components\collection;

abstract class AbstractCollection implements \Iterator, \Countable, \JsonSerializable
{
    protected $data = [];

    #[\ReturnTypeWillChange]
    public function current()
    {
        return current($this->data);
    }

    #[\ReturnTypeWillChange]
    public function key()
    {
        return key($this->data);
    }

    public function next(): void
    {
        next($this->data);
    }

    public function rewind(): void
    {
        reset($this->data);
    }

    public function valid(): bool
    {
        return isset($this->data[key($this->data)]);
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function jsonSerialize(): array
    {
        return $this->data;
    }
}