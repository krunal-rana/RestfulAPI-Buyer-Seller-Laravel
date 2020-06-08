<?php

namespace App\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            //

            'identifier' => (int) $product->id,
            'title' => (string) $product->name,
            'details' => (string) $product->description,
            'stock' => (int) $product->qty,
            'status' => (string) $product->status,
            'pic' => url("img/$product->image"),
            'seller' => (int) $product->seller_id,
            'creationDate' =>  $product->created_at,
            'lastChange' => $product->updated_at,
            'deletedDate' => isset($product->deleted_at) ? (string) $product->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('products.show', $product->id),

                ],
                [
                    'rel' => 'product.buyers',
                    'href' => route('products.buyers.index', $product->id),

                ],
                [
                    'rel' => 'product.categories',
                    'href' => route('products.categories.index', $product->id),

                ],

                [
                    'rel' => 'product.transactions',
                    'href' => route('products.transactions.index', $product->id),

                ],
                [
                    'rel' => 'seller',
                    'href' => route('sellers.show', $product->seller_id),

                ],
            ]


        ];
    }

    public static function originalAttribute($index)
    {

        $attributes = [
            'identifier' => 'id',
            'title' => 'name',
            'details' => 'description',
            'qty' => 'qty',
            'status' => 'status',
            'pic' => 'image',
            'seller' => 'seller_id',

            'creationDate' => 'created_at',
            'lastChange' => 'updated_at',
            'deletedDate' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttributes($index)
    {

        $attributes = [
            'id' =>    'identifier',
            'name' => 'title',

            'description'  => 'details',
            'qty' => 'qty',
            'status' => 'status',
            'image'  => 'pic',
            'seller_id' =>  'seller',

            'created_at'  => 'creationDate',
            'updated_at'  => 'lastChange',
            'deleted_at'  => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}