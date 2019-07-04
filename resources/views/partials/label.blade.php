<li class="larabels-mb-2 larabels-text-gray-800 larabels-flex larabels-items-center larabels-relative">
    <span class="larabels-bg-gray-700 larabels-text-white larabels-rounded larabels-px-1 larabels-py-1 larabels-border larabels-border-gray-700 larabels-text-sm larabels-capitalize">{{ $label->key() }}</span>
    <input value="{{ $label->text() }}" name="{{ $label->slugForInput() }}" class="larabels-ml-2 larabels-border larabels-border-gray-400 larabels-rounded larabels-px-2 larabels-py-1 larabels-flex-grow larabels-text-sm">
</li>
