<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div class="max-h-[400px] overflow-y-auto">
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('All Current Products') }}
                </h2>
            </header>

            <div>
                @foreach($products as $product)
                    <div class="border-b border-gray-200 pb-4 mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Name: {{ $product->name }}</h3>
                            <p class="text-sm text-gray-500">Description: {{ $product->description }}</p>
                            <p class="text-lg font-semibold text-gray-900">Price: {{ str_replace('.', ',', $product->price) }}</p>
                            <p class="text-lg font-semibold text-gray-900">Inventory: {{ $product->inventory }}</p>
                            <p class="text-lg font-semibold text-gray-900">Category: {{ $product->categories->name }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="#" class="text-gray-500 hover:text-gray-700 edit-product" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-description="{{ $product->description }}" data-price="{{ $product->price }}" data-inventory="{{ $product->inventory }}" data-category="{{ $product->category_id }}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('products.delete', ['product' => $product->id]) }}" method="POST" class="inline delete-product">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this product?');">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Add Product') }}
            </h2>
        </header>

        <form method="post" action="{{ route('products.add') }}" class="mt-6 space-y-6">
            @csrf
            @method('post')
            <div>
                <x-input-label :value="__('Name')" />
                <x-text-input name="name" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->updateName->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label :value="__('Description')" />
                <x-text-input name="description" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->updateDescription->get('Description')" class="mt-2" />
            </div>

            <div>
                <x-input-label :value="__('Price')" />
                <x-text-input name="price" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->updatePrice->get('price')" class="mt-2" />
            </div>

            <div>
                <x-input-label :value="__('Inventory')" />
                <x-text-input name="inventory" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->updateInventory->get('inventory')" class="mt-2" />
            </div>

            <div>
                <x-input-label :value="__('Category')" />
                <select name="category_id" class="block mt-1 w-full">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->updateCategory->get('category_id')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </div>
        </form>
    </section>
</div>

<section id="editProduct" style="display: none;">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Edit Product') }}
        </h2>
    </header>

    <form method="post" action="{{ route('products.edit') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="productId">
        <div>
            <x-input-label :value="__('Name')" />
            <x-text-input name="name" id="productName" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->updateName->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label :value="__('Description')" />
            <x-text-input name="description" id="productDescription" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->updateDescription->get('Description')" class="mt-2" />
        </div>

        <div>
            <x-input-label :value="__('Price')" />
            <x-text-input name="price" id="productPrice" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->updatePrice->get('price')" class="mt-2" />
        </div>

        <div>
            <x-input-label :value="__('Inventory')" />
            <x-text-input name="inventory" id="productInventory" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->updateInventory->get('inventory')" class="mt-2" />
        </div>

        <div>
            <x-input-label :value="__('Category')" />
            <select name="category_id" id="productCategory" class="block mt-1 w-full">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->updateCategory->get('category_id')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>

<script>
    document.querySelectorAll('.edit-product').forEach(item => {
        item.addEventListener('click', event => {
            event.preventDefault();
            const productId = item.getAttribute('data-id');
            const productName = item.getAttribute('data-name');
            const productDescription = item.getAttribute('data-description');
            const productPrice = item.getAttribute('data-price');
            const productInventory = item.getAttribute('data-inventory');

            document.getElementById('productId').value = productId;
            document.getElementById('productName').value = productName;
            document.getElementById('productDescription').value = productDescription;
            document.getElementById('productPrice').value = productPrice;
            document.getElementById('productInventory').value = productInventory;

            document.getElementById('editProduct').style.display = 'block';
        });
    });
</script>
