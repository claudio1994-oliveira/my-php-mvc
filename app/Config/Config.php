<?php

namespace App\Config;

class Config
{
    protected array $config = [];
    public function get(string $key, $default = null)
    {
        return dot($this->config)->get($key) ?? $default;
    }

    public function merge(array $config)
    {
        $this->config = array_merge_recursive($this->config, $config);

        return $this;
    }
}
