@if (!empty($items))
    <ul class="list-disc pl-5">
        @foreach ($items as $item)
            <li class="bg-gray-100 px-3 py-1 rounded-md inline-block my-1">{{ $item }}</li>
        @endforeach
    </ul>
@else
    <span class="text-gray-500 italic">No data available</span>
@endif
