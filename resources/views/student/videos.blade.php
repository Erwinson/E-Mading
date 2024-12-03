@extends('layouts.app')

@section('content')
<div class="container">
    @if (Auth::user()->role == 'student')
    <div class="page-inner">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Our Videos !</h1>
            <!-- Dropdown untuk ikon -->
            <div class="dropdown">
                <i class="fas fa-angle-down" 
                   id="dropdownMenuButton" 
                   data-bs-toggle="dropdown" 
                   aria-expanded="false" 
                   style="cursor: pointer; font-size: 1.5rem;">
                </i>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <li>
                        <a class="dropdown-item" href="{{ route('student.videos', ['sort_by' => 'most_liked']) }}">
                            <i class="far fa-kiss-wink-heart" style="font-size: 1.2rem; padding-right: 7px;"></i>Most Liked
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <!-- Iterasi item (gambar atau video) -->
            @foreach ($videos as $video)
            <div class="col-md-4 mb-4">
              <div class="card position-relative">
                <!-- Menampilkan video -->
                @if (file_exists(public_path($video->file_path)))
                <video controls class="card-img-top img-fluid" style="height: 400px; object-fit: cover;">
                    <source src="{{ asset($video->file_path) }}" type="video/{{ pathinfo($video->file_path, PATHINFO_EXTENSION) }}">
                    Browser Anda tidak mendukung elemen video.
                </video>
                @else
                    <p class="text-danger">Video tidak ditemukan: {{ $video->file_path }}</p>
                @endif
                  
                  <!-- Ikon love di pojok kiri bawah -->
                  <div class="position-absolute bottom-0 start-0 p-2">
                    <a href="javascript:void(0)" class="like-btn" data-id="{{ $video->id }}">
                        <i class="far fa-heart text-white {{ $video->likes->contains('user_id', auth()->id()) ? 'liked fas' : '' }}" 
                           style="font-size: 1.5rem; background-color: rgba(0, 0, 0, 0.5); padding: 10px; border-radius: 5px;">
                            <span class="text-white likes-count" style="font-size: 0.8rem; display: block; text-align: center;">
                                {{ $video->likes->count() }}
                            </span>
                        </i>
                    </a>
                  </div>                  
          
                  <!-- Ikon comment di pojok kanan bawah -->
                  <div class="position-absolute bottom-0 end-0 p-2">
                    <a href="javascript:void(0)" class="comment-btn" data-id="{{ $video->id }}" data-bs-toggle="modal" data-bs-target="#commentModal">
                      <i class="far fa-comment-dots text-white" style="font-size: 1.5rem; background-color: rgba(0, 0, 0, 0.5); padding: 10px; border-radius: 5px;">
                          <span class="text-white comments-count" style="font-size: 0.8rem; display: block; text-align: center;">
                              {{ $video->comments->count() }}
                          </span>
                      </i>
                    </a>                    
                  </div>
              </div>
              
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <!-- Title di kiri -->
                  <h5 class="card-title mb-0">{{$video->title}}</h5>
                  <!-- Artwork by di kanan -->
                    <p style="font-size: 13px;" class="mb-0 text-end">created by: {{$video->student->username}}</p>
                </div>
                <p class="card-text">{{$video->description}}</p>
              </div>
              <div class="container">
                  <p class="d-flex justify-content-end">{{$video->created_at->diffForHumans()}}</p>
              </div>
            </div>
                  
            @endforeach
        </div>
    </div>
    @else
    <div class="page-inner">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Our Videos !</h1>
            <!-- Dropdown untuk ikon -->
            <div class="dropdown">
                <i class="fas fa-angle-down" 
                   id="dropdownMenuButton" 
                   data-bs-toggle="dropdown" 
                   aria-expanded="false" 
                   style="cursor: pointer; font-size: 1.5rem;">
                </i>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <li>
                        <a class="dropdown-item" href="{{ route('student.videos', ['sort_by' => 'most_liked']) }}">
                            <i class="far fa-kiss-wink-heart" style="font-size: 1.2rem; padding-right: 7px;"></i>Most Liked
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <!-- Iterasi item (gambar atau video) -->
            @foreach ($videos as $video)
            <div class="col-md-4 mb-4">
              <div class="card position-relative">
                <!-- Menampilkan video -->
                @if (file_exists(public_path($video->file_path)))
                <video controls class="card-img-top img-fluid" style="height: 400px; object-fit: cover;">
                    <source src="{{ asset($video->file_path) }}" type="video/{{ pathinfo($video->file_path, PATHINFO_EXTENSION) }}">
                    Browser Anda tidak mendukung elemen video.
                </video>
                @else
                    <p class="text-danger">Video tidak ditemukan: {{ $video->file_path }}</p>
                @endif

                <!-- Ikon opsi di pojok kanan atas -->
                  <div class="position-absolute top-0 end-0 p-2">
                      <div class="dropdown">
                          <a href="javascript:void(0)" class="options-btn" id="dropdownMenu{{ $video->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fas fa-ellipsis-v text-white" 
                                  style="font-size: 1.5rem; background-color: rgba(0, 0, 0, 0.5); padding: 10px; border-radius: 5px;"></i>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-end mt-3" aria-labelledby="dropdownMenu{{ $video->id }}">
                              <!-- Edit -->
                              <li>
                                  <a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $video->id }}">
                                      <i class="far fa-edit" style="font-size: 1.5rem;"></i> Edit
                                  </a>
                              </li>
                              <!-- Hapus -->
                              <li>
                                  <form action="{{ route('artwork.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus karya ini?');">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="dropdown-item text-danger"><i class="far fa-trash-alt" style="font-size: 1.5rem; padding-right: 5px;"></i> Delete</button>
                                  </form>
                              </li>
                              <!-- Repost -->
                              <li>
                                  <form action="{{ route('artwork.repost', $video->id) }}" method="POST" style="display: inline;">
                                      @csrf
                                      <button type="submit" class="dropdown-item">
                                          @if ($video->is_reposted)
                                              <i class="fas fa-arrow-alt-circle-down text-danger" style="font-size: 1.5rem; padding-right: 3px;"></i> Unrepost
                                          @else
                                              <i class="far fa-arrow-alt-circle-down" style="font-size: 1.5rem; padding-right: 3px;"></i> Repost
                                          @endif
                                      </button>
                                  </form>
                              </li>  
                          </ul>
                      </div>
                  </div>

                  <!-- Modal Edit -->
                  <div class="modal" id="editModal{{ $video->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $video->id }}" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content modal-slide-up-down"
                              style="border-radius: 15px 15px 0 0; 
                                      background-color: #fff; 
                                      max-height: 60%; 
                                      position: fixed; 
                                      bottom: 0; 
                                      left: 0; 
                                      right: 0; 
                                      margin: 0;">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="editModalLabel{{ $video->id }}">Edit Karya Seni</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <form action="{{ route('artwork.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                                      @csrf
                                      @method('PUT')

                                      <!-- Title -->
                                      <div class="mb-3">
                                          <label for="title" class="form-label">Judul</label>
                                          <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $video->title) }}" required>
                                      </div>

                                      <!-- Description -->
                                      <div class="mb-3">
                                          <label for="description" class="form-label">Deskripsi</label>
                                          <textarea name="description" class="form-control" id="description">{{ old('description', $video->description) }}</textarea>
                                      </div>

                                      <!-- Category -->
                                      <div class="mb-3">
                                          <label for="category" class="form-label">Kategori</label>
                                          <select name="category" class="form-select" id="category" required>
                                              <option value="berita" {{ $video->category == 'berita' ? 'selected' : '' }}>Berita</option>
                                              <option value="video" {{ $video->category == 'video' ? 'selected' : '' }}>Video</option>
                                              <option value="puisi" {{ $video->category == 'puisi' ? 'selected' : '' }}>Puisi</option>
                                              <option value="poster" {{ $video->category == 'poster' ? 'selected' : '' }}>Poster</option>
                                          </select>
                                      </div>

                                      <!-- File -->
                                      <div class="mb-3">
                                          <label for="file_path" class="form-label">File</label>
                                          <input type="file" name="file_path" class="form-control" id="file_path">
                                          <small>File yang sudah ada: <a href="{{ asset($video->file_path) }}" target="_blank">Lihat File</a></small>
                                      </div>

                                      <!-- Submit -->
                                      <button type="submit" class="btn btn-primary">Perbarui Karya</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
                  
                  <!-- Ikon love di pojok kiri bawah -->
                  <div class="position-absolute bottom-0 start-0 p-2">
                    <a href="javascript:void(0)" class="like-btn" data-id="{{ $video->id }}">
                        <i class="far fa-heart text-white {{ $video->likes->contains('user_id', auth()->id()) ? 'liked fas' : '' }}" 
                           style="font-size: 1.5rem; background-color: rgba(0, 0, 0, 0.5); padding: 10px; border-radius: 5px;">
                            <span class="text-white likes-count" style="font-size: 0.8rem; display: block; text-align: center;">
                                {{ $video->likes->count() }}
                            </span>
                        </i>
                    </a>
                  </div>                  
          
                  <!-- Ikon comment di pojok kanan bawah -->
                  <div class="position-absolute bottom-0 end-0 p-2">
                    <a href="javascript:void(0)" class="comment-btn" data-id="{{ $video->id }}" data-bs-toggle="modal" data-bs-target="#commentModal">
                      <i class="far fa-comment-dots text-white" style="font-size: 1.5rem; background-color: rgba(0, 0, 0, 0.5); padding: 10px; border-radius: 5px;">
                          <span class="text-white comments-count" style="font-size: 0.8rem; display: block; text-align: center;">
                              {{ $video->comments->count() }}
                          </span>
                      </i>
                    </a>                    
                  </div>
              </div>
              
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <!-- Title di kiri -->
                  <h5 class="card-title mb-0">{{$video->title}}</h5>
                  <!-- Artwork by di kanan -->
                    <p style="font-size: 13px;" class="mb-0 text-end">created by: {{$video->student->username}}</p>
                </div>
                <p class="card-text">{{$video->description}}</p>
              </div>
              <div class="container">
                  <p class="d-flex justify-content-end">{{$video->created_at->diffForHumans()}}</p>
              </div>
            </div>
                  
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Modal Komentar -->
<div class="modal" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content modal-slide-up-down"
           style="border-radius: 15px 15px 0 0; 
                  background-color: #fff; 
                  max-height: 50%; 
                  position: fixed; 
                  bottom: 0; 
                  left: 0; 
                  right: 0; 
                  margin: 0;">
          <!-- Header Modal -->
          <div class="modal-header border-0">
              <h5 class="modal-title" id="commentModalLabel">Komentar</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Body Modal -->
          <div class="modal-body">
              <!-- Input Komentar -->
              <div class="d-flex align-items-center">
                  <input type="text" class="form-control border-0 border-bottom rounded-0 shadow-none" 
                         id="commentInput" placeholder="Tulis komentar..." 
                         style="flex: 1; font-size: 14px; border-color: #ccc;">
                  <button class="btn p-0 ms-2" id="submitComment" style="color: #007bff;">
                      <i class="fas fa-paper-plane" style="font-size: 20px;"></i>
                  </button>
              </div>

              <hr>

              <!-- Daftar Komentar -->
              <div id="commentsList">
                  <!-- Komentar akan dimuat di sini dengan AJAX -->
              </div>
          </div>
      </div>
  </div>
</div>


<!-- Modal Bootstrap -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-body p-0" onclick="closeModal(event)">
              <!-- Gambar tanpa pembatasan ukuran -->
              <img id="modalImage" src="" alt="Full Image" style="display: block; margin: auto;">
          </div>
      </div>
  </div>
</div>

<style>
  /* Keyframes untuk animasi slide-up saat muncul */
  @keyframes slideUp {
      from {
          transform: translateY(100%);
      }
      to {
          transform: translateY(0);
      }
  }

  /* Keyframes untuk animasi slide-down saat menghilang */
  @keyframes slideDown {
      from {
          transform: translateY(0);
      }
      to {
          transform: translateY(100%);
      }
  }

  /* Tambahkan animasi saat modal muncul */
  .modal-slide-up-down {
      animation: slideUp 0.5s ease-out;
  }

  /* Tambahkan animasi slide-down ketika modal ditutup */
  .modal.slide-down {
      animation: slideDown 0.5s ease-in forwards;
  }

  
  .modal-content-comment {
      border-radius: 15px;
      background-color: #fff;
      max-height: 50%;
      position: fixed; /* Ubah dari absolute menjadi fixed */
      bottom: 0;
      left: 0; /* Pastikan menyentuh tepi kiri */
      right: 0; /* Pastikan menyentuh tepi kanan */
      width: 100%;
      margin: 0; /* Hilangkan margin */
  }

  /* like */
  .liked {
    color: red !important;
  }

  /* modal gambar */
  .card-img-top {
    width: 100%;
    height: 400px;  /* Atur tinggi media sesuai kebutuhan */
    object-fit: cover; /* Memastikan gambar/video tetap proporsional */
  }
  .card:hover .card-img-top {
    transform: scale(1.1); /* Skala media saat di-hover */
    transition: transform 0.3s ease; /* Transisi halus */
  }

  .card:hover .far {
    transform: scale(1.1); /* Skala ikon saat di-hover */
    transition: transform 0.3s ease; /* Transisi halus */
  }
  .card:hover .fas {
    transform: scale(1.1); /* Skala ikon saat di-hover */
    transition: transform 0.3s ease; /* Transisi halus */
  }
  
  /* Modal akan scroll jika gambar lebih besar dari layar */
  .modal-dialog {
    max-width: none; /* Modal bisa meluas lebih dari batas default */
    width: auto; /* Sesuaikan dengan konten */
  }

  .modal-content {
    background-color: transparent; /* Hilangkan background putih modal */
    border: none; /* Hilangkan border modal */
  }

  .modal-body {
    overflow: auto; /* Tambahkan scroll jika ukuran gambar melebihi layar */
    max-height: 90vh; /* Batas tinggi modal (90% dari tinggi layar) */
  }

  #modalImage {
    max-width: 100%; /* Memastikan gambar responsif */
    height: auto; /* Menjaga rasio gambar tetap proporsional */
  }
 
  /* card data */
  .card {
    border: 1px solid #ddd; /* Border tipis di sekitar card */
    border-radius: 10px; /* Sudut melengkung */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Bayangan card */
    overflow: hidden; /* Agar konten tidak keluar dari batas card */
  }

  .card-img-top {
      border-bottom: 1px solid #ddd; /* Border tipis di bawah gambar/video */
      margin-bottom: 0; /* Menghapus margin bawah pada gambar/video */
  }

  .card-body {
      border-radius: 10px;
      padding: 15px; /* Padding yang cukup untuk card body */
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Bayangan card */
      border-top: 0; /* Menghapus border top dari card body untuk menghindari jarak */
      background-color: #fff; /* Latar belakang putih */
  }

  .card-body p, .card-body h5 {
      margin: 0; /* Menghapus margin di p dan h5 agar tidak ada jarak */
  }

  .card-body h5 {
      font-size: 16px; /* Ukuran font judul */
      font-weight: bold; /* Membuat judul lebih tegas */
  }

  .card-body p {
      font-size: 13px; /* Ukuran font deskripsi */
      color: #555; /* Warna teks deskripsi */
  }
</style>

<script>
  document.querySelectorAll('.comment-btn').forEach(button => {
      button.addEventListener('click', function() {
          const artworkId = this.getAttribute('data-id');
          window.currentArtworkId = artworkId;

          // Menampilkan komentar terkait artwork di modal
          loadComments(artworkId);
      });
  });

  document.getElementById('submitComment').addEventListener('click', function() {
      const commentInput = document.getElementById('commentInput');
      const commentText = commentInput.value.trim();

      if (!commentText) return;

      // Kirim komentar baru ke server
      fetch(`/artworks/${window.currentArtworkId}/comments`, {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({ comment: commentText })
      })
      .then(response => response.json())
      .then(newComment => {
          // Setelah komentar berhasil, reload komentar-komentar
          loadComments(window.currentArtworkId);

          // Reset input komentar
          commentInput.value = '';
      });
  });

  // Fungsi untuk memuat komentar
  function loadComments(artworkId) {
      fetch(`/artworks/${artworkId}/comments`)
          .then(response => response.json())
          .then(comments => {
              const commentsList = document.getElementById('commentsList');
              commentsList.innerHTML = ''; // Clear previous comments
              comments.forEach(comment => {
                  const commentDiv = document.createElement('div');
                  commentDiv.classList.add('d-flex', 'align-items-start', 'mb-3');
                  commentDiv.innerHTML = `
                      <div>
                          <strong>${comment.user.username}</strong>
                          <p class="mb-1">${comment.comment}</p>
                          <small class="text-muted">${comment.created_at_human}</small>
                      </div>
                  `;
                  commentsList.appendChild(commentDiv);
              });
          });
  }




  document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.like-btn').forEach(btn => {
          btn.addEventListener('click', () => {
              const artworkId = btn.getAttribute('data-id');
              const icon = btn.querySelector('i');

              // Kirim permintaan ke server untuk menambah atau menghapus like
              fetch(`/artworks/${artworkId}/like`, {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                  },
              })
              .then(response => response.json())
              .then(data => {
                  // Ubah class berdasarkan status
                  if (data.status === 'liked') {
                      icon.classList.add('fas', 'liked'); // Tambahkan warna merah dan ikon solid
                      icon.classList.remove('far'); // Hapus ikon outline
                  } else {
                      icon.classList.add('far'); // Kembalikan ke ikon outline
                      icon.classList.remove('fas', 'liked'); // Hapus warna merah dan ikon solid
                  }
                  // Perbarui jumlah like
                  btn.querySelector('.likes-count').textContent = data.likes_count;
              })
              .catch(error => console.error('Error:', error));
          });
      });
  });



  function showModal(imageSrc) {
      const modalImage = document.getElementById('modalImage');
      modalImage.src = imageSrc;
      const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
      imageModal.show();
  }

  function closeModal(event) {
      // Hanya menutup modal jika klik terjadi di luar gambar
      if (event.target.id !== "modalImage") {
          const imageModal = bootstrap.Modal.getInstance(document.getElementById('imageModal'));
          imageModal.hide();
      }
  }
</script>
@endsection
