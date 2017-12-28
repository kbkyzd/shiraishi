<?php

use Swagger\Annotations as SWG;

/**
 * @SWG\Swagger(
 *     @SWG\Info(
 *         title="Shiraishi",
 *         version="v1"
 *     ),
 *     schemes={SWAGGER_SCHEME},
 *     host=SWAGGER_HOST,
 *     basePath="/api",
 *     produces={"application/x.shiraishi.v1+json"},
 *     consumes={"application/json"},
 *     @SWG\Definition(
 *         definition="Error",
 *         required={"message", "status_code"},
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         ),
 *         @SWG\Property(
 *             property="status_code",
 *             type="integer",
 *             format="int32"
 *         )
 *     ),
 *     @SWG\Definition(
 *         definition="TokenExpiry",
 *         required={"message", "status_code"},
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         ),
 *         @SWG\Property(
 *             property="status_code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         example={
 *             "message": "Token has expired",
 *             "status_code": 401
 *         }
 *     ),
 *     @SWG\Definition(
 *         definition="Paginator",
 *         @SWG\Property(
 *             property="total",
 *             type="integer",
 *         ),
 *         @SWG\Property(
 *             property="count",
 *             type="integer",
 *         ),
 *         @SWG\Property(
 *             property="per_page",
 *             type="integer",
 *         ),
 *         @SWG\Property(
 *             property="current_page",
 *             type="integer",
 *         ),
 *         @SWG\Property(
 *             property="total_pages",
 *             type="integer",
 *         )
 *     ),
 *     @SWG\Definition(
 *         definition="ChatUser",
 *         @SWG\Property(property="id", type="integer"),
 *         @SWG\Property(property="name", type="string"),
 *         @SWG\Property(property="email", type="string")
 *     ),
 *     @SWG\Definition(
 *         definition="MetaExample",
 *         example={
 *             "meta": {
 *                 "pagination": {
 *                     "total": 1,
 *                     "count": 1,
 *                     "per_page": 5,
 *                     "current_page": 1,
 *                     "total_pages": 1,
 *                     "links": {
 *                          {
 *                              "prev": "http://localhost:8000/api/chat/1?page=3",
 *                              "next": "http://localhost:8000/api/chat/1?page=5"
 *                          }
 *                     }
 *                  }
 *             }
 *         }
 *     )
 * )
 */
