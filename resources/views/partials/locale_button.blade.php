<button
    class="larabels-locale @if ($loop->first) larabels-text-indigo-700 @else larabels-text-gray-700 @endif larabels-uppercase larabels-font-medium larabels-mb-4 larabels-py-1 larabels-mr-3"
    type="button"
    onclick="
        document.querySelectorAll('.larabels-locale').forEach(item => {
            if (item === event.target) {
                item.classList.remove('larabels-text-gray-700');
                item.classList.add('larabels-text-indigo-700');
            } else {
                item.classList.remove('larabels-text-indigo-700');
                item.classList.add('larabels-text-gray-700');
            }
        });
        document.querySelectorAll('[id^=larabels-locale-]').forEach(item => item.classList.add('larabels-hidden'));
        document.getElementById('larabels-locale-{{ $locale }}').classList.remove('larabels-hidden');
    "
>{{ $locale }}</button>
