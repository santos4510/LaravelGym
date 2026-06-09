<div>
    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Please fill in the form to calculate your BMI.') }}
    </p>
    <form method="post" action="{{ route('profile.bmi.calculate') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <select id="gender" name="gender" class="mt-1 block w-full" required autofocus autocomplete="gender">
                <option value="male">{{ __('Male') }}</option>
                <option value="female">{{ __('Female') }}</option>
                <option value="other">{{ __('Other') }}</option>
            </select>       
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
            <x-text-input id="date_of_birth" name="date_of_birth" value="{{ $user->profile->date_of_birth }}" type="date" class="mt-1 block w-full" required autofocus autocomplete="date_of_birth" />
            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="height" :value="__('Height (cm)')" />
            <x-text-input id="height" name="height" value="{{ $user->profile->height }}" type="number" class="mt-1 block w-full" required autofocus autocomplete="height" />
            <x-input-error :messages="$errors->get('height')" class="mt-2" />
        </div>  

        <div>
            <x-input-label for="weight" :value="__('Weight (kg)')" />
            <x-text-input id="weight" name="weight" value="{{ $user->profile->weight }}" type="number" class="mt-1 block w-full" required autocomplete="weight" />
            <x-input-error :messages="$errors->get('weight')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Calculate BMI') }}</x-primary-button>
        </div>
        <div>
            @if ($user->profile->bmi)
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Your BMI is:') }} {{ $user->profile->bmi }}
                </p>
            @endif
        </div>
        <div>
            @if (session('status') === 'profile-deleted')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                    {{ __('Profile deleted successfully.') }}
                </p>
            @endif
        </div>
    </form>
</div>