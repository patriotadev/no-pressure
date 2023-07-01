<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepinRequest;
use App\Http\Requests\UpdatepinRequest;
use App\Models\Pin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Pin $Pin)
    {
        //
        try {
            $Pin->create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::user()->id
            ]);
            return redirect()->route('pins');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepinRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pin  $Pin
     * @return \Illuminate\Http\Response
     */
    public function show(Pin $Pin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pin  $Pin
     * @return \Illuminate\Http\Response
     */
    public function edit(Pin $Pin, $id)
    {
        //
        return Inertia::render('Pins/Edit', [
            'pin' => $Pin->where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepinRequest  $request
     * @param  \App\Models\Pin  $Pin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pin $Pin)
    {
        //
        try {
            //code...
            $Pin->where('id', $request->id)->update([
                'title' => $request->title,
                'description' => $request->description
            ]);
            return redirect()->route('pins');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pin  $Pin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pin $Pin, Request $request)
    {
        //
        try {
            $Pin->where('id', $request->id)->delete();
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
