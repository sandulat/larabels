<li class="larabels-text-gray-800">
    <span class="larabels-bg-gray-500 larabels-text-white larabels-rounded larabels-px-1 larabels-py-1 larabels-border larabels-border-gray-500 larabels-text-sm larabels-capitalize">{{ $container->key() }}</span>
    @if(! empty($container->labels()))
        <ul class="larabels-mt-2 larabels-ml-8">
            @foreach ($container->labels() as $item)
                @include('larabels::partials.label', ['label' => $item])
            @endforeach
        </ul>
    @endif
    @if(! empty($container->containers()))
        <ul class="larabels-mt-3 larabels-ml-8">
            @foreach ($container->containers() as $item)
                @include('larabels::partials.container', ['container' => $item])
            @endforeach
        </ul>
    @endif
</li>
