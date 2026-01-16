<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Jenis Tiket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-lg-5">
                    <h5 class="card-title mb-4 border-bottom pb-3">Formulir Tambah Jenis Tiket</h5>
                    
                    <form action="{{ route('tickets.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <!-- Event Selection -->
                            <div class="col-12">
                                <label for="event_id" class="form-label font-weight-bold">Pilih Event <span class="text-danger">*</span></label>
                                <select name="event_id" id="event_id" class="form-select @error('event_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>-- Pilih Event Terkait --</option>
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                            {{ $event->nama_event }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('event_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Ticket Name -->
                            <div class="col-12">
                                <label for="nama_tiket" class="form-label font-weight-bold">Nama Kategori Tiket <span class="text-danger">*</span></label>
                                <input type="text" name="nama_tiket" id="nama_tiket" class="form-control @error('nama_tiket') is-invalid @enderror" value="{{ old('nama_tiket') }}" placeholder="Contoh: VIP Gold" required>
                                @error('nama_tiket') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Price -->
                            <div class="col-md-6">
                                <label for="harga" class="form-label font-weight-bold">Harga Tiket (Rp) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" placeholder="0" required>
                                </div>
                                @error('harga') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <!-- Stock -->
                            <div class="col-md-6">
                                <label for="stok" class="form-label font-weight-bold">Persediaan Stok <span class="text-danger">*</span></label>
                                <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}" placeholder="0" required>
                                @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Footer Buttons -->
                            <div class="col-12 mt-5 border-top pt-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                                    <button type="submit" class="btn btn-primary px-5 font-weight-bold shadow-sm">Simpan Data Tiket</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
