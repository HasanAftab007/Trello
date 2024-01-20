<div>

    <x-slot name="header">
        <h3 class="font-extrabold text-xl text-slate-50 leading-tight">
            Subscription Pricing
        </h3>
    </x-slot>

    <div class="mx-auto pb-5 mt-6 max-w-7xl lg:px-8">

        <div class="mx-auto max-w-xl text-center bg-black py-3 rounded-lg">
            <p class="text-xl font-bold tracking-tight text-white sm:text-3xl">
                Get your plan to access all the features.
            </p>
        </div>

        <div class="isolate mx-auto mt-8 grid max-w-md grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">

            @foreach($productPrices as $productPrice)
                <div
                    class="transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-110 duration-300 rounded-3xl p-8 xl:p-10 bg-black">

                    <div class="flex items-center gap-x-4">
                        <h2 id="product1"
                            class="text-xl font-extrabold leading-8 text-white">{{$productPrice->name}}</h2> <i
                            class="fa-brands fa-medium"></i>
                    </div>

                    <p class="mt-4 text-sm font-bold leading-6 text-gray-300">{{$productPrice->description}}</p>

                    <p class="mt-6 flex items-baseline gap-x-1">
                        <span
                            class="text-4xl font-bold tracking-tight text-white">Rs. {{$productPrice->amount}} / {{$productPrice->interval}}</span><span
                            class="text-sm font-semibold leading-6 text-gray-300"></span>
                    </p>

                    <a id="card-button"
                       type="button"
                       data-value="button"
                       class="bg-white text-md hover:ring-2 hover:ring-white  text-black hover:bg-black focus-visible:outline-white hover:text-white mt-6 block rounded-md py-2 px-3 text-center font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 hover:cursor-pointer"
                       data-secret="{{$userIntent->client_secret}}"
                       wire:click=
                           "
                                 getPlan('{{$productPrice->stripe_price_id}}')
                           "
                       onclick=
                           "
                                $(function() {

                                    function disableButton(value){
                                    $(this).prop('disabled', value);
                                    }

                                    disableButton(true);

                                    Livewire.on('show-modal', () => {

                                      var checkoutModal = $('#checkout-modal')[0];

                                      checkoutModal.showModal();
                                      setTimeout(function () {
                                          Livewire.dispatch('displayPaymentIntentField')
                                      }, 500);

                                    disableButton(false);

                                    });
                                });
                            "
                    >
                        Subscribe Now
                    </a>

                    <ul role="list" class="text-sm leading-6 text-gray-300 xl:mt-5">

                        @foreach($productPrice->productPriceFeatures as $feature)
                            <li class="flex gap-x-3 items-center">
                                <i class="fa-solid fa-check text-md"></i>
                                <span class="font-bold">{{$feature->context}}</span>
                            </li>
                        @endforeach

                    </ul>

                </div>

            @endforeach

            <dialog id="checkout-modal" class="modal" wire:ignore.self>
                <div class="modal-box ring-2 ring-white max-w-2xl bg-black">

                    <h1 class="text-center text-white text-3xl font-extrabold">CHECKOUT</h1>

                    <div class="flex justify-center h-full">

                        <form id="subscription-form" action="{{route('plan-subscription')}}" method="POST">

                            @csrf

                            <div id="parent-div" class="flex flex-col w-80 gap-3 mt-5">

                                <input type="hidden" value="{{$userName}}" id="card-holder-name">
                                <input type="hidden" value="{{$planId}}" name="plan_price_id" id="card-holder-name">

                                <div class="input-fields flex flex-col gap-5">
                                    <input type="text" name="plan_name" value="{{$planName}}"
                                           class="input input-bordered ring-2 ring-white " disabled/>

                                    <input type="number" name="amount" value="{{$amount}}"
                                           class="input input-bordered ring-2 ring-white" disabled/>

                                    <input type="text" name="currency" value="{{$currency}}"
                                           class="input input-bordered ring-2 ring-white" disabled/>

                                    <input type="text" name="interval" value="{{$interval}}"
                                           class="input input-bordered ring-2 ring-white" disabled/>
                                </div>

                                <div id="card-element" class="mt-2 text-white font-bold"></div>

                                <div id="card-errors" class="text-black mt-1"></div>

                                <button type="submit" id="checkout-submit-btn"
                                        class="px-40 py-2 flex justify-center items-center text-center bg-white text-black text-xl font-extrabold hover:bg-black hover:text-white">
                                    <span>GET</span>
                                </button>

                            </div>

                        </form>

                    </div>
                </div>
            </dialog>

        </div>
    </div>
</div>
