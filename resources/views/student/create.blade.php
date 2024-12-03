@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="container mt-5">
            <h2>Tambah Karya Baru</h2>
            <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Input Judul -->
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
    
                <!-- Input Deskripsi -->
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
    
                <!-- Pilih Kategori -->
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="video">Video</option>
                        <option value="puisi">Puisi</option>
                        <option value="poster">Poster</option>
                    </select>
                </div>
    
                <!-- Upload File -->
                <div class="mb-3">
                    <label for="file_path" class="form-label">Unggah File</label>
                    <input type="file" class="form-control" id="file_path" name="file_path" required>
                </div>
    
                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>

    </div>

</div>
@endsection