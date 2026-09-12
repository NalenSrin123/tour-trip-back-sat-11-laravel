@extends('layouts.admin')

@section('title', 'Edit Tour')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.tours.index') }}" class="text-sm text-blue-600 hover:underline">&larr; Back to tours</a>
        <h1 class="mt-2 text-2xl font-semibold">Edit Tour</h1>
    </div>

    <form method="POST"
          action="{{ route('admin.tours.update', $tour->tour_id) }}"
          class="max-w-2xl rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="mb-1 block text-sm font-medium">Title</label>
            <input type="text" name="title" id="title" required maxlength="255"
                   value="{{ old('title', $tour->title) }}"
                   class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
            @error('title')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="mb-4">
                <label for="category_id" class="mb-1 block text-sm font-medium">Category</label>
                <select name="category_id" id="category_id" required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
                    <option value="">Select category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}"
                                {{ old('category_id', $tour->category_id) == $category->category_id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="destination_id" class="mb-1 block text-sm font-medium">Destination</label>
                @if ($destinations->isNotEmpty())
                    <select name="destination_id" id="destination_id"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
                        <option value="">None</option>
                        @foreach ($destinations as $destination)
                            <option value="{{ $destination->destination_id }}"
                                    {{ old('destination_id', $tour->destination_id) == $destination->destination_id ? 'selected' : '' }}>
                                {{ $destination->name }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <input type="number" name="destination_id" id="destination_id" min="1"
                           value="{{ old('destination_id', $tour->destination_id) }}"
                           class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none"
                           placeholder="Destination ID">
                @endif
                @error('destination_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="mb-4">
                <label for="price" class="mb-1 block text-sm font-medium">Price</label>
                <input type="number" name="price" id="price" step="0.01" min="0" required
                       value="{{ old('price', $tour->price) }}"
                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
                @error('price')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="duration" class="mb-1 block text-sm font-medium">Duration</label>
                <input type="text" name="duration" id="duration" maxlength="255"
                       value="{{ old('duration', $tour->duration) }}"
                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
                @error('duration')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="mb-4">
                <label for="included_services" class="mb-1 block text-sm font-medium">Included Services</label>
                <textarea name="included_services" id="included_services" rows="4"
                          class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">{{ old('included_services', $tour->included_services) }}</textarea>
                @error('included_services')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="excluded_services" class="mb-1 block text-sm font-medium">Excluded Services</label>
                <textarea name="excluded_services" id="excluded_services" rows="4"
                          class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">{{ old('excluded_services', $tour->excluded_services) }}</textarea>
                @error('excluded_services')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="rating_avg" class="mb-1 block text-sm font-medium">Average Rating</label>
            <input type="number" name="rating_avg" id="rating_avg" step="0.01" min="0" max="5"
                   value="{{ old('rating_avg', $tour->rating_avg) }}"
                   class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
            @error('rating_avg')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Save Changes
            </button>
            <a href="{{ route('admin.tours.index') }}"
               class="rounded border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </form>
@endsection