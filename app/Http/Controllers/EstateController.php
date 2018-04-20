<?php

namespace LaravelRealState\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use LaravelRealState\Http\Requests;
use LaravelRealState\Http\Controllers\Controller;

use LaravelRealState\Estate;
use LaravelRealState\Owner;

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
        $estates = Estate::orderBy('created_at', 'desc')->orderBy('id', 'desc')->paginate(10);
        return view('estates.index', compact('estates'));
    }

    /**
     * Display a listing of the resource filtered by type.
     *
     * @param  string  $type_name
     * @return \Illuminate\Http\Response
     */
    public function filter($type_name)
    {
        switch ($type_name) {
            case 'houses':
                $type = 'house';
                break;
            case 'departments':
                $type = 'department';
                break;
            default:
                return view('errors.404');
        }
        $type_id = DB::table('estates_types')->where('name', $type)->select('id')->take(1)->get()[0]->id;
        $estates = Estate::where('type', $type_id)->orderBy('created_at', 'desc')->orderBy('id', 'desc')->paginate(10);
        return view('estates.index', compact('estates', 'type_name'));
    }

    /**
     * Display a listing of the resource filtered by type.
     *
     * @param  string  $type_name
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $ref = isset($request->ref) ? $request->ref : '';
        $label = isset($request->label) ? $request->label : '';
        $address = isset($request->address) ? $request->address : '';
        $estates = Estate::whereRaw('1 = 1');
        if ($ref) $estates = $estates-where('ref', 'like', "%$ref%");
        if ($label) $estates = $estates->where('label', 'like', "%$label%");
        if ($address) $estates = $estates->where('address', 'like', "%$address%");
        $estates = $estates->orderBy('created_at', 'desc')->orderBy('id', 'desc')->paginate(10);
        return response()->json($estates);
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
        $estate = new Estate();
        $estate->ref = $request->ref;
        $estate->label = $request->label;
        $estate->address = $request->address;
        $estate->created_by = $request->user()->id;
        $estate->owner()->associate(Owner::findOrFail($request->fk_owner));
        $estate->save();
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
        $estate = Estate::findOrFail($id);
        $estate->ref = $request->ref;
        $estate->label = $request->label;
        $estate->address = $request->address;
        $estate->updated_by = $request->user()->id;
        if ($request->fk_owner) {
            $estate->owner()->associate(Owner::findOrFail($request->fk_owner));
        }
        $estate->save();
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
        $estate = Estate::onlyTrashed()->findOrFail($id);
        $estate->forceDelete();
        return redirect('/estates');
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
