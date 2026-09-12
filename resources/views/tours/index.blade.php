@extends('layouts.admin')

@section('title', 'Tours')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Tours</h1>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left">
                <tr>
                    <th class="px-4 py-3 font-medium text-gray-600">ID</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Title</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Category</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Price</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Duration</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Itineraries</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($tours as $tour)
                    <tr>
                        <td class="px-4 py-3">{{ $tour->tour_id }}</td>
                        <td class="px-4 py-3 font-medium">{{ $tour->title }}</td>
                        <td class="px-4 py-3">{{ $tour->category->category_name ?? '—' }}</td>
                        <td class="px-4 py-3">${{ number_format($tour->price, 2) }}</td>
                        <td class="px-4 py-3">{{ $tour->duration ?: '—' }}</td>
                        <td class="px-4 py-3">{{ $tour->itineraries_count }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.tours.edit', $tour->tour_id) }}"
                                   class="rounded bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">
                                    Edit
                                </a>
                                <form method="POST"
                                      action="{{ route('admin.tours.destroy', $tour->tour_id) }}"
                                      onsubmit="return confirm('Are you sure you want to delete this tour and all its itineraries?');">
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
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">No tours found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection