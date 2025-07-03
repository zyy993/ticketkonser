<?php

namespace App\Http\Controllers;

use App\Models\Moment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MomentController extends Controller
{
    public function index()
    {
        $moments = Moment::all();
        return view('dashboard.index', compact('moments')); // sesuaikan jika perlu
    }

    public function create()
    {
        return view('dashboard.moment.create');
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'image' => 'required|image|max:2048',
    ]);

    $path = $request->file('image')->store('images/moments', 'public');

    Moment::create([
        'image_path' => $path,
    ]);

    return redirect()->route('dashboard.index')->with('success', 'Moment image added.');
}

    public function destroy(Moment $moment)
    {
        if ($moment->image_path) {
            Storage::disk('public')->delete($moment->image_path);
        }

        $moment->delete();

        return redirect()->route('dashboard.index')->with('success', 'Moment deleted.');
    }
}
