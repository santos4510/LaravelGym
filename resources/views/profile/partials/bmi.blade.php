<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('IMC') }}
        </h2>
        
    </header>

        <div>
            @if ($user->profile->bmi)
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ $user->profile->bmi }}
                </p>
                <form method="post" action="{{ route('profile.bmi.clear') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('post')
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Recalculate BMI') }}</x-primary-button>
                    </div>
                </form>
            @else
                @include('profile.partials.calculate-bmi-form')   
            @endif
        </div>
</section>
