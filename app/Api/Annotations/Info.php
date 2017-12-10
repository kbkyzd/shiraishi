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
 *              "status_code": 401
 *         }
 *     ),
 * )
 */
