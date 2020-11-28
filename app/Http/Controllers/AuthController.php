<?php


namespace App\Http\Controllers;


use App\Events\UserLogin;
use App\Events\UserRegister;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Dingo\Api\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        /** @var User $user */
        if ($user = User::query()->create($request->all())) {
            event(new UserRegister($user));
        }

        return response()->json($user);
    }

    public function login(LoginRequest $request)
    {
        $user = User::query()->findByEmail($request->get('email'))->first();

        /** @var User $user */
        if (!$user->isConfirmed()) {
            return response()->json(['status' => false, 'message' => 'Email не подтвержден'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $credentials = $request->only(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['status' => false, 'message' => 'Неверный логин или пароль'], Response::HTTP_UNAUTHORIZED);
        }

        event(new UserLogin($user));

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['status' => false, 'message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken(string $token)
    {
        return response()->json([
            'status' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
