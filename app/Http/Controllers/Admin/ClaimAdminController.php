<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use Illuminate\Http\Request;

class ClaimAdminController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(auth()->user()?->is_admin, 403);

        $data = $request->validate([
            'type'   => ['nullable', 'string', 'max:60'],
            'car'       => ['nullable', 'string', 'max:20'],
            'date_from' => ['nullable', 'date'],
            'date_to'   => ['nullable', 'date', 'after_or_equal:date_from'],
            'user'      => ['nullable', 'string', 'max:150'],
        ]);

        $q = \App\Models\Claim::with('user')->orderByDesc('created_at');

        $claims = $q->paginate(8)->withQueryString();

        return view('admin.requests.index', compact('claims'));
    }

    public function updateStatus(Request $request, Claim $claim)
    {
        abort_unless(auth()->user()?->is_admin, 403);

        if ($claim->status !== 'new') {
            return back()->withErrors(['status' => 'Статус можно менять только у заявок со статусом "new".']);
        }

        $data = $request->validate([
            'status' => ['required', 'in:approved,rejected'],
        ], [
            'status.required' => 'Выберите новый статус.',
            'status.in' => 'Недопустимый статус.',
        ]);

        $claim->update(['status' => $data['status']]);

        return back()->with('admin_status_updated', true);
    }
}
