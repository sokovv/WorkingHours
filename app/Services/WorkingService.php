<?php

namespace App\Services;

use App\Models\Working;
use Carbon\Carbon;

class WorkingService
{

    public function workingCreate($id): void
    {
        $working = Working::find($id);
        if ($working->working === 0) {
            $timeStart = Carbon::now();
            $working->start = $timeStart;
            $working->working = 1;
        } else {
            $timeEnd = Carbon::now();
            $working->end = $timeEnd;
            $working->working = 0;
            $working->save();
            $start = Carbon::parse($working->start);
            $diffTime = ($working->end)->diff($start)->format('%H:%I:%S');

            $startTime1 = Carbon::createFromFormat('H:i:s', $diffTime);

            if ($working->diffTime !== null) {
                $startTime2 = Carbon::createFromFormat('H:i:s', $working->diffTime);

                $total = $startTime1->timestamp + $startTime2->timestamp;
                $working->diffTime = Carbon::createFromTimestamp($total)->format('H:i:s');
                $working->hours = Carbon::createFromTimestamp($total)->hour;
                $working->save();
            } else {
                $working->diffTime = Carbon::createFromTimestamp($diffTime)->format('H:i:s');
                $working->hours = Carbon::createFromTimestamp($diffTime)->hour;
                $working->save();
            }
        }
        $working->save();
    }

}
