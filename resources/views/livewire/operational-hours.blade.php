<div class="mt-3">
    @foreach($operationalHours as $index => $hour)
        <div class="d-flex align-items-center gap-2 mb-2 operational-time-section" >
            <!-- Pilih Hari -->
            <select class="form-select" wire:model.live="operationalHours.{{ $index }}.day">
                <option value="{{ null }}">Pilih Hari</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
                <option value="Minggu">Minggu</option>
            </select>

            <!-- Input Jam -->
            <!-- start -->
            <input type="time" class="form-control" wire:model.live="operationalHours.{{ $index }}.start">
            <!-- end -->
            <input type="time" class="form-control" wire:model.live="operationalHours.{{ $index }}.end">

            <!-- Tombol Hapus -->
            <button type="button" class="btn" wire:click="removeOperationalHour({{ $index }})">❌</button>
        </div>
    <ul>
        @error("operationalHours.$index.day")
        <li><span class="text-danger">{{ $message }}</span></li>
        @enderror
        @error("operationalHours.$index.start")
        <li><span class="text-danger">{{ $message }}</span></li>
        @enderror
        @error("operationalHours.$index.end")
        <li><span class="text-danger">{{ $message }}</span></li>
        @enderror
    </ul>

    @endforeach


    <!-- Tombol Tambah -->
        <input type="hidden" name="operational_hours" value="{{ json_encode($operationalHours) }}">
    <button type="button" class="btn btn-success mt-2 mb-3"  style="width: 100%" wire:click="addOperationalHour"
            @if($errors->isNotEmpty()) disabled @endif>+ Tambah Jam</button>
</div>
