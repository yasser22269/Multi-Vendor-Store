<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <x-alert></x-alert>

    <form method="post" action="{{ route('dashboard.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="first_name" value="First Name" />
            <x-text-input  name="first_name" type="text"
                          class="form-control"
                          :value="old('first_name', $user->first_name)"
                          required autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-input-label for="last_name" value="Last Name" />
            <x-text-input  name="last_name" type="text"
                          class="form-control"
                          :value="old('last_name', $user->last_name)"
                          required autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-input-label for="birthday" value="Birthday" />
            <x-text-input  name="birthday" type="date"
                          class="form-control"
                          :value="old('birthday', $user->birthday)"
                          required autocomplete="birthday" />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <div>
            <x-form.radio  name="gender" :checked="$user->gender" label="Gender" :options="['male'=>'Male','female'=>'Female']" />
            <x-input-error class="mt-2"  :messages="$errors->get('gender')" />
        </div>
        <div>
            <x-input-label for="street_address" value="Street Address" />
            <x-text-input  name="street_address" type="text"
                           class="form-control"
                           :value="old('street_address', $user->street_address)"
                           required autocomplete="street_address" />
            <x-input-error class="mt-2" :messages="$errors->get('street_address')" />
        </div>
        <div>
            <x-input-label for="city" value="City" />
            <x-text-input  name="city" type="text"
                           class="form-control"
                           :value="old('city', $user->city)"
                           required autocomplete="city" />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>
        <div>
            <x-input-label for="state" value="State" />
            <x-text-input  name="state" type="text"
                           class="form-control"
                           :value="old('state', $user->state)"
                           required autocomplete="state" />
            <x-input-error class="mt-2" :messages="$errors->get('state')" />
        </div>
        <div>
            <x-input-label for="postal_code" value="Postal Code" />
            <x-text-input  name="postal_code" type="text"
                           class="form-control"
                           :value="old('postal_code', $user->postal_code)"
                           required autocomplete="postal_code" />
            <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
        </div>

        <div>
            <x-form.select :selected="$user->country"  class="form-control" name="country" :options="$countries" label="Country" :selected="$user->country" />

            <x-input-error class="mt-2" :messages="$errors->get('country')" />
        </div>

        <div>
            <x-form.select :selected="$user->locale"  class="form-control" name="Locale" :options="$locales" label="Locale" :selected="$user->locale" />
            <x-input-error class="mt-2" :messages="$errors->get('locale')" />
        </div>
        <br>

        <div class="flex items-center gap-4">
{{--            <x-primary-button>{{ __('Save') }}</x-primary-button>--}}
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="btn-primary"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
