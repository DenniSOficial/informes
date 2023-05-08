<?php

namespace App\Http\Controllers;

use App\Models\Norm;
use App\Models\Authority;
use App\Imports\NormsImport;

use Illuminate\Http\Request;
use Excel;

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
        $authorities = Authority::where('IdState', 1)
                                    ->orderBy('Name')->get();

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function import(Request $request)
    {
        //$file = $request->file('file');
        /* //dd($request);
        $file = $request->file('file');
        //dd($file);
        Excel::load($file->path(), function($reader) {
            foreach ($reader->toArray() as $row) {
                dd($row);
            }
        }); */

        //$rutaArchivo = public_path($file->path());

        Excel::import(new NormsImport, $request->file);

        return redirect()->route('norm.index')->with('success', 'Norms imported successfully');;

    }
}
