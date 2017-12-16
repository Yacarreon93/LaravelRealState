<?php

namespace LaravelRealState\Http\Controllers;

use Illuminate\Http\Request;

use LaravelRealState\Http\Requests;
use LaravelRealState\Http\Controllers\Controller;

use LaravelRealState\Estate;

class EstateController extends Controller
{
    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estates = Estate::paginate(10);
        return view('estates.index', compact('estates'));
    }

    /**
     * Display trashed elements.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $estates = Estate::onlyTrashed()->paginate(10);
        return view('estates.trashed', compact('estates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        Estate::create($data);
        return redirect('/estates');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estate = Estate::findOrFail($id);
        return view('estates.show', compact('estate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estate = Estate::findOrFail($id);
        return view('estates.edit', compact('estate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['updated_by'] = $request->user()->id;
        $estate = Estate::findOrFail($id);
        $estate->update($data);
        return redirect(route('estates.show', $id));
    }

    /**
     * Trash the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        $data = [];
        $data['deleted_by'] = $request->user()->id;
        $estate = Estate::findOrFail($id);
        $estate->update($data);
        $estate->delete();
        return redirect('/estates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $estate = Estate::withTrashed()->findOrFail($id);
        $estate->restore();
        return redirect('/estates');
    }
}
