<?php

declare(strict_types=1);

namespace Sandulat\Larabels;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sandulat\Larabels\Skeleton\SkeletonClass
 */
final class LarabelsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'larabels';
    }
}
