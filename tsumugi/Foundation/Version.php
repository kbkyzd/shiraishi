<?php

namespace tsumugi\Foundation;

use Closure;
use Illuminate\Support\Facades\Cache;

class Version
{
    /**
     * @return string
     */
    public function revision()
    {
        return $this->gitCache('version:current-revision', function () {
            return trim(shell_exec('git rev-list --count HEAD'));
        });
    }

    /**
     * @return string
     */
    public function hash()
    {
        return $this->gitCache('version:current-hash', function () {
            return shell_exec('git rev-parse --short HEAD');
        });
    }

    /**
     * @return bool
     */
    public function isClean()
    {
        return $this->gitCache('version:current-state', function () {
            $porcelain = shell_exec('git status --porcelain');

            if ($porcelain) {
                return false;
            }

            return true;
        });
    }

    /**
     * @param          $tag
     * @param \Closure $callback
     * @return mixed
     */
    protected function gitCache($tag, Closure $callback)
    {
        return Cache::remember($tag, 60, $callback);
    }
}
