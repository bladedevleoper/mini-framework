<?php

namespace App\Library\Cache;

class Cache
{
    protected string $cachePath;
    protected bool $cacheEnabled;
    protected array $blocks = [];
}