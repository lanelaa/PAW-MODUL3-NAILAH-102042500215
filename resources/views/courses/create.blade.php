@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah Baru')

@section('content')
<div style="max-width: 760px; margin: 0 auto;">
    <div style="margin-bottom: 1.25rem;">
        <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-sm">
            Kembali ke Daftar Mata Kuliah
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="card-title">Tambah Mata Kuliah Baru</h1>
                <p class="card-subtitle">Buat mata kuliah baru yang akan Anda ampu pada semester aktif ini.</p>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('courses.store') }}" method="POST">
                @csrf

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.25rem;">
                    
                     {{-- Hint:
                     - Buat field untuk kode MK, nama MK, SKS, dan semester.
                     - Gunakan jenis elemen form yang sesuai dengan tiap data.
                     - Sesuaikan atribut name dengan nama field yang dibaca controller.
                     - Gunakan old() agar isian tidak hilang setelah validasi gagal.
                     - Tampilkan pesan error validasi menggunakan directive Blade.
                     - Pola umum input teks: <input type="text" name="nama_field"> --}}
                <div class="mb-3">
                    <label for="kode_matkul" class="form-label">Kode Mata Kuliah</label>
                    <input type="text" class="form-control @error('kode_matkul') is-invalid @enderror" id="kode_matkul" name="kode_matkul" value="{{ old('kode_matkul') }}" required>
                    @error('kode_matkul')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
                    <input type="text" class="form-control @error('nama_matkul') is-invalid @enderror" id="nama_matkul" name="nama_matkul" value="{{ old('nama_matkul') }}" required>
                    @error('nama_matkul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sks" class="form-label">Jumlah SKS</label>
                    <input type="number" class="form-control @error('sks') is-invalid @enderror" id="sks" name="sks" value="{{ old('sks') }}" min="1" max="6" required>
                    @error('sks')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="text" class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester" value="{{ old('semester') }}" required>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Dosen Pengampu (Otomatis akun Dosen yang login) -->
                <div class="form-group">
                    <label class="form-label">
                        Dosen Pengampu Kelas
                    </label>
                    <div style="padding: 0.625rem 0.875rem; background-color: var(--slate-50); border: 1px solid var(--slate-200); border-radius: 6px; font-size: 0.875rem; color: var(--slate-800); font-weight: 600;">
                        {{ Auth::user()->name }} ({{ Auth::user()->nomor_induk ?: Auth::user()->email }})
                    </div>
                    <div class="form-help">Mata kuliah ini akan otomatis tercatat di bawah akun Dosen Anda.</div>
                </div>

                <!-- Deskripsi / Silabus -->
                <div class="form-group">
                    <label for="deskripsi" class="form-label">
                        Silabus / Deskripsi Mata Kuliah
                    </label>
                    <textarea 
                        name="deskripsi" 
                        id="deskripsi" 
                        rows="4" 
                        class="form-control @error('deskripsi') is-invalid @enderror" 
                        placeholder="Ringkasan capaian pembelajaran, silabus, dan materi yang akan dipelajari..."
                    >{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid var(--slate-200);">
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Mata Kuliah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
