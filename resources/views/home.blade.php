@extends('larabels::layouts.app')

@section('title')
    test
@endsection

@section('content')
    <form id="formLabels" action="{{ route('update') }}" method="POST" class="pb-10">
        @csrf
        @method('put')
        <v-tabs :tabs="{{ $locales->keys()->toJson() }}" v-slot:default="{ activeTab }">
            @foreach($locales as $locale => $files)
                <div v-show="activeTab === '{{ $locale }}'" class="flex flex-col md:flex-row flex-wrap -mx-3">
                    @foreach($files as $file => $items)
                        <div class="px-3 w-full mb-6">
                            <v-card title="{{ $file }}">
                                <ul>
                                    @foreach ($items as $item)
                                        @if ($item instanceof \Sandulat\Larabels\Domain\Label)
                                            @include('larabels::partials.label', ['label' => $item])
                                        @elseif($item instanceof \Sandulat\Larabels\Domain\Container)
                                            @include('larabels::partials.container', ['container' => $item])
                                        @endif
                                    @endforeach
                                </ul>
                            </v-card>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </v-tabs>
    </form>
    <div class="fixed bottom-0 text-center w-full left-0">
        <div class="bg-white w-auto inline-block p-1 border shadow rounded-t">
        <button onclick="event.preventDefault(); document.getElementById('formLabels').submit();" class="btn bg-green-200 border-green-400 text-green-900">
            Save
        </button>
        @if ($labelsHaveChanges)
            <form id="formReset" action="{{ route('commit') }}" method="POST"  class="inline-block mb-0">
                @csrf
                <button type="submit" class="btn bg-indigo-200 border-indigo-400 text-indigo-900">
                    Commit & Push
                </button>
            </form>
            <form id="formReset" action="{{ route('reset') }}" method="POST"  class="inline-block mb-0">
                @csrf
                <button type="submit" class="btn bg-pink-200 border-pink-400 text-pink-900">
                    Reset
                </button>
            </form>
        @endif
        </div>
    </div>
@endsection