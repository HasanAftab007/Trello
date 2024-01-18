@php
    $totalColumns = \App\Models\Column::count();
@endphp
<div class="flex gap-2">
    @for($column = 0; $totalColumns > $column ; $column++)
        <div class="flex flex-col gap-4 w-72 mt-5 ms-5">
            <div class="skeleton h-32 w-full"></div>
            <div class="skeleton h-8 w-full"></div>
            <div class="skeleton h-8 w-full"></div>
            <div class="skeleton h-8 w-full"></div>
            <div class="skeleton h-8 w-full"></div>
            <div class="skeleton h-8 w-full"></div>
            <div class="skeleton h-8 w-full"></div>
            <div class="skeleton h-8 w-full"></div>
        </div>
    @endfor
</div>
