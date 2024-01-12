<div>
    <div class="flex justify-start mt-3 ">

        {{--All Columns--}}
        <div class="ms-5 flex justify-start gap-5" x-data="{ columnTitleInputs: @js($columnTitleInputs) }">
            @foreach($columns as $column)
                <div class="w-72 bg-black rounded-lg py-3 max-h-full"
                     wire:key="{{$column->id}}"
                     @keydown.esc.window="columnTitleInputs[{{$column->id}}] = false"
                >
                    {{--Column Management--}}
                    <div class="flex justify-between items-center px-4  hover:cursor-pointer"
                         wire:keydown.enter.window="editColumnTitle({{$column->id}})"
                    >
                        <h3 x-show="!columnTitleInputs[{{$column->id}}]"
                            class="text-lg text-slate-400 font-extrabold w-full "
                            x-on:click=
                                "
                                $nextTick
                                (
                                () => columnTitleInputs[{{$column->id}}] && $refs['columnTitleInput_' + {{$column->id}}].focus()
                                )
                                    $wire.setFocusedColumn({{$column->id}});
                                    columnTitleInputs[{{$column->id}}] = !columnTitleInputs[{{$column->id}}];
                                "
                        >
                            {{$column->title}}
                        </h3>
                        <div x-show="columnTitleInputs[{{$column->id}}]"
                             x-on:hide-column-edit-div.window=
                                 "
                                    columnTitleInputs[{{$column->id}}] = false
                                 "
                             class="flex justify-start items-center gap-2" x-cloak
                        >
                            <input type="text" placeholder="Enter new title..." autofocus
                                   wire:model="columnTitleInput" id="column-title-input-field"
                                   class=
                                       "py-2 bg-gray-800 rounded-md my-0
                                        @error('columnTitleInput') border-red-700 @enderror
                                        "
                                   x-ref="columnTitleInput_{{$column->id}}"
                            />
                            @error('columnTitleInput') <span class="text-red-600 text-sm">{{$message}} </span> @enderror
                            <div
                                class="close-btn px-2 py-2 bg-gray-700 font-bold rounded-md hover:bg-gray-900 hover:cursor-pointer"
                                x-on:click="columnTitleInputs[{{$column->id}}] = false"
                            >
                                X
                            </div>
                        </div>
                        <i x-show="!columnTitleInputs[{{$column->id}}]"
                           class="fa-solid fa-trash text-lg text-slate-400 hover:cursor-pointer hover:text-red-700 ms-2"
                           onclick="{{str_replace(' ', '', $column->title)}}.showModal()">
                        </i>
                    </div>

                    {{--Card Management--}}
                    <div class="card-management flex flex-col gap-2 h-full">

                        <div x-data="{cardDisplay: @js($columnCardIds)}"
                        @foreach($column->cards as $card)
                            <div x-show="!cardDisplay[{{$card->id}}]"
                                 x-on:card-input-title-field.window="cardDisplay[{{$card->id}}] = false"
                                 class="card-title-block flex justify-between ps-3 w-64 ms-4 rounded-md mt-2 py-2 bg-gray-800 hover:bg-black hover:cursor-pointer">
                                <p class="font-bold">{{$card->title}}</p>
                                <i class="fa-solid fa-pen-to-square me-2 hover:bg-slate-600 rounded-xl p-1 opacity-30 hover:opacity-80"
                                   x-on:click="cardDisplay[{{$card->id}}] = true;
                                   $wire.cardTitleId = {{$card->id}};
                                   $nextTick(()=> { cardDisplay[{{$card->id}}] && $refs['cardDisplay_' + {{$card->id}}].focus()});"
                                ></i>
                            </div>

                            <div class="card-title-change" x-show="cardDisplay[{{$card->id}}]" x-cloak>
                                <input class="bg-gray-800 py-2 ms-4 mt-1 ps-3 w-64 rounded-md border-none"
                                       wire:model="cardTitle"
                                       x-on:keydown.enter.window="
                                        if (cardDisplay[{{$card->id}}])
                                       { $wire.editCardTitle( {{$column->id}}, {{$card->id}} ) } "
                                       placeholder="Change card title name..." x-ref="cardDisplay_{{$card->id}}"
                                       x-on:click.outside="cardDisplay[{{$card->id}}] = false"
                                >
                            </div>
                        @endforeach
                    </div>

                    <div x-data="{openCard:false}" class="card-button mx-auto bg-black mt-auto mb-6 rounded-md">
                        <div x-show="!openCard"
                             x-on:click="openCard = true;
                             $nextTick(()=>{ openCard && $refs.newCardButton.focus() });"
                             class=" hover:cursor-pointer hover:bg-gray-800 w-60 py-2 rounded-lg flex justify-start gap-2 items-center">
                            <i class="fa-solid fa-plus text-slate-300 ms-3"></i>
                            <p class="px-2 font-bold">Add a card</p>
                        </div>

                        <div x-show="openCard" class="column-card-title mb-2 rounded-md" x-cloak
                             x-on:keydown.enter="$wire.createCardTitle({{$column->id}});
                             openCard = false;
                             "
                        >
                            <input class="p-2 w-60 bg-gray-800 ms-2 me-2 rounded-md
                                    @error('cardTitle') text-red-600 @enderror"
                                   x-ref="newCardButton"
                                   x-on:click.outside="openCard = false"
                                   placeholder="Enter card title here..." wire:model="cardTitle">
                            @error('cardTitle') <span
                                class="text-red-600 text-md ms-2">{{$message}}</span> @enderror
                            <div class="flex gap-2 justify-start items-center mt-2 ms-2">
                                <button type="button" wire:click.prevent="createCardTitle({{$column->id}})"
                                        class="p-2 bg-sky-600 text-black rounded-md font-medium hover:bg-sky-800"
                                >
                                    Add Card
                                </button>
                                <button type="button" x-on:click="openCard = false" wire:loading.attr="disabled">
                                    <i class="fa-solid fa-x text-slate-300 font-extrabold hover:bg-gray-800 p-3 rounded-md"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>

        </div>

        {{--Delete Column Modal--}}
        <dialog id="{{str_replace(' ', '', $column->title)}}" class="modal">
            <div class="modal-box">
                <h3 class="font-extrabold text-xl text-center mt-2">Are you sure you want to delete this
                    column?</h3>
                <p class="py-4 text-red-600 text-extrabold text-center text-lg">Warning! Everything will be
                    deleted
                </p>
                <div class="flex justify-center gap-5">
                    <button class="btn" wire:click="deleteColumn('{{$column->id}}')">
                        Delete
                    </button>
                    <div class="modal-action m-0">
                        <form method="dialog">
                            <button class="btn">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </dialog>
        @endforeach
    </div>

    {{--Add Column Element--}}
    <div x-data="{open:false}" class="w-64 ms-5 text-center ">
        <div x-show="!open" x-on:click="open = !open"
             @keydown.window.escape=
                 "
             open = false;
             $dispatch('reset-field')
                "
             class="flex justify-start items-center gap-2 ps-4 list-column py-2 rounded-xl bg-gray-800 bg-opacity-60  backdrop-blur-sm hover:bg-black hover:bg-opacity-65 hover:cursor-pointer">
            <i class="fa-solid fa-plus text-slate-300"></i>
            <p class="text-slate-300 font-bold"> Add column here </p>
        </div>
        <div x-show="open" class="column-card w-full bg-black rounded-lg py-3 px-3" x-cloak
             x-on:click.outside="open=false"
             x-on:keydown.window.escape="open = false"
             x-on:hide-column-creation-form.window="open = false"
             x-on:keydown.window.enter="createColumn"
        >
            <input type="text" placeholder="Enter column title..." wire:model="columnTitle" id="column-input-field"
                   class=
                       "input input-bordered input-info w-full
                        @error('columnTitle') border-red-700 @enderror"
            />
            @error('columnTitle') <span class="text-red-600 text-sm">{{$message}} </span> @enderror
            <div class="flex gap-3 justify-start items-center mt-2">
                <button type="button" wire:click.prevent="createColumn"
                        class="p-2 bg-sky-600 text-black rounded-md font-medium hover:bg-sky-800">
                    Create column
                </button>
                <button type="button" x-on:click="open = !open" wire:loading.attr="disabled">
                    <i class="fa-solid fa-x text-slate-300 font-extrabold hover:bg-gray-800 p-3 rounded-md"></i>
                </button>
            </div>
        </div>
    </div>
</div>
