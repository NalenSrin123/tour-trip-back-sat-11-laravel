@extends('layouts.admin')

@section('title', 'Tour Itineraries')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Tour Itineraries</h1>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left">
                <tr>
                    <th class="px-4 py-3 font-medium text-gray-600">ID</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Tour</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Day</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Title</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Description</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($itineraries as $itinerary)
                    <tr>
                        <td class="px-4 py-3">{{ $itinerary->tour_itineraries_id }}</td>
                        <td class="px-4 py-3">{{ $itinerary->tour->title ?? "Tour #{$itinerary->tour_id}" }}</td>
                        <td class="px-4 py-3">Day {{ $itinerary->day_number }}</td>
                        <td class="px-4 py-3 font-medium">{{ $itinerary->title }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ \Illuminate\Support\Str::limit($itinerary->description, 60) ?: '—' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.tour-itineraries.edit', $itinerary->tour_itineraries_id) }}"
                                   class="rounded bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">
                                    Edit
                                </a>
                                <form method="POST"
                                      action="{{ route('admin.tour-itineraries.destroy', $itinerary->tour_itineraries_id) }}"
                                      onsubmit="return confirm('Are you sure you want to delete this itinerary?');">
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
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">No itineraries found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection