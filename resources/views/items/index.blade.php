<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Add Item Button and Search Form -->
                    <div class="flex justify-between items-center mb-4">
                        <a href="{{ route('items.create') }}" 
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                           + Add Item
                        </a>

                        <!-- Search Form -->
                        <form action="{{ route('items.index') }}" method="GET" class="flex">
                            <input type="text" name="search" value="{{ $search ?? '' }}" 
                                   placeholder="Search items..." 
                                   class="border-gray-300 rounded-l-md px-4 py-2">
                            <button type="submit" 
                                    class="bg-gray-600 text-white px-4 py-2 rounded-r-md hover:bg-gray-700">
                                Search
                            </button>
                        </form>
                    </div>

                    <!-- Success Message -->
                    @if (session('success'))
                        <div id="success-message" class="p-4 mb-4 bg-green-100 text-green-800 rounded relative">
                            {{ session('success') }}
                            <button onclick="document.getElementById('success-message').style.display='none'"
                                class="absolute top-0 right-0 mt-2 mr-2 text-green-800 hover:text-red-600 text-2xl leading-none font-semibold">
                                &times;
                            </button>
                        </div>
                    @endif

                    <!-- Items Table -->
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Quantity</th>
                                <th class="border px-4 py-2">Price (USD)</th>
                                <th class="border px-4 py-2">Supplier</th>
                                <th class="border px-4 py-2">Category</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="border px-4 py-2">{{ $item->id }}</td>

                                    <!-- Make the item name clickable -->
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('items.show', $item->id) }}"
                                            class="text-blue-600 hover:underline">
                                            {{ $item->name }}
                                        </a>
                                    </td>

                                    <td class="border px-4 py-2">{{ $item->quantity }}</td>
                                    <td class="border px-4 py-2">{{ $item->price }} USD</td>
                                    <td class="border px-4 py-2">{{ $item->supplier->name ?? 'N/A' }}</td>
                                    <td class="border px-4 py-2">{{ $item->category->name ?? 'N/A' }}</td>
                                    <td class="border px-4 py-2">
                                        <!-- Edit Button -->
                                        <a href="{{ route('items.edit', $item->id) }}"
                                            class="text-indigo-600 mr-2">Edit</a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600"
                                                onclick="return confirm('Are you sure you want to delete this item?');">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
