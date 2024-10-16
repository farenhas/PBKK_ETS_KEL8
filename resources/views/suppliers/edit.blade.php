<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Supplier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Supplier Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Supplier Name:</label>
                            <input type="text" name="name" id="name" value="{{ $supplier->name }}" 
                                   class="w-full px-3 py-2 border rounded-lg text-gray-700">
                        </div>

                        <!-- Supplier Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-bold mb-2">Supplier Email:</label>
                            <input type="email" name="email" id="email" value="{{ $supplier->email }}" 
                                   class="w-full px-3 py-2 border rounded-lg text-gray-700">
                        </div>

                        <!-- Supplier Phone -->
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700 font-bold mb-2">Supplier Phone:</label>
                            <input type="text" name="phone" id="phone" value="{{ $supplier->phone }}" 
                                   class="w-full px-3 py-2 border rounded-lg text-gray-700">
                        </div>

                        <!-- Supplier Address -->
                        <div class="mb-4">
                            <label for="address" class="block text-gray-700 font-bold mb-2">Supplier Address:</label>
                            <textarea name="address" id="address" rows="3" 
                                      class="w-full px-3 py-2 border rounded-lg text-gray-700">{{ $supplier->address }}</textarea>
                        </div>

                        <!-- Buttons Section -->
                        <div class="mt-6 flex justify-between items-center">
                            <!-- Back Button (Left) -->
                            <a href="{{ route('suppliers.index') }}" 
                               class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                ← Back to Suppliers List
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
