<?php

namespace Tests\Feature\Journal;

use App\Models\StudentSubject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{

    use RefreshDatabase, WithFaker;
    /**
     * Тест успешного получения журнала с данными.
     */

    public function test_index_returns_paginated_journal_successfully()
    {
        $this->artisan('db:seed');

        $response = $this->get(route('journal.index'));
        $response->assertStatus(200);
    }
}
