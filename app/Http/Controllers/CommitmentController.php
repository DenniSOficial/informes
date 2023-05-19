<?php

namespace App\Http\Controllers;

use App\Models\Commitment;
use App\Models\Norm;
use App\Models\Phase;
use App\Models\Frequency;
use App\Imports\CommitmentsImport;

use Illuminate\Http\Request;
use Auth;
use Excel;
use Carbon\Carbon;

class CommitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commitments = Commitment::where('IdState', 1)->get();
        return view('admin.maintenance.commitments.index')
                ->with('commitments', $commitments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $commitment = null;
        $norms = Norm::where('IdState', 1)->orderBy('ApplicableStandard')->pluck('ApplicableStandard', 'IdNorm');
        $phases = Phase::where('IdState', 1)->orderBy('Name')->pluck('Name', 'IdPhase');
        $frequencies = Frequency::where('IdState', 1)->orderBy('Name')->pluck('Name', 'IdFrequency');

        return view('admin.maintenance.commitments.create')
                ->with('commitment', $commitment)
                ->with('norms', $norms)
                ->with('phases', $phases)
                ->with('frequencies', $frequencies);
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
            'norm' => 'required',
            'phase' => 'required',
            'frequency' => 'required',
            'summary' => 'required',
            'description' => 'required'
        ]);

        $commitment = new Commitment();
        $commitment->IdNorm = $request->norm;
        $commitment->IdPhase = $request->phase;
        $commitment->IdFrequency = $request->frequency;
        $commitment->IdState = 1;
        $commitment->CodeCommitment = $request->code;
        $commitment->Summary = $request->summary;
        $commitment->DescriptionEnvironmentalCommitment = $request->description;
        $commitment->CoordinateUTM = $request->utm;
        $commitment->CoordinateNUTM = $request->nutm;
        $commitment->RelatedImpact = $request->impact;
        $commitment->UserCreated = Auth::user()->username;
        $commitment->DateCreated = Carbon::now();

        $commitment->save();

        return redirect()->route('commitment.index')->with('success', 'Commitment registered successfully');
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
        $commitment = Commitment::find($id);

        $norms = Norm::where('IdState', 1)->orderBy('ApplicableStandard')->pluck('ApplicableStandard', 'IdNorm');
        $phases = Phase::where('IdState', 1)->orderBy('Name')->pluck('Name', 'IdPhase');
        $frequencies = Frequency::where('IdState', 1)->orderBy('Name')->pluck('Name', 'IdFrequency');

        return view('admin.maintenance.commitments.edit')
                ->with('commitment', $commitment)
                ->with('norms', $norms)
                ->with('phases', $phases)
                ->with('frequencies', $frequencies);
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
            'norm' => 'required',
            'phase' => 'required',
            'frequency' => 'required',
            'summary' => 'required',
            'description' => 'required'
        ]);

        $commitment = Commitment::find($id);
        $commitment->IdNorm = $request->norm;
        $commitment->IdPhase = $request->phase;
        $commitment->IdFrequency = $request->frequency;
        $commitment->CodeCommitment = $request->code;
        $commitment->Summary = $request->summary;
        $commitment->DescriptionEnvironmentalCommitment = $request->description;
        $commitment->CoordinateUTM = $request->utm;
        $commitment->CoordinateNUTM = $request->nutm;
        $commitment->RelatedImpact = $request->impact;
        $commitment->UserUpdated = Auth::user()->username;
        $commitment->DateUpdated = Carbon::now();

        $commitment->save();

        return redirect()->route('commitment.index')->with('success', 'Commitment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commitment = Commitment::find($id);
        $commitment->IdState = 2;
        $commitment->UserUpdated = Auth::user()->username;
        $commitment->DateUpdated = Carbon::now();
        $commitment->save();

        return redirect()->route('commitment.index')->with('success', 'Commitment deleted successfully');
    }

    public function import(Request $request)
    {

        Excel::import(new CommitmentsImport, $request->file);

        return redirect()->route('commitment.index')->with('success', 'Commitments imported successfully');;

    }
}
