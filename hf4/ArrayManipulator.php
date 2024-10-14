<?php

class ArrayManipulator
{
    private $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function __get($key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }
        return null;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __isset($key)
    {
        return isset($this->data[$key]);
    }

    public function __unset($key)
    {
        if (isset($this->data[$key])) {
            unset($this->data[$key]);
        }
    }

    public function __toString()
    {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }

    public function __clone()
    {
        $this->data = array_map(function ($item) {
            return is_array($item) ? array_merge([], $item) : $item;
        }, $this->data);
    }
}
