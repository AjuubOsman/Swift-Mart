<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Shopping Cart</h2>

                @forelse($shoppingCartItems as $item)
                    <div class="mb-4 p-4 bg-gray-100 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-semibold">{{ $item->product->name }}</h3>
                            <p class="text-lg font-semibold text-gray-700">{{ str_replace('.', ',', $item->product->price) }} €</p>
                        </div>
                        <p class="text-gray-700 mb-2">{{ $item->product->description }}</p>

                        <!-- Inline Editable Amount Field -->
                        <form method="POST" action="{{ route('cart.update', $item->product) }}">
                            @csrf
                            @method('PUT')
                            <div class="flex items-center">
                                <label for="amount" class="text-gray-700 mr-2">Amount:</label>
                                <input type="number" name="amount" id="amount" value="{{ $item->amount }}" min="1" class="w-16 p-1 border rounded">
                                <button type="submit" class="ml-2 inline-block bg-blue-500 text-white px-2 py-1 rounded-md hover:bg-blue-700 transition duration-300">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-12 h-12 mx-auto text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                        </svg>
                        <p class="text-xl font-semibold text-gray-700 mt-2">Your shopping cart is empty.</p>
                    </div>
                @endforelse

                <!-- Optionally, you can add a summary and checkout button here -->
                @if($shoppingCartItems->isNotEmpty())
                    <div class="mt-6 p-4 bg-gray-200 rounded-lg shadow-sm">
                        <h3 class="text-xl font-semibold mb-2">Cart Summary</h3>
                        <p class="text-lg font-semibold text-gray-700">
                            Total: {{ number_format($shoppingCartItems->sum(fn($item) => $item->product->price * $item->amount), 2, ',', '.') }} €
                        </p>
                        <a href="" class="mt-4 inline-block bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 transition duration-300">
                            Proceed to Checkout
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
