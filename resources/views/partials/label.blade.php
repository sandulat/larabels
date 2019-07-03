<li class="mb-2 text-gray-800 flex items-center relative">
    <span class="bg-gray-700 text-white rounded px-1 py-1 border border-gray-700 text-sm capitalize">{{ $label->key() }}</span>
    <input value="{{ $label->text() }}" name="{{ $label->slugForInput() }}" class="ml-2 border border-gray-400 rounded px-2 py-1 flex-grow text-sm">
</li>