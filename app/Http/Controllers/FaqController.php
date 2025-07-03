<?php
namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->get();
        return view('user.faq1', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'deskripsi_en' => 'required|string',
        ]);

        Faq::create($request->all());

        return redirect()->back()->with('success', 'FAQ berhasil ditambahkan!');
    }



public function manage()
{
    $faqs = Faq::latest()->get();
    return view('admin.faq2', compact('faqs'));
}



public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'deskripsi_en' => 'required',
    ]);

    $faq = Faq::findOrFail($id);
    $faq->update($request->only('judul', 'deskripsi', 'deskripsi_en'));

    return redirect()->route('faq.manage')->with('success', 'FAQ updated successfully.');
}

public function destroy($id)
{
    Faq::destroy($id);
    return redirect()->route('faq.manage')->with('success', 'FAQ deleted successfully.');
}

public function edit($id)
{
    $faq = Faq::findOrFail($id);
    return view('admin.editfaq', compact('faq')); // BUKAN compact('faqs')
}

public function create()
{
    return view('admin.createfaq');
}

public function storee(Request $request)
{
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'deskripsi_en' => 'required|string',
    ]);

    Faq::create($validated);

    return redirect()->route('faq.manage')->with('success', 'FAQ berhasil ditambahkan.');
}


}
