<?php

namespace App\Services;

use App\Models\User;
use App\Models\Working;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class WorkerService {

    public function workingCreate($workers): void
    {
        foreach ($workers as $worker) {

            $working = [
                'worker_id'=> $worker->id,
            ];

            if (Working::where('worker_id', $worker->id)->first() === null) {
                Working::class::create($working);
            }

           }
    }

}
