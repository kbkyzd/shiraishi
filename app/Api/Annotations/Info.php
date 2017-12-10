<?php

use Swagger\Annotations as SWG;

/*
 * @SWG\Swagger(
 *     @SWG\Info(
 *         title="Shiraishi",
 *         version="v1"
 *     ),
 *     schemes={"http"},
 *     host="localhost:8000",
 *     basePath="/api",
 *     produces={"application/x.shiraishi.v1+json"},
 *     consumes={"application/json"},
 *     @SWG\Definition(
 *         definition="Error",
 *         required={"code", "message"},
 *         @SWG\Property(
 *             property="code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     ),
 *
 * )
 */
