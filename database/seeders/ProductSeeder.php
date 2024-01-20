<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\ProductPriceFeature;
use Illuminate\Database\Seeder;
use Stripe\StripeClient;

class ProductSeeder extends Seeder
{
    public function run(): void {

        $stripe = new StripeClient(config('services.stripe.stripe_secret'));
        $product = $stripe->products->retrieve('prod_PP4I0FBTmgawsm');
        $productPrices = $stripe->prices->all(['product' => $product->id]);

        $product = Product::create([
            'name' => $product->name,
            'stripe_product_id' => $product->id,
        ]);

        $planNames = ['Basic', 'Premium', 'Ultimate'];
        $planDescriptions = ["Simple and Affordable", "Powerful and Flexible", "Efficient and Cost-Effective"];


        $productPriceFeatures = [
            [
                [
                    'product_id' => $product->id,
                    'context' => 'Easy Tasks'
                ],
                [
                    'product_id' => $product->id,
                    'context' => "Quick Additions"
                ],
                [
                    'product_id' => $product->id,
                    'context' => "Effortless Sorting"
                ]
            ],
            [
                [
                    'product_id' => $product->id,
                    'context' => "Smart Reminders"
                ],
                [
                    'product_id' => $product->id,
                    'context' => "Seamless Collaboration"

                ],
                [
                    'product_id' => $product->id,
                    'context' => "User-Friendly Interface"

                ],
            ],
            [
                [
                    'product_id' => $product->id,
                    'context' => "Clear Prioritization"

                ],
                [
                    'product_id' => $product->id,
                    'context' => "Intuitive Navigation"

                ],
                [
                    'product_id' => $product->id,
                    'context' => "Customizable Categories"
                ]
            ],
        ];


        foreach ($productPrices as $index => $productPrice) {

            $productPrice = ProductPrice::create([
                'product_id' => $product->id,
                'stripe_price_id' => $productPrice->id,
                'name' => $planNames[$index],
                'currency' => $productPrice->currency,
                'interval' => $productPrice->recurring->interval,
                'type' => $productPrice->type,
                'amount' => $productPrice->unit_amount_decimal,
                'description' => $planDescriptions[$index],
            ]);

            foreach ($productPriceFeatures[$index] as $productPriceFeature) {
                ProductPriceFeature::create([
                    'product_id' => $productPriceFeature['product_id'],
                    'product_price_id' => $productPrice->id,
                    'context' => $productPriceFeature['context']
                ]);
            }

        }
    }
}
