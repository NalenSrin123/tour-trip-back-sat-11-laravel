@extends('layouts.admin')

@section('title', 'Edit Tour Category')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.tour-categories.index') }}" class="text-sm text-blue-600 hover:underline">&larr; Back to categories</a>
        <h1 class="mt-2 text-2xl font-semibold">Edit Category</h1>
    </div>

    <form method="POST"
          action="{{ route('admin.tour-categories.update', $category->category_id) }}"
          class="max-w-2xl rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="category_name" class="mb-1 block text-sm font-medium">Category Name</label>
            <input type="text" name="category_name" id="category_name" required maxlength="255"
                   value="{{ old('category_name', $category->category_name) }}"
                   class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
            @error('category_name')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="mb-1 block text-sm font-medium">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Save Changes
            </button>
            <a href="{{ route('admin.tour-categories.index') }}"
               class="rounded border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </form>
@endsection