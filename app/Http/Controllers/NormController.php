<?php

namespace App\Http\Controllers;

use App\Models\Norm;
use App\Models\Authority;
use App\Imports\NormsImport;

use Illuminate\Http\Request;
use Auth;
use Excel;
use Carbon\Carbon;

class NormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $norms = Norm::where('IdState', 1)->get();
        return view('admin.maintenance.norms.index')
                ->with('norms', $norms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $norm = null;
        $authorities = Authority::where('IdState', 1)->orderBy('Name')->pluck('Name', 'IdAuthority');

        return view('admin.maintenance.norms.create')
                ->with('norm', $norm)
                ->with('authorities', $authorities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'code' => 'required',
            'authority' => 'required',
            'norm' => 'required',
            'name' => 'required',
            'shortname' => 'required',
            'expedition' => 'required',
            'place' => 'required'
        ], [
            'code.required' => 'El campo código es obligatorio'
        ]);

        $norm = new Norm();
        $norm->IdAuthorityApprove = $request->authority;
        $norm->IdState = 1;
        $norm->CodeNorm = $request->code;
        $norm->ApplicableStandard = $request->norm;
        $norm->ShortName = $request->shortname;
        $norm->LargeName = $request->name;
        $norm->PlaceApplication = $request->place;
        $norm->ExpeditionDate = $request->expedition;
        if (isset($request->notification)) {
            $norm->NotificationDate = $request->notification;
        }
        if (isset($request->url)) {
            $norm->Url = $request->url;
        }
        $norm->UserCreated = Auth::user()->username;
        $norm->DateCreated = Carbon::now();
        $norm->save();

        return redirect()->route('norm.index')->with('success', 'Norm registered successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $norm = Norm::find($id);

        dd($norm);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $norm = Norm::find($id);

        $authorities = Authority::where('IdState', 1)->orderBy('Name')->pluck('Name', 'IdAuthority');

        return view('admin.maintenance.norms.edit')
                ->with('norm', $norm)
                ->with('authorities', $authorities);
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
        $data = request()->validate([
            'code' => 'required',
            'authority' => 'required',
            'norm' => 'required',
            'name' => 'required',
            'shortname' => 'required',
            'expedition' => 'required',
            'place' => 'required'
        ], [
            'code.required' => 'El campo código es obligatorio'
        ]);

        $norm = Norm::find($id);
        $norm->IdAuthorityApprove = $request->authority;
        $norm->CodeNorm = $request->code;
        $norm->ApplicableStandard = $request->norm;
        $norm->ShortName = $request->shortname;
        $norm->LargeName = $request->name;
        $norm->PlaceApplication = $request->place;
        $norm->ExpeditionDate = $request->expedition;
        if (isset($request->notification)) {
            $norm->NotificationDate = $request->notification;
        }
        if (isset($request->url)) {
            $norm->Url = $request->url;
        }
        $norm->UserUpdated = Auth::user()->username;
        $norm->DateUpdated = Carbon::now();
        $norm->save();

        return redirect()->route('norm.index')->with('success', 'Norm updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $norm = Norm::find($id);
        $norm->IdState = 2;
        $norm->UserUpdated = Auth::user()->username;
        $norm->DateUpdated = Carbon::now();
        $norm->save();

        return redirect()->route('norm.index')->with('success', 'Norm deleted successfully');
    }

    public function import(Request $request)
    {
        Excel::import(new NormsImport, $request->file);

        return redirect()->route('norm.index')->with('success', 'Norms imported successfully');

    }
}
