<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
    * Calculate the user's BMI.
    */
    public function calculateBmi(Request $request): RedirectResponse
    {
        $request->validate([
            'height' => ['required', 'numeric', 'min:0'],
            'weight' => ['required', 'numeric', 'min:0'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required'],
        ]);

    
        $heightInMeters = $request->input('height') / 100;
        $weightInKg = $request->input('weight');
        $bmi = $weightInKg / ($heightInMeters * $heightInMeters);

        $profile = $request->user()->profile;
        $profile->height = $request->input('height');
        $profile->weight = $request->input('weight');
        $profile->bmi = $bmi;
        $profile->date_of_birth = $request->input('date_of_birth');
        $profile->gender = $request->input('gender');
        $profile->save();

        return Redirect::route('profile.edit')->with('bmi', $bmi);
    } 

     /**
    * Clear the user's BMI.
    */
    public function clearBmi(Request $request): RedirectResponse
    {
        $profile = $request->user()->profile;
        $profile->bmi = null;
        $profile->save();

        return Redirect::route('profile.edit')->with('status', 'bmi-cleared');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
