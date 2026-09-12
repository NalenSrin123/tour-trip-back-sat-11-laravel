@extends('layouts.admin')

@section('title', 'Edit Tour Itinerary')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.tour-itineraries.index') }}" class="text-sm text-blue-600 hover:underline">&larr; Back to itineraries</a>
        <h1 class="mt-2 text-2xl font-semibold">Edit Itinerary</h1>
    </div>

    <form method="POST"
          action="{{ route('admin.tour-itineraries.update', $itinerary->tour_itineraries_id) }}"
          class="max-w-2xl rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="tour_id" class="mb-1 block text-sm font-medium">Tour</label>
            <select name="tour_id" id="tour_id" required
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
                @foreach ($tours as $tour)
                    <option value="{{ $tour->tour_id }}"
                            {{ old('tour_id', $itinerary->tour_id) == $tour->tour_id ? 'selected' : '' }}>
                        {{ $tour->title }}
                    </option>
                @endforeach
            </select>
            @error('tour_id')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="day_number" class="mb-1 block text-sm font-medium">Day Number</label>
            <input type="number" name="day_number" id="day_number" min="1" required
                   value="{{ old('day_number', $itinerary->day_number) }}"
                   class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
            @error('day_number')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="title" class="mb-1 block text-sm font-medium">Title</label>
            <input type="text" name="title" id="title" required maxlength="191"
                   value="{{ old('title', $itinerary->title) }}"
                   class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
            @error('title')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="description" class="mb-1 block text-sm font-medium">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">{{ old('description', $itinerary->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Save Changes
            </button>
            <a href="{{ route('admin.tour-itineraries.index') }}"
               class="rounded border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </form>
@endsection