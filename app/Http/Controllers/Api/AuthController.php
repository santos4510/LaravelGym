<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResendRequest;
use App\Http\Requests\Auth\ResetRequest;
use App\Models\User;
use App\Services\UserAuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(private UserAuthService $userAuthService) {}

    /**
     * Register a new user account
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = $this->userAuthService->register(
                $request->email,
                $request->password,
                $request->name
            );

            return response()->json([
                'success' => true,
                'message' => 'Cuenta creada exitosamente. Por favor verifica tu email.',
                'user' => $user->only(['id', 'name', 'email'])
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la cuenta',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la cuenta'
            ], 500);
        }
    }

    /**
     * Login a user and return API token
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $token = $this->userAuthService->login(
                $request->email,
                $request->password
            );

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'success' => true,
                'message' => 'Inicio de sesión exitoso',
                'token_type' => 'Bearer',
                'access_token' => $token,
                'user' => $user->only(['id', 'name', 'email', 'email_verified_at', 'avatar'])
            ], 200);
        } catch (AuthenticationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al iniciar sesión'
            ], 500);
        }
    }

    /**
     * Refresh user token
     */
    public function refresh(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                throw new AuthenticationException('Usuario no autenticado');
            }

            return response()->json([
                'success' => true,
                'message' => 'Token renovado exitosamente',
                'token_type' => 'Bearer',
                'access_token' => $user->currentAccessToken()->token
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al renovar token'
            ], 401);
        }
    }

    /**
     * Logout user and revoke tokens
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            $this->userAuthService->logout($user);

            return response()->json([
                'success' => true,
                'message' => 'Sesión cerrada exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cerrar sesión'
            ], 500);
        }
    }

    /**
     * Send password reset link
     */
    public function forgot(ForgotRequest $request): JsonResponse
    {
        try {
            $status = $this->userAuthService->forgot($request->email);

            return response()->json([
                'success' => $status,
                'message' => $status 
                    ? 'Se envió un enlace de restablecimiento de contraseña a tu email'
                    : 'No pudimos enviar el enlace de restablecimiento'
            ], $status ? 200 : 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar tu solicitud'
            ], 500);
        }
    }

    /**
     * Reset password with token
     */
    public function reset(ResetRequest $request): JsonResponse
    {
        try {
            $status = $this->userAuthService->reset($request->all());

            return response()->json([
                'success' => $status,
                'message' => $status 
                    ? 'Contraseña restablecida exitosamente'
                    : 'Token inválido o expirado'
            ], $status ? 200 : 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al restablecer la contraseña'
            ], 500);
        }
    }

    /**
     * Verify email address
     */
    public function verify(string $id, string $hash): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            if (!hash_equals(
                $hash,
                sha1($user->getEmailForVerification())
            )) {
                return response()->json([
                    'success' => false,
                    'message' => 'Hash de verificación inválido'
                ], 422);
            }

            $this->userAuthService->verify($id);

            return response()->json([
                'success' => true,
                'message' => 'Email verificado exitosamente'
            ], 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al verificar email'
            ], 500);
        }
    }

    /**
     * Resend verification email
     */
    public function resend(ResendRequest $request): JsonResponse
    {
        try {
            $status = $this->userAuthService->resend($request->email);

            return response()->json([
                'success' => $status,
                'message' => $status
                    ? 'Email de verificación enviado'
                    : 'El email ya ha sido verificado'
            ], $status ? 200 : 422);
        } catch (ModelNotFoundException) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar email de verificación'
            ], 500);
        }
    }
}
