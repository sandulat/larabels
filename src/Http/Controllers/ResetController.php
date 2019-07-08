<?php

declare(strict_types=1);

namespace Sandulat\Larabels\Http\Controllers;

use Sandulat\Larabels\Larabels;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;

final class ResetController extends Controller
{
    /**
     * Resets the changes of localization files.
     *
     * @param \Sandulat\Larabels\Larabels $larabels
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Larabels $larabels): RedirectResponse
    {
        $larabels->checkoutLabels();

        return back()->with('success', __('Successfully reseted.'));
    }
}
