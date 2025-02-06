<div>

    @if (!empty($operationalHours))
        <ul class="list-group">
            @foreach ($operationalHours as $hour)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $hour['day'] }}: {{ $hour['start'] }} - {{ $hour['end'] }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">No operational hours added yet.</p>
    @endif
</div>
