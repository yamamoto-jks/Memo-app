<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MemoController extends Controller
{
    public function list(): Response
    {
        $memos = Memo::all()->toResourceCollection();

        return Inertia::render('Memo/List', [
            'memos' => $memos
        ]);
    }

    public function new(): Response
    {
        return Inertia::render('Memo/New');
    }

    public function create(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'content' => [
                    'required',
                    'string'
                ]
            ],
            [
                'content.required' => 'contentNotFound',
                'content.string' => 'contentNotCorrectType'
            ]
        );

        Memo::query()->create([
            // @phpstan-ignore offsetAccess.nonOffsetAccessible
            'content' => $validated['content']
        ]);

        return redirect()->route('memo.list')->with('success', '保存に成功しました。');
    }
}
