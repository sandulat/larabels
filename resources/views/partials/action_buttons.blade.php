<div class="larabels-text-center larabels-w-full larabels-left-0 larabels-pb-10">
    <div class="larabels-bg-white larabels-w-auto larabels-inline-block larabels-p-1 larabels-shadow larabels-rounded">
        <button onclick="document.getElementById('formLabels').submit();" class="larabels-btn larabels-bg-green-200 larabels-border-green-400 larabels-text-green-900">
            Save
        </button>
        @if ($larabels->labelsHaveChanges())
            <form id="formReset" action="{{ route('commit') }}" method="POST"  class="larabels-inline-block larabels-mb-0">
                @csrf
                <button type="submit" class="larabels-btn larabels-bg-indigo-200 larabels-border-indigo-400 larabels-text-indigo-900">
                    Commit & Push
                </button>
            </form>
            <form id="formReset" action="{{ route('reset') }}" method="POST"  class="larabels-inline-block larabels-mb-0">
                @csrf
                <button type="submit" class="larabels-btn larabels-bg-pink-200 larabels-border-pink-400 larabels-text-pink-900">
                    Reset
                </button>
            </form>
        @endif
    </div>
</div>
