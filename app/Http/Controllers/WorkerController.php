<?php

namespace App\Http\Controllers;

use App\Imports\WorkersImport;
use App\Models\User;
use App\Models\Worker;
use App\Models\Working;
use App\Services\UserService;
use App\Services\ValidatorService;
use App\Services\WorkerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class WorkerController extends Controller
{

    private $userService;
    private $workerService;
    private $validatorService;

    public function __construct(UserService $userServices, ValidatorService $validatorService, WorkerService $workerService)
    {
        $this->userService = $userServices;
        $this->workerService = $workerService;
        $this->validatorService = $validatorService;
    }

        public function importView(){
            $user = Auth::user();
            $workers = Worker::all();

            $this->workerService->workingCreate($workers);

            $working = Working::all();
            return view('importFile', [ 'workers' => $workers, 'working' => $working, 'user' => $user]);
        }

        public function import(){
            Excel::import(new WorkersImport,
                          request()->file('file'));

            return redirect()->back();
        }


        public function enter(Request $request)
        {
            $validator = $this->validatorService->serviceValid($request);

            if ($validator->fails()) {
                return redirect('/')
                    ->withErrors($validator)
                    ->withInput();
            }

            $this->userService->userCreate($request);
            $user = User::where('name', $request->input('name'))->first();
            Auth::login($user);
            return back()->withInput();
        }
}
