<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Shipping Information') }}
        </h2>
        @if (session('message'))
            <div  class="alert accent-green-500">{{ session('message') }}</div>
        @endif

    </header>

    <form method="post" action="{{ route('shipping.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label :value="__('Street Name')" />
            <x-text-input  name="street" type="text" class="mt-1 block w-full"  :value="old('name', $user->street)" />
            <x-input-error :messages="$errors->updateStreet->get('street')" class="mt-2" />
        </div>

        <div>
            <x-input-label :value="__('City')" />
            <x-text-input  name="city" type="text" class="mt-1 block w-full"  :value="old('name', $user->city)" />
            <x-input-error :messages="$errors->updateCity->get('city')" class="mt-2" />
        </div>

        <div>
            <x-input-label :value="__('Zipcode')" />
            <x-text-input name="zipcode" type="text" class="mt-1 block w-full"  :value="old('name', $user->zipcode)" />
            <x-input-error :messages="$errors->updateZipcode->get('zipcode')" class="mt-2" />
        </div>
        <div>
            <x-input-label  :value="__('Country')" />
            <x-text-input  name="country" type="text" class="mt-1 block w-full" :value="old('name', $user->country)" />
            <x-input-error :messages="$errors->updateCountry->get('country')" class="mt-2" />
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
