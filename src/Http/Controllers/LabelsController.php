<?php

declare(strict_types=1);

namespace Sandulat\Larabels\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Routing\Controller;
use Sandulat\Larabels\Larabels;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class LabelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        abort_unless(config('larabels.enabled'), 404);

        return view('larabels::home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Sandulat\Larabels\Larabels $larabels
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Larabels $larabels, Request $request): RedirectResponse
    {
        collect($request->except(['_method', '_token']))->each(
            static function ($files, $locale) use ($larabels) {
                $larabels->exportLabels($locale, $files);
            }
        );

        return back()->with('success', __('Successfully updated.'));
    }
}
