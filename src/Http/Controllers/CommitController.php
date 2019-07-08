<?php

declare(strict_types=1);

namespace Sandulat\Larabels\Http\Controllers;

use Cz\Git\GitException;
use Sandulat\Larabels\Larabels;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;

final class CommitController extends Controller
{
    /**
     * Commit the changes and push to repo.
     *
     * @param \Sandulat\Larabels\Larabels $larabels
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Larabels $larabels): RedirectResponse
    {
        try {
            $larabels->commit();
        } catch (GitException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', __('Successfully committed and pushed.'));
    }
}
