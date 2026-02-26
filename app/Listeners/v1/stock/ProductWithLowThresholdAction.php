<?php

namespace App\Listeners\v1\stock;


use App\Events\v1\stock\ProductWithLowThresholdEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ProductWithLowThresholdAction
{

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductWithLowThresholdEvent $event): void
    {
        $product_id = $event->product->id;
        $product_name = $event->product->name;
        $product_threshold = $event->product->low_stock_threshold;
        $product_quantity = $event->product->stock_quantity;
        Log::info("Product with id $product_id and name $product_name has low stock. Threshold: $product_threshold, Quantity: $product_quantity");
    }
}
