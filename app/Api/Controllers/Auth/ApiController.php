<?php

namespace shiraishi\Api\Controllers\Auth;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Swagger\Annotations as SWG;
use Dingo\Blueprint\Annotation\Response;
use Dingo\Blueprint\Annotation\Method\Get;
use shiraishi\Http\Controllers\Controller;
use Dingo\Blueprint\Annotation\Method\Post;

class ApiController extends Controller
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
     *          in="query",
     *          name="email",
     *          description="Email of the user.",
     *          required=true,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          in="query",
     *          name="password",
     *          description="Password of the user.",
     *          required=true,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          required=true,
     *          @SWG\Schema(
     *              @SWG\Property(property="email", description="JWT Access Token"),
     *              @SWG\Property(property="password", description="Bearer"),
     *          )
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
     *     )
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
     * Get the currently authenticated user.
     *
     * @SWG\Get(
     *     path="/auth/me",
     *     security={
     *          {"jwt": {}},
     *     },
     *     @SWG\Response(response=200, description="Authenticated")
     * )
     */
    public function me()
    {
        return $this->response->array($this->guard()->user());
    }

    /**
     * Log the user out.
     *
     * User is "logged out" by invalidating the token.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @Post("/logout")
     * @Request(identifier="Logout")
     * @Response(200, body={"message": "Token invalidated"})
     */
    public function logout()
    {
        $this->guard()->logout();

        $this->response->array([
            'message' => 'Token invalidated.',
        ]);
    }

    /**
     * Refresh a token.
     *
     * The current token included in the request is invalidated and a new fresh token is generated and returned.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @Post("/refresh")
     * @Request(identifier="Refresh")
     * @Response(200, body={"access_token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiYWRtaW4iOnRydWV9.TJVA95OrM7E2cBab30RMHrHDcEfxjoYZgeFONFh7HgQ", "token_type": "Bearer", "expires_in": 3600})
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
     * Get the token array structure.
     *
     * @param string $token
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
        return auth('api');
    }
}
