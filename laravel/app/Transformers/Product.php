<?php

namespace App\Transformers;

use App\Models\Product as ProductModel;
use Flugg\Responder\Transformers\Transformer;

class Product extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param  ProductModel $product
     * @return array
     */
    public function transform(ProductModel $product)
    {
        return [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'weight' => number_format($product->getWeight(),4,',','.'),
            'price' => money_format("%n",$product->getPrice()),
            'photo' => url('/storage/') . '/' .  $product->getThumbnail(),
            'created_at' => $product->getCreatedAt('d/m/Y H:i'),
            'updated_at' => $product->getUpdatedAt('d/m/Y H:i'),
        ];
    }
}
