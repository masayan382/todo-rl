<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @test
     */
    public function 一覧を取得できる()
    {
        $tasks = Task::factory()->count(10)->create();
        $response = $this->getJson('api/tasks');

        $response
            ->assertOk()
            ->assertJsonCount($tasks->count());
    }

    /**
     *
     * @test
     */
    public function 登録することができる()
    {
        $data = [
            'title' => 'テスト投稿'
        ];
        $response = $this->postJson('api/tasks', $data);

        $response
            ->assertCreated()
            ->assertJsonFragment($data);
    }

    /**
     *
     * @test
     */
    public function 更新することができる()
    {
        $task = Task::factory()->create();
        $task->title = '書き換え';
        $response = $this->patchJson("api/tasks/{$task->id}", $task->toArray());
        dd($response->json());
        $response
            ->assertOk()
            ->assertJsonFragment($task->toArray());
    }

    /**
     *
     * @test
     */
    public function 削除することができる()
    {
        $tasks = Task::factory()->count(10)->create();
        $response = $this->deleteJson("api/tasks/1");
        $response
            ->assertOk();
        $response = $this->getJson("api/tasks");
        $response->assertJsonCount($tasks->count() - 1);
    }

    /**
     *
     * @test
     */
    public function タイトルが空の場合は登録できない()
    {
        $data = [
            'title' => ''
        ];
        $response = $this->postJson('api/tasks', $data);
        $response
            ->assertStatus(422)
            ->assertJsonValidationErrorFor(
                ['title' => 'タイトルは、必ず指定してください。']
            );
    }

    /**
     *
     * @test
     */
    public function タイトルが255文字の場合は登録できない()
    {
        $data = [
            'title' => str_repeat('あ', 256)
        ];
        $response = $this->postJson('api/tasks', $data);
        $response
            ->assertStatus(422)
            ->assertJsonValidationErrorFor(
                ['title' => 'タイトルは、必ず指定してください。']
            );
    }
}
