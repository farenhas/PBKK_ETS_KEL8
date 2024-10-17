<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Item Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Item Header -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $item->name }}</h3>
                        
                        <!-- Back Button -->
                        <a href="{{ route('items.index') }}" 
                           class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded">
                            ← Back
                        </a>
                    </div>

                    <!-- Item Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Quantity -->
                        <div class="p-4 bg-gray-100 rounded-lg">
                            <p class="text-sm font-medium text-gray-500">Quantity</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $item->quantity }}</p>
                        </div>

                        <!-- Price -->
                        <div class="p-4 bg-gray-100 rounded-lg">
                            <p class="text-sm font-medium text-gray-500">Price (USD)</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $item->price }} USD</p>
                        </div>

                        <!-- Supplier -->
                        <div class="p-4 bg-gray-100 rounded-lg">
                            <p class="text-sm font-medium text-gray-500">Supplier</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $item->supplier->name ?? 'N/A' }}</p>
                        </div>

                        <!-- Category -->
                        <div class="p-4 bg-gray-100 rounded-lg">
                            <p class="text-sm font-medium text-gray-500">Category</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $item->category->name ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <!-- Edit Button -->
                        <a href="{{ route('items.edit', $item->id) }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                            Edit
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
