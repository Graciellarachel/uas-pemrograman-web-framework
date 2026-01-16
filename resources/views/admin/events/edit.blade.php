<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Informasi Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-lg-5">
                    <h5 class="card-title mb-4 border-bottom pb-3">Formulir Update Event</h5>
                    
                    <form action="{{ route('events.update', $event) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            <!-- Nama Event -->
                            <div class="col-12">
                                <label for="nama_event" class="form-label font-weight-bold">Nama Event <span class="text-danger">*</span></label>
                                <input type="text" name="nama_event" id="nama_event" class="form-control @error('nama_event') is-invalid @enderror" value="{{ old('nama_event', $event->nama_event) }}" required>
                                @error('nama_event') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Tanggal & Lokasi -->
                            <div class="col-md-6">
                                <label for="tanggal_event" class="form-label font-weight-bold">Tanggal Event <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_event" id="tanggal_event" class="form-control @error('tanggal_event') is-invalid @enderror" value="{{ old('tanggal_event', $event->tanggal_event) }}" required>
                                @error('tanggal_event') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="lokasi" class="form-label font-weight-bold">Lokasi / Venue <span class="text-danger">*</span></label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $event->lokasi) }}" required>
                                @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-12">
                                <label for="deskripsi" class="form-label font-weight-bold">Deskripsi Event</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $event->deskripsi) }}</textarea>
                                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Footer Buttons -->
                            <div class="col-12 mt-5 border-top pt-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('events.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                                    <button type="submit" class="btn btn-primary px-5 font-weight-bold shadow-sm">Perbarui Event</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
