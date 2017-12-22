<?php

namespace shiraishi\Api\Controllers\Auth;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Swagger\Annotations as SWG;
use Dingo\Blueprint\Annotation\Response;
use shiraishi\Http\Controllers\Controller;

class LoginController extends Controller
{
    use Helpers;

    /**
     * Generates a JWT token via given credentials.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     *
     * @SWG\Post(
     *     tags={"Authentication"},
     *     path="/auth/login",
     *     summary="Log in with given credentials",
     *     description="Generate a valid access token based on user credentials.",
     *     operationId="login",
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          required=true,
     *          @SWG\Schema(
     *              @SWG\Property(property="email", description="Email of the user"),
     *              @SWG\Property(property="password", description="Password of the user"),
     *              example={
     *                  "email": "mao@mao.mao",
     *                  "password": "changeme"
     *               }
     *          ),
     *      ),
     *     @SWG\Response(
     *          response=200,
     *          description="Login successful.",
     *          @SWG\Schema(
     *              @SWG\Property(property="access_token", description="JWT Access Token"),
     *              @SWG\Property(property="token_type", description="Bearer"),
     *              @SWG\Property(property="expires_in", description="Issued token expiry in minutes")
     *          ),
     *          examples={
     *              "application/json": {
     *                  "access_token": "JWT Token Here",
     *                  "token_type": "bearer",
     *                  "expires_in": 60
     *               }
     *          }
     *     ),
     *     @SWG\Response(response=401, description="Invalid credentials.")
     * )
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
     * Log the user out.
     *
     * User is "logged out" by invalidating the token.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *     tags={"Authentication"},
     *     path="/auth/logout",
     *     security={
     *         {"jwt": {}},
     *     },
     *     @SWG\Response(
     *         response=200,
     *         description="Token is blacklisted, user is *logged out*.",
     *         examples={
     *             "application/json": {
     *                 "message": "Token invalidated.",
     *                 "status_code": 200
     *             }
     *         }
     *     )
     * )
     */
    public function logout()
    {
        $this->guard()->logout();

        return $this->response->array([
            'message'     => 'Token invalidated.',
            'status_code' => 200,
        ]);
    }

    /**
     * Refresh a token.
     *
     * The current token included in the request is invalidated and a new fresh token is generated and returned.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *     tags={"Authentication"},
     *     path="/auth/refresh",
     *     security={
     *         {"jwt": {}},
     *     },
     *     @SWG\Response(
     *         response=200,
     *         description="A new token is generated, existing token included in the request is blacklisted.",
     *          @SWG\Schema(
     *              @SWG\Property(property="access_token", description="JWT Access Token"),
     *              @SWG\Property(property="token_type", description="Bearer"),
     *              @SWG\Property(property="expires_in", description="Issued token expiry in minutes")
     *          ),
     *          examples={
     *              "application/json": {
     *                  "access_token": "JWT Token Here",
     *                  "token_type": "bearer",
     *                  "expires_in": 60
     *               }
     *          }
     *     ),
     *     @SWG\Response(response=401, description="Invalid credentials.")
     * )
     */
    public function refresh()
    {
        return $this->response->array(
            $this->respondWithToken(
                $this->guard()->refresh()
            )
        );
    }

    /**
     * Get the currently authenticated user.
     *
     * @SWG\Get(
     *     tags={"Authentication"},
     *     path="/auth/me",
     *     security={
     *          {"jwt": {}},
     *     },
     *     @SWG\Response(response=200, description="Successful Operation"),
     *     @SWG\Response(response=401, description="Token has expired", @SWG\Schema(ref="#/definitions/TokenExpiry"))
     * )
     */
    public function me()
    {
        return $this->response->array($this->guard()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return array
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
        return auth('api');
    }
}
