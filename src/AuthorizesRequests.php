<?php

declare(strict_types=1);

namespace Sandulat\Larabels;

use Closure;
use Illuminate\Http\Request;

/**
 * Credits: laravel/telescope.
 */
trait AuthorizesRequests
{
    /**
     * The callback that should be used to authenticate Larabels users.
     *
     * @var \Closure
     */
    public static $authUsing;

    /**
     * Register the Larabels authentication callback.
     *
     * @param  \Closure  $callback
     * @return static
     */
    public static function auth(Closure $callback): self
    {
        static::$authUsing = $callback;

        return new static;
    }

    /**
     * Determine if the given request can access the Larabels dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public static function check(Request $request): bool
    {
        return (static::$authUsing ?: function () {
            return app()->environment('local');
        })($request);
    }
}
