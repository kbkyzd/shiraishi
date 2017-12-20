<?php

namespace tsumugi\Testing;

/** @codeCoverageIgnore */
trait DataStructures
{

    /**
     * @var array
     */
    protected $blacklistedToken = [
        'message'     => 'The token has been blacklisted',
        'status_code' => 401,
    ];

    /**
     * @var array
     */
    protected $accessTokenStructure = [
        'access_token',
        'token_type',
        'expires_in',
    ];

    protected $productStructure = [
        'data' => [
            '*' => [
                'merchant' => [
                    'id',
                    'name',
                ],
                'product'  => [
                    'id',
                    'name',
                    'description',
                    'price',
                ],
            ],
        ],
        'meta' => [
            'pagination' => [
                'total',
                'count',
                'per_page',
                'current_page',
                'total_pages',
                'links' => ['next'],
            ],
        ],
    ];
}
