@extends('layouts.admin')

@section('title', 'Tour Categories')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Tour Categories</h1>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left">
                <tr>
                    <th class="px-4 py-3 font-medium text-gray-600">ID</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Category Name</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Description</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Tours</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($categories as $category)
                    <tr>
                        <td class="px-4 py-3">{{ $category->category_id }}</td>
                        <td class="px-4 py-3 font-medium">{{ $category->category_name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $category->description ?: '—' }}</td>
                        <td class="px-4 py-3">{{ $category->tours_count }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.tour-categories.edit', $category->category_id) }}"
                                   class="rounded bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">
                                    Edit
                                </a>
                                <form method="POST"
                                      action="{{ route('admin.tour-categories.destroy', $category->category_id) }}"
                                      onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="rounded bg-red-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection