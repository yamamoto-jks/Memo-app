<?php

namespace Tests\Feature\MemoController;

use App\Models\Memo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_メモ一覧ページが返却されること(): void
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertInertia(function (AssertableInertia $page): void {
                $page->component('Memo/List');
            });
    }

    public function test_メモが一つも存在しない際、空配列が返却されること(): void
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertInertia(function (AssertableInertia $page): void {
                $page->has('memos.data', 0);
            });
    }

    public function test_メモの各項目が期待通りに返却されること(): void
    {
        $memoId = Memo::factory()->create([
            'content' => 'テストメモ',
            'created_at' => '2000-01-01 00:00:00',
            'updated_at' => '2000-01-02 11:11:11'
        ])->id;

        $this->get('/')
            ->assertStatus(200)
            ->assertInertia(function (AssertableInertia $page) use ($memoId): void {
                $page->has('memos.data', 1)
                    ->whereAll([
                        'memos.data.0.id' => $memoId,
                        'memos.data.0.content' => 'テストメモ',
                        'memos.data.0.created_at' => '2000-01-01 00:00:00',
                        'memos.data.0.updated_at' => '2000-01-02 11:11:11'
                    ]);
            });
    }

    public function test_複数個のメモも取得できること(): void
    {
        Memo::factory()->create(['content' => 'テストメモ']);
        Memo::factory()->create(['content' => 'テストメモ2']);

        $this->get('/')
            ->assertStatus(200)
            ->assertInertia(function (AssertableInertia $page): void {
                $page->has('memos.data', 2)
                    ->whereAll([
                        'memos.data.0.content' => 'テストメモ',
                        'memos.data.1.content' => 'テストメモ2',
                    ]);
            });
    }
}
