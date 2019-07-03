<li class="text-gray-800">
    <span class="bg-gray-500 text-white rounded px-1 py-1 border border-gray-500 text-sm capitalize">{{ $container->key() }}</span>
    @if(! empty($container->labels()))
        <ul class="mt-2 ml-8">
            @foreach ($container->labels() as $item)
                @include('larabels::partials.label', ['label' => $item])
            @endforeach
        </ul>
    @endif
    @if(! empty($container->containers()))
        <ul class="mt-3 ml-8">
            @foreach ($container->containers() as $item)
                @include('larabels::partials.container', ['container' => $item])
            @endforeach
        </ul>
    @endif
</li>