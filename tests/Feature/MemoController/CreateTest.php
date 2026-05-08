<?php

namespace Tests\Feature\MemoController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_正しく保存できた後、一覧ページに遷移されるかつ、保存成功のトーストメッセージが表示されること(): void
    {
        $response = $this->followingRedirects()
            ->post('/', [
                'content' => 'テストメモ'
            ]);

        $this->assertDatabaseCount('memos', 1);
        $this->assertDatabaseHas('memos', [
            'content' => 'テストメモ'
        ]);
        $response->assertInertia(function (AssertableInertia $page): void {
            $page->component('Memo/List')
                ->where(
                    'flash.success',
                    fn(?string $val): bool => (bool)$val
                );
        });
    }

    public function test_メモが空である場合、保存されずにエラーが返されること(): void
    {
        $response = $this
            ->from('/new')
            ->followingRedirects()
            ->post('/', [
                'content' => ''
            ]);

        $this->assertDatabaseCount('memos', 0);
        $response->assertInertia(function (AssertableInertia $page): void {
            $page->component('Memo/New')->where('errors.content', 'contentNotFound');
        });
    }

    public function test_メモの型が不適切である場合、保存されずにエラーが返されること(): void
    {
        $response = $this
            ->from('/new')
            ->followingRedirects()
            ->post('/', [
                'content' => ['a', 'b']
            ]);

        $this->assertDatabaseCount('memos', 0);
        $response->assertInertia(function (AssertableInertia $page): void {
            $page->component('Memo/New')->where('errors.content', 'contentNotCorrectType');
        });
    }
}
