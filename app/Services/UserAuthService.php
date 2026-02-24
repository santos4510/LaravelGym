<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class UserAuthService
{
    /**
     * Register a new user with email and password
     *
     * @param string $email
     * @param string $password
     * @param string $name
     * @return User
     * @throws ValidationException
     */
    public function register(string $email, string $password, string $name): User
    {
        // Validate email doesn't already exist
        if (User::where('email', $email)->exists()) {
            throw ValidationException::withMessages([
                'email' => 'El email ya está registrado.',
            ]);
        }

        $user = User::create([
            'email' => $email,
            'name' => $name,
            'password' => Hash::make($password),
            'email_verified_at' => null,
        ]);

        event(new Registered($user));

        return $user;
    }

    /**
     * Authenticate a user and generate API token
     *
     * @param string $email
     * @param string $password
     * @return string The API token
     * @throws AuthenticationException
     */
    public function login(string $email, string $password): string
    {
        try {
            $user = User::where('email', $email)->firstOrFail();
        } catch (ModelNotFoundException) {
            throw new AuthenticationException("Las credenciales no coinciden con nuestros registros.");
        }

        if (!Hash::check($password, $user->password)) {
            throw new AuthenticationException("Las credenciales no coinciden con nuestros registros.");
        }

        // Revoke previous tokens for security
        $user->tokens()->delete();

        // Create a new token with expiration for better security
        $token = $user->createToken(
            'api-token',
            ['*'],
            now()->addDays(7) // Token expires in 7 days
        )->plainTextToken;

        return $token;
    }

    /**
     * Logout user by revoking all tokens
     *
     * @param User $user
     * @return bool
     */
    public function logout(User $user): bool
    {
        return (bool) $user->tokens()->delete();
    }

    public function forgot(string $email): bool
    {
        try {
            $status = Password::sendResetLink(['email' => $email]);
            return $status === Password::RESET_LINK_SENT;
        } catch (ModelNotFoundException) {
            // Don't reveal if email exists for security
            return false;
        }
    }

    /**
     * Reset user password
     *
     * @param array $credentials
     * @return bool
     */
    public function reset(array $credentials = []): bool
    {
        $status = Password::reset(
            collect($credentials)
                ->only(['email', 'password', 'password_confirmation', 'token'])
                ->toArray(),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET;
    }

    /**
     * Verify email address
     *
     * @param string $id User ID
     * @return bool
     * @throws ModelNotFoundException
     */
    public function verify(string $id): bool
    {
        $user = User::findOrFail($id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return true;
    }

    /**
     * Resend email verification
     *
     * @param string $email
     * @return bool
     * @throws ModelNotFoundException
     */
    public function resend(string $email): bool
    {
        $user = User::where('email', $email)->firstOrFail();

        if ($user->hasVerifiedEmail()) {
            return false;
        }

        $user->sendEmailVerificationNotification();

        return true;
    }
}
