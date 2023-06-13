<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MyService;

class TestController extends Controller
{
    private $myService;
    public function __construct(MyService $myService)
    {
        $this->myService = $myService;
    }
    public function index()
    {
        return view('welcome');
    }
    public function getValue(Request $request)
    {
        $result = $this->myService->applyFilter($request->value);
        return redirect()->route('welcome')->with('result', $result);
    }

}
