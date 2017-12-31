<?php

namespace shiraishi\Api\Controllers;

use tsumugi\Foundation\Pagination;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Dingo\Api\Routing\Helpers as DingoHelpers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BaseApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, DingoHelpers, Pagination;
}
