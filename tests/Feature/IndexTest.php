<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Worker;
use App\Models\Working;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test  */


    public function index()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $workers = Worker::latest()->get();
        $user = User::latest()->get();
        $working = Working::latest()->get();
        return view('importFile', compact('workers','user', 'working'));
    }
}
