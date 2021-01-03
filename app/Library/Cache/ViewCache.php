<?php

namespace App\Library\Cache;

use App\Exceptions\CacheException;
use App\Interfaces\CacheInterface;

class ViewCache extends Cache implements CacheInterface
{

    protected $cachePath = 'cache/views';

    public function cache($file)
    {
        //TODO add caching job here
    }

    /**
     * Clear the cached files in $cachePath
     *
     * @return void
     */
    public function clearCache(): void
    {
        try {

            if (!isset($this->cachePath)) {
                throw new CacheException('$cachePath is not set in ' . __CLASS__);
            }

            foreach (glob($this->cachePath . '*') as $file) {
                unlink($file);
            }

        } catch (CacheException $e) {
            echo $e->getMessage();
            exit;
        }
    
    }
}