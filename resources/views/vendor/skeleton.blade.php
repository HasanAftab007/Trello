@php
    $totalColumns = \App\Models\Column::count();
@endphp
<div class="flex gap-3">
    @for($column = 0; $totalColumns > $column ; $column++)
        <div class="flex flex-col gap-4 w-72 mt-5 ms-5">
            <div class="skeleton h-32 w-full bg-black bg-opacity-50 backdrop-blur-md"></div>
            <div class="skeleton h-8 w-full bg-black bg-opacity-50 backdrop-blur-md"></div>
            <div class="skeleton h-8 w-full bg-black bg-opacity-50 backdrop-blur-md"></div>
            <div class="skeleton h-8 w-full bg-black bg-opacity-50 backdrop-blur-md"></div>
            <div class="skeleton h-8 w-full bg-black bg-opacity-50 backdrop-blur-md"></div>
            <div class="skeleton h-8 w-full bg-black bg-opacity-50 backdrop-blur-md"></div>
            <div class="skeleton h-8 w-full bg-black bg-opacity-50 backdrop-blur-md"></div>
            <div class="skeleton h-8 w-full bg-black bg-opacity-50 backdrop-blur-md"></div>
        </div>
    @endfor
        <div class="skeleton h-8 w-64 mt-5 me-2 bg-black bg-opacity-50 backdrop-blur-md"></div>
</div>
