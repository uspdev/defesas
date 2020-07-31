<?php

namespace App\Http\Controllers;

use App\Config;
use Illuminate\Http\Request;
use App\Http\Requests\ConfigRequest;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit()
    {
        $config = Config::orderByDesc('created_at')->first();
        return view('configs.edit', compact('config'));
    }

    public function store(ConfigRequest $request)
    {
        $validated = $request->validated();
        Config::create($validated);
        return redirect('/configs');
    }

    
   

}
