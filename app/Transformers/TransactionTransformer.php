<?php

namespace App\Transformers;

use App\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
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
    public function transform(Transaction $transaction)
    {
        return [
            //
            'identifier' => (int) $transaction->id,
            'qty' => (int) $transaction->qty,
            'buyer' => (int) $transaction->buyer_id,
            'product' => (int) $transaction->product_id,

            'creationDate' =>  $transaction->created_at,
            'lastChange' => $transaction->updated_at,
            'deletedDate' => isset($transaction->deleted_at) ? (string) $transaction->deleted_at : null,


            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('transactions.show', $transaction->id),

                ],

                [
                    'rel' => 'product.categories',
                    'href' => route('transactions.categories.index', $transaction->id),

                ],

                [
                    'rel' => 'transaction.seller',
                    'href' => route('transactions.seller.index', $transaction->id),

                ],
                [
                    'rel' => 'buyer',
                    'href' => route('buyers.show', $transaction->buyer_id),

                ],
                [
                    'rel' => 'prduct',
                    'href' => route('products.show', $transaction->product_id),

                ],
            ]

        ];
    }

    public static function originalAttribute($index)
    {

        $attributes = [
            'identifier' => 'id',
            'qty' => 'qty',
            'buyer' => 'buyer_id',
            'product' => 'product_id',

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
            'qty' => 'qty',
            'buyer_id' => 'buyer',
            'product_id'  => 'product',
            'created_at'  => 'creationDate',
            'updated_at'  => 'lastChange',
            'deleted_at'  => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
