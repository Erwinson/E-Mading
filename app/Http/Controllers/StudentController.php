<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('sort_by') && $request->sort_by === 'most_liked') {
            $items = Artwork::withCount('likes')->orderBy('likes_count', 'desc')->paginate(3);
        } elseif ($request->has('filter') && $request->filter === 'reposted') {
            $items = Artwork::where('is_reposted', true)->latest()->get();
        } else {
            $items = Artwork::latest()->get();
        }
    
        if (Auth::check()) {
            return view('home', compact('items'));
        }
    
        return redirect()->route('login')
            ->withErrors([
                'password' => 'Please login to access the dashboard.',
            ])->onlyInput('password');
    }

    public function repost($id)
    {
        $artwork = Artwork::findOrFail($id);
    
        // Toggle status repost
        $artwork->is_reposted = !$artwork->is_reposted;
        $artwork->save();
    
        $message = $artwork->is_reposted
            ? 'Karya berhasil di-repost!'
            : 'Repost karya dibatalkan.';
    
        return redirect()->back()->with('successRepost', $message);
    }

    public function repostedArtworks()
    {
        // Ambil semua karya dengan status is_reposted = true
        $items = Artwork::where('is_reposted', true)->latest()->get();

        // Tampilkan ke view
        return view('admin.repost', compact('items'));
    }

    
    public function create()
    {
        return view('student.create');
    }

    public function news(Request $request)
    {
        // Periksa apakah ada parameter untuk sorting
        if ($request->has('sort_by') && $request->sort_by === 'most_liked') {
            $news = Artwork::where('category', 'berita')
                ->withCount('likes')
                ->orderBy('likes_count', 'desc')
                ->get();
        } else {
        
            $news = Artwork::where('category', 'berita')->latest()->get();
        }
        return view('student.news', compact('news'));
    }

    public function videos(Request $request)
    {
        // Periksa apakah ada parameter untuk sorting
        if ($request->has('sort_by') && $request->sort_by === 'most_liked') {
            $videos = Artwork::where('category', 'video')
                ->withCount('likes')
                ->orderBy('likes_count', 'desc')
                ->get();
        } else {
            $videos = Artwork::where('category', 'video')->latest()->get();
        }
        return view('student.videos', compact('videos'));
    }

    public function poetrys(Request $request)
    {
        // Periksa apakah ada parameter untuk sorting
        if ($request->has('sort_by') && $request->sort_by === 'most_liked') {
            $poetrys = Artwork::where('category', 'puisi')
                ->withCount('likes')
                ->orderBy('likes_count', 'desc')
                ->get();
        } else {
        
            $poetrys = Artwork::where('category', 'puisi')->latest()->get();
        }
        return view('student.poetrys', compact('poetrys'));
    }

    public function posters(Request $request)
    {
        // Periksa apakah ada parameter untuk sorting
        if ($request->has('sort_by') && $request->sort_by === 'most_liked') {
            // Ambil data kategori poster yang diurutkan berdasarkan jumlah likes terbanyak
            $posters = Artwork::where('category', 'poster')
                ->withCount('likes')
                ->orderBy('likes_count', 'desc')
                ->get();
        } else {
            // Ambil data kategori poster terbaru jika tidak ada parameter untuk sorting
            $posters = Artwork::where('category', 'poster')
                ->latest()
                ->get();
        }
        
        return view('student.posters', compact('posters'));
    }    

    public function history()
    {
        // Ambil data hanya milik pengguna yang sedang login
        $items = Artwork::where('student_id', auth()->id())->latest()->get();

        return view('student.history', compact('items'));
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:berita,video,puisi,poster',
            'file_path' => 'required|file|mimes:jpg,png,jpeg,gif,mp4,avi',
        ]);
    
        // Menentukan folder penyimpanan berdasarkan kategori
        if ($request->category === 'video') {
            $filePath = $request->file('file_path');
            $filePath->storeAs('public/videos', $filePath->hashName());
            $storagePath = 'storage/videos/' . $filePath->hashName();
        } else {
            $filePath = $request->file('file_path');
            $filePath->storeAs('public/images', $filePath->hashName());
            $storagePath = 'storage/images/' . $filePath->hashName();
        }
    
        // Membuat objek Artwork baru dan menyimpan data ke database
        $artwork = new Artwork();
        $artwork->title = $request->title;
        $artwork->description = $request->description;
        $artwork->category = $request->category;
        $artwork->file_path = $storagePath;
        $artwork->student_id = auth()->id(); // Mengambil ID user yang login
        $artwork->submitted_at = now();
        $artwork->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('home')->with('success', 'Karya berhasil dikirim!');
    }

    public function destroy($id)
    {
        // Ambil data artwork berdasarkan ID
        $artwork = Artwork::findOrFail($id);

        // Hapus file yang terkait
        if (file_exists(public_path($artwork->file_path))) {
            unlink(public_path($artwork->file_path));  // Hapus file dari server
        }

        // Hapus data artwork dari database
        $artwork->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('home')->with('success', 'Karya berhasil dihapus!');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:berita,video,puisi,poster',
            'file_path' => 'nullable|file|mimes:jpg,png,jpeg,gif,mp4,avi',
        ]);

        $artwork = Artwork::findOrFail($id);

        $artwork->title = $request->title;
        $artwork->description = $request->description;
        $artwork->category = $request->category;

        if ($request->hasFile('file_path')) {
            if ($request->category === 'video') {
                $filePath = $request->file('file_path');
                $filePath->storeAs('public/videos', $filePath->hashName());
                $storagePath = 'storage/videos/' . $filePath->hashName();
            } else {
                $filePath = $request->file('file_path');
                $filePath->storeAs('public/images', $filePath->hashName());
                $storagePath = 'storage/images/' . $filePath->hashName();
            }
            $artwork->file_path = $storagePath;
        }

        $artwork->save();

        return redirect()->route('home')->with('success', 'Karya berhasil diperbarui!');
    }

    public function like($id)
    {
        $user = Auth::user();

        // Periksa apakah user sudah memberikan like
        $existingLike = Like::where('user_id', $user->id)->where('artwork_id', $id)->first();

        if ($existingLike) {
            // Jika sudah, hapus like
            $existingLike->delete();
            $status = 'unliked';
        } else {
            // Jika belum, tambahkan like
            Like::create([
                'user_id' => $user->id,
                'artwork_id' => $id,
            ]);
            $status = 'liked';
        }

        // Hitung jumlah like baru
        $likesCount = Like::where('artwork_id', $id)->count();

        return response()->json([
            'status' => $status,
            'likes_count' => $likesCount,
        ]);
    }

    public function showComments($artworkId)
    {
        $artwork = Artwork::with('comments.user')->findOrFail($artworkId);
        
        // Format waktu komentar dengan diffForHumans()
        $comments = $artwork->comments->map(function ($comment) {
            $comment->created_at_human = $comment->created_at->diffForHumans();
            return $comment;
        });
    
        return response()->json($comments);
    }

    public function storeComment(Request $request, $artworkId)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);
    
        $comment = Comment::create([
            'comment' => $request->comment,
            'user_id' => auth()->id(),
            'artwork_id' => $artworkId,
        ]);
    
        // Format waktu komentar agar dapat digunakan di frontend
        $comment->created_at_human = $comment->created_at->diffForHumans();
    
        // Kirim kembali komentar yang baru ditambahkan
        return response()->json($comment);
    }    
}
