<?php

namespace shiraishi\Http\Controllers\Auth;

use Dingo\Api\Routing\Helpers;
use Dingo\Blueprint\Annotation\Member;
use Dingo\Blueprint\Annotation\Method\Get;
use Dingo\Blueprint\Annotation\Method\Post;
use Dingo\Blueprint\Annotation\Resource;
use Dingo\Blueprint\Annotation\Response;
use Dingo\Blueprint\Annotation\Transaction;
use Illuminate\Http\Request;
use shiraishi\Http\Controllers\Controller;

/**
 * Besides `login` and `refresh`, you'll need to have a valid JWT token (aka authenticated).
 *
 * @Resource("Authentication", uri="/api/auth", requestHeaders={"Accept": "application/x.shiraishi.v1+json", "Authorization": "Bearer YourJwtToken"})
 */
class ApiController extends Controller
{
    use Helpers;

    /**
     * Generates a JWT token via given credentials
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse|void
     *
     * @Post("login")
     * @Transaction({
     *     @Request({"email": "mao@mao.mao", "password": "changeme"}, identifier="Login"),
     *     @Response(200, body={"access_token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiYWRtaW4iOnRydWV9.TJVA95OrM7E2cBab30RMHrHDcEfxjoYZgeFONFh7HgQ", "token_type": "Bearer", "expires_in": 3600})
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
     * Get the currently authenticated user
     *
     * @Get("/me")
     * @Request(identifier="Me")
     * @Response(200, body={"name": "Amatsuka Mao", "email": "mao@amatsuka.me"})
     */
    public function me()
    {
        return $this->response->array($this->guard()->user());
    }

    /**
     * Log the user out
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
            ));
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
        return auth('api');
    }
}
