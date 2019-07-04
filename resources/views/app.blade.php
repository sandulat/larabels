@inject('larabels', 'Sandulat\Larabels\Larabels')

<link rel="stylesheet" href="{{ asset(mix('larabels.css', 'vendor/larabels')) }}">
<div>
    <form id="formLabels" action="{{ route('update') }}" method="POST">
        @csrf
        @method('put')
        @foreach($larabels->labels()->keys() as $locale)
            @include('larabels::partials.locale_button')
        @endforeach
        @foreach($larabels->labels() as $locale => $files)
            <div id="larabels-locale-{{ $locale }}" class="@if (! $loop->first) larabels-hidden @endif larabels-flex larabels-flex-col md:larabels-flex-row larabels-flex-wrap larabels--mx-3">
                @foreach($files as $file => $items)
                    <div class="larabels-px-3 larabels-w-full larabels-mb-6">
                        @component('larabels::components.card', ['title' => $file])
                            <ul>
                                @foreach ($items as $item)
                                    @if ($item instanceof \Sandulat\Larabels\Domain\Label)
                                        @include('larabels::partials.label', ['label' => $item])
                                    @elseif($item instanceof \Sandulat\Larabels\Domain\Container)
                                        @include('larabels::partials.container', ['container' => $item])
                                    @endif
                                @endforeach
                            </ul>
                        @endcomponent
                    </div>
                @endforeach
            </div>
        @endforeach
    </form>
    @include('larabels::partials.action_buttons')
</div>
