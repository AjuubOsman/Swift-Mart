@php
    $products = session('products');
@endphp

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
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                @foreach($products as $product)
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full">
                        <div class="max-w-xl">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Name: {{ $product->name }}</h3>
                                <h3 class="text-lg font-semibold text-gray-900">Description: {{ $product->description }}</h3>
                                <p class="text-lg font-semibold text-gray-900">Price: {{ str_replace('.', ',', $product->price) }} €</p>
                                <p class="text-lg font-semibold text-gray-900">Inventory: {{ $product->inventory }}</p>
                                <p class="text-lg font-semibold text-gray-900">Category: {{ $product->categories->name }}</p>
                            </div>
                        </div>
                        <form action="{{ route('cart.add')}}" method="POST">
                            @csrf
                            @method('POST')
                            <!-- Hidden inputs to include all necessary data -->
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_name" value="{{ $product->name }}">
                            <input type="hidden" name="product_description" value="{{ $product->description }}">
                            <input type="hidden" name="product_price" value="{{ $product->price }}">
                            <input type="hidden" name="product_inventory" value="{{ $product->inventory }}">
                            <input type="hidden" name="product_category" value="{{ $product->categories->name }}">

                            <!-- Input for specifying amount -->
                            <div class="mt-4">
                                <label for="amount_{{ $product->id }}" class="block text-sm font-medium text-gray-700">Amount</label>
                                <input type="number" name="amount" id="amount_{{ $product->id }}" value="1" min="1" max="{{ $product->inventory }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <button type="submit" class="mt-4 text-white bg-black px-4 py-2 rounded-md hover:bg-gray-800 transition duration-300">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
