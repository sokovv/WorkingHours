<?php

namespace App\Http\Controllers;

use App\Services\WorkingService;
use Illuminate\Http\Request;

class WorkingController extends Controller
{

    private $workingService;


    public function __construct(WorkingService $workingService)
    {
        $this->workingService = $workingService;

    }
    public function startEnd(Request $request)
    {
        $id = $request->id;

        $this->workingService->workingCreate($id);

        return redirect()->back();
    }

}
