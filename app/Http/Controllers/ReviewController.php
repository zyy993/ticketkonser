<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

   public function index()
{
    // Ambil review terbaru, paginate 6 per halaman
    $reviews = Review::with('user')->latest()->paginate(6);

    // Total semua review
    $totalReviews = Review::count();

    // Rata-rata rating
    $averageRating = Review::avg('rating');

    return view('user.review1', compact('reviews', 'totalReviews', 'averageRating'));
}


    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:1000',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Review berhasil dikirim.');
    }


    public function destroy($id)
{
    $review = Review::findOrFail($id);

    // Optional: hanya admin yang bisa menghapus
    if (auth()->user()->role !== 'admin') {
        return redirect()->back()->with('error', 'Akses ditolak.');
    }

    $review->delete();

    return redirect()->route('admin.review3')->with('success', 'Review berhasil dihapus.');
}

public function indexw()
{
    $reviews = Review::with('user')->latest()->get();
    return view('admin.review3', compact('reviews'));
}
}
