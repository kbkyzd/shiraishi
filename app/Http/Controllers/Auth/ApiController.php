<?php

namespace shiraishi\Http\Controllers\Auth;

use Dingo\Api\Routing\Helpers;
use Dingo\Blueprint\Annotation\Method\Get;
use Dingo\Blueprint\Annotation\Parameter;
use Dingo\Blueprint\Annotation\Parameters;
use Dingo\Blueprint\Annotation\Resource;
use Dingo\Blueprint\Annotation\Transaction;
use Dingo\Blueprint\Annotation\Versions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use shiraishi\Http\Controllers\Controller;

/**
 * @Resource("Authentication", uri="/")
 */
class ApiController extends Controller
{
    use Helpers;

    /**
     * Generates a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @Get("login")
     * @Versions({"v1"})
     * @Parameters({
     *     @Parameter("email", type="string", required=true, description="Email of the user."),
     *     @Parameter("password", type="string", required=true, description="Password.")
     * })
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return $this->response->errorUnauthorized();
    }

    /**
     * Get user.
     *
     * Get the current authenticated user.
     *
     * @Post("/")
     * @Versions({"v1"})
     * @Request({"username": "foo", "password": "bar"})
     */
    public function me()
    {
        return $this->guard()->user();
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return [
            'message' => 'Logged out.',
        ];
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => $this->guard()->factory()->getTTL() * 60,
        ];
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }
}
