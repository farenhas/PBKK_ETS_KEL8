<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('items.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Item Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Item Name:</label>
                            <input type="text" name="name" id="name" value="{{ $item->name }}" 
                                   class="w-full px-3 py-2 border rounded-lg text-gray-700">
                        </div>

                        <!-- Quantity -->
                        <div class="mb-4">
                            <label for="quantity" class="block text-gray-700 font-bold mb-2">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" value="{{ $item->quantity }}" 
                                   class="w-full px-3 py-2 border rounded-lg text-gray-700">
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="block text-gray-700 font-bold mb-2">Price (USD):</label>
                            <input type="text" name="price" id="price" value="{{ $item->price }}" 
                                   class="w-full px-3 py-2 border rounded-lg text-gray-700">
                        </div>

                        <!-- Buttons Section -->
                        <div class="mt-6 flex justify-between items-center">
                            <!-- Back Button (Left) -->
                            <a href="{{ route('items.index') }}" 
                               class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                ← Back to Items List
                            </a>

                            <!-- Save Button (Right) -->
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-auto">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
