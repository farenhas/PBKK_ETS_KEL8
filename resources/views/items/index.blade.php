<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-80 dark:text-gray-200 leading-tight">
            {{ __('List of Items') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Add Item Button -->
                    <div class="flex justify-between mb-6">
                        <form method="GET" action="{{ route('items.index') }}" class="flex">
                            <input type="text" name="search" value="{{ $search }}"
                                placeholder="Search items..." class="border border-gray-300 rounded-md p-2 mr-2 w-full">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Search
                            </button>
                        </form>

                        <!-- Add button -->
                        <a href="{{ route('items.create') }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            + Add Item
                        </a>
                    </div>

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
                                <th class="border px-4 py-2">
                                    <a href="{{ route('items.index', ['sort_by' => 'id', 'sort_direction' => $sortBy === 'id' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}"
                                        class="hover:underline">ID
                                        @if ($sortBy === 'id')
                                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                                        @endif
                                    </a>
                                </th>
                                <th class="border px-4 py-2">
                                    <a href="{{ route('items.index', ['sort_by' => 'name', 'sort_direction' => $sortBy === 'name' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}"
                                        class="hover:underline">Name
                                        @if ($sortBy === 'name')
                                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                                        @endif
                                    </a>
                                </th>
                                <th class="border px-4 py-2">
                                    <a href="{{ route('items.index', ['sort_by' => 'quantity', 'sort_direction' => $sortBy === 'quantity' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}"
                                        class="hover:underline">Quantity
                                        @if ($sortBy === 'quantity')
                                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                                        @endif
                                    </a>
                                </th>
                                <th class="border px-4 py-2">
                                    <a href="{{ route('items.index', ['sort_by' => 'price', 'sort_direction' => $sortBy === 'price' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}"
                                        class="hover:underline">Price (USD)
                                        @if ($sortBy === 'price')
                                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                                        @endif
                                    </a>
                                </th>
                                <th class="border px-4 py-2">
                                    <a href="{{ route('items.index', ['sort_by' => 'supplier_id', 'sort_direction' => $sortBy === 'supplier_id' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}"
                                        class="hover:underline">Supplier
                                        @if ($sortBy === 'supplier_id')
                                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                                        @endif
                                    </a>
                                </th>
                                <th class="border px-4 py-2">
                                    <a href="{{ route('items.index', ['sort_by' => 'category_id', 'sort_direction' => $sortBy === 'category_id' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}"
                                        class="hover:underline">Category
                                        @if ($sortBy === 'category_id')
                                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                                        @endif
                                    </a>
                                </th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="border px-4 py-2">{{ $item->id }}</td>
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
                                        <a href="{{ route('items.edit', $item->id) }}"
                                            class="text-indigo-600 mr-2">Edit</a>
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
