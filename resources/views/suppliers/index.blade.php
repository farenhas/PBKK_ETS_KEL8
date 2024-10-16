<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suppliers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Add Supplier Button and Search Form -->
                    <div class="flex justify-between items-center mb-4">
                        <a href="{{ route('suppliers.create') }}" 
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                           + Add Supplier
                        </a>

                        <!-- Search Form -->
                        <form action="{{ route('suppliers.index') }}" method="GET" class="flex">
                            <input type="text" name="search" value="{{ $search ?? '' }}" 
                                   placeholder="Search suppliers..." 
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

                    <!-- Suppliers Table -->
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Phone</th>
                                <th class="border px-4 py-2">Address</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td class="border px-4 py-2">{{ $supplier->id }}</td>

                                    <!-- Make the supplier name clickable -->
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('suppliers.show', $supplier->id) }}"
                                            class="text-blue-600 hover:underline">
                                            {{ $supplier->name }}
                                        </a>
                                    </td>

                                    <td class="border px-4 py-2">{{ $supplier->email }}</td>
                                    <td class="border px-4 py-2">{{ $supplier->phone }}</td>
                                    <td class="border px-4 py-2">{{ $supplier->address }}</td>
                                    <td class="border px-4 py-2">
                                        <div class="flex space-x-2">
                                            <!-- Edit Button -->
                                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="text-indigo-600">Edit</a>
                                    
                                            <!-- Delete Button -->
                                            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600" 
                                                    onclick="return confirm('Are you sure you want to delete this supplier?');">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $suppliers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
