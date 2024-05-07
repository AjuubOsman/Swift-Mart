<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div class="max-h-[400px] overflow-y-auto">
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('All Current Categories') }}
                </h2>
            </header>
            <div>
                @foreach($categories as $category)
                    <div class="flex items-center justify-between border-b border-gray-200 pb-4 mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $category->name }}</h3>
                        <div class="flex items-center space-x-2">
                            <a href="#" class="text-gray-500 hover:text-gray-700 edit-category" data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('category.delete', ['category' => $category->id]) }}" method="POST" class="inline delete-category">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this category?');">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    </div>
    <form method="post" action="{{ route('category.add') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')
        <div>
            <x-input-label :value="__('Name')" />
            <x-text-input name="name" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->updateName->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
    <section id="editCategory" style="display: none;">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Edit Category') }}
            </h2>
        </header>


        <form method="post" action="{{ route('category.edit') }}" class="mt-6 space-y-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="categoryId">
            <div>
                <x-input-label :value="__('Name')" />
                <x-text-input name="name" id="categoryName" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->updateName->get('name')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </div>
        </form>
    </section>

    <script>
        document.querySelectorAll('.edit-category').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                const categoryId = item.getAttribute('data-id');
                const categoryName = item.getAttribute('data-name');
                document.getElementById('categoryId').value = categoryId;
                document.getElementById('categoryName').value = categoryName;
                document.getElementById('editCategory').style.display = 'block';
            });
        });
    </script>
</div>
