<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index() {
        $claims = Claim::where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(8);

        return view('requests.index', compact('claims'));
    }

    public function create() {
        return view('claims.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => ['required', 'date'],
            'place' => ['required', 'string'],
            'pay' => ['required', 'string'],
        ], [
            'date.required' => 'Укажите дату',
            'pay.required' => 'Укажите способ оплаты',
            'place.required' => 'Укажите место проведения',
            'date.date' => 'Указана некорректная дата',
        ]);

        Claim::create([
            'status' => 'new',
            'user_id' => auth()->id(),
            'date' => $validated['date'],
            'place' => $validated['place'],
            'pay' => $validated['pay'],
        ]);

        return redirect()->route('claims.create')->with('claim_success', true);
    }
}
