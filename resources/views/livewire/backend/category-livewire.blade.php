<div>
    <div id="content" class="mx-auto" style="max-width:500px;">
        <div class="container content py-6 mx-auto">
            <div class="mx-auto">
                <div id="create-form" class="hover:shadow p-6 bg-white border-blue-500 border-t-2">
                    <div class="flex ">
                        <h2 class="font-semibold text-lg text-gray-800 mb-5">Create New Category</h2>
                    </div>
                    <div>
                        <form>
                            <div class="mb-6">
                                <label for="category_name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    Category Name </label>
                                <input type="text" wire:model="category_name" id="category_name" placeholder="Category name.."
                                       class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2.5">
                                @error('category_name')
                                <span class="text-red-500 text-xs mt-3 block ">{{$message}}</span>
                                @enderror

                            </div>
                            <div class="mb-6">
                                <label for="description"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Description </label>
                                <textarea wire:model="description" type="text" id="description" placeholder="Description.."
                                          class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2.5">
                                                </textarea>

                                @error('description')
                                <span class="text-red-500 text-xs mt-3 block ">Error</span>
                                @enderror

                            </div>
                            <button type="submit" wire:click.prevent="create"
                                    class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">
                                Create
                                +
                            </button>
                            @if(session('success'))
                                <span class="text-green-500 text-xs">{{ session('success') }}</span>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.includes.search_box')
    @foreach($categories as $category)
        @include('livewire.includes.category-list')
    @endforeach
    <div class="my-2">
        {{ $categories->links() }}
    </div>
</div>
