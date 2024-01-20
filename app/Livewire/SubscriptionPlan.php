<?php

namespace App\Livewire;

use App\Models\ProductPrice;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class SubscriptionPlan extends Component
{
    public $planName, $planId, $productId, $amount, $interval, $currency, $userName;

    public function mount() {
        $this->planName = '';
        $this->amount = '';
        $this->interval = '';
        $this->currency = '';
        $this->userName = '';
        $this->planId = '';
        $this->productId = '';
    }

    public function getPlan($planId) {
        $plan = ProductPrice::where('stripe_price_id', $planId)->first();
        $this->userName = auth()->user()->name;
        $this->planName = $plan->name;
        $this->amount = $plan->amount;
        $this->interval = $plan->interval;
        $this->currency = $plan->currency;
        $this->productid = $plan->product_id;
        $this->planId = $plan->stripe_price_id;
        $this->dispatch('show-modal');
    }

    public function render() {
        $userIntent = auth()->user()->createSetupIntent();
        $productPrices = ProductPrice::with('productPriceFeatures')->get();
        return view('livewire.subscription-plan', compact('productPrices', 'userIntent'));
    }

}
