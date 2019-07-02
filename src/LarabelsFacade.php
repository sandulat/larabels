<?php

namespace Sandulat\Larabels;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sandulat\Larabels\Skeleton\SkeletonClass
 */
class LarabelsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'larabels';
    }
}
