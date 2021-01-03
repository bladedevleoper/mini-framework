<?php

namespace App\Interfaces;

interface CacheInterface
{
    public function cache($file);
    public function clearCache();
}
