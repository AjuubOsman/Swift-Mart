<x-app-layout>
    @if (session('message'))

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (session('message'))
                <div class="alert accent-green-500">{{ session('message') }}</div>
            @endif
        </h2>

    </x-slot>
@endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-wrap">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full sm:w-1/2">
                    <div class="max-w-xl">
                        @include('products.partials.products', ['products' => $products])
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full sm:w-1/2">
                    <div class="max-w-xl">
                        @include('products.partials.categories', ['categories' => $categories])
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full sm:w-1/2">
                    <div class="max-w-xl">
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full sm:w-1/2">
                    <div class="max-w-xl">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
