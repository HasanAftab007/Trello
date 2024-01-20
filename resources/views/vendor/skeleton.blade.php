@php
    $totalColumns = \App\Models\Column::count();
@endphp

<div class="flex gap-3">

    @foreach (\App\Models\Column::withCount('cards')->get() as $column)
        <div class="flex flex-col gap-4 w-72 mt-5 ms-5">
            <div class="skeleton h-32 w-full bg-black bg-opacity-50 backdrop-blur-md"></div>
            @for ($cardIndex = 0; $cardIndex < $column->cards_count; $cardIndex++)
                <div class="skeleton h-8 w-full bg-black bg-opacity-50 backdrop-blur-md"></div>
            @endfor
        </div>
    @endforeach

    @if($totalColumns === 0)
        <div class="skeleton h-10 w-64 ms-9 mt-4 bg-black bg-opacity-50 backdrop-blur-md"></div>
    @else
        <div class="skeleton h-10 w-64 mt-4 me-2 bg-black bg-opacity-50 backdrop-blur-md"></div>
    @endif

</div>
