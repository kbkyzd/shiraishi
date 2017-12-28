<?php

use Swagger\Annotations as SWG;

/**
 * @SWG\Get(
 *     tags={"Chat"},
 *     path="/chat",
 *     security={{"jwt": {}}},
 *     @SWG\Response(
 *         response=200,
 *         description="Successful Operation",
 *         @SWG\Schema(
 *             @SWG\Property(property="data",
 *                 @SWG\Property(property="ident", type="string"),
 *                 @SWG\Property(property="last_activity", type="string"),
 *                 @SWG\Property(property="participants",
 *                     @SWG\Property(property="data", ref="#/definitions/ChatUser")
 *                 ),
 *             ),
 *             @SWG\Property(property="meta", ref="#/definitions/Paginator")
 *         ),
 *         examples={
 *             "application/json": {
 *                 "data": {
 *                     {
 *                          "ident": "mao@m.m:thomas@t.t",
 *                          "last_activity": "2017-12-28 18:38:37",
 *                          "participants": {
 *                              "data": {
 *                                  "id": 1,
 *                                  "name": "Amatsuka Mao",
 *                                  "email": "mao@m.m",
 *                              }
 *                          }
 *                     }
 *                 },
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
 *             }
 *         }
 *     ),
 * )
 */
