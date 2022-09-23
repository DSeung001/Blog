<?php

namespace App\Observers;

use App\Models\product;
use App\Models\ProductHistory;


class ProductObserver
{
    private $productHistoy;

    public function __construct(ProductHistory $productHistory){
        $this->productHistoy = $productHistory;
    }

    /**
     * Handle the product "created" event.
     *
     * @param  \App\Models\product  $product
     * @return void
     */
    public function created(product $product)
    {
        $this->productHistoy->create([
           'type' => 'created',
           'content' => json_encode($product)
        ]);
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Models\product  $product
     * @return void
     */
    public function updated(product $product)
    {
        $this->productHistoy->create([
            'type' => 'updated',
            'content' => json_encode($product)
        ]);
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \App\Models\product  $product
     * @return void
     */
    public function deleted(product $product)
    {
        $this->productHistoy->create([
            'type' => 'deleted',
            'content' => json_encode($product)
        ]);
    }
}
