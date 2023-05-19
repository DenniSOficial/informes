<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Commitment;
use App\Models\ReportCommitment;
use App\Models\ReportManager;
use App\Models\TypeReport;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::where('IdState', 1)->get();
        //dd($reports);
        return view('admin.reports.index')->with('reports', $reports);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $report = new Report();

        $report_commitments = [];

        $commitments = Commitment::where('IdState', 1)
                                    ->orderBy('CodeCommitment')->get();
        
        $report_managers = ReportManager::where('IdState', 1)
                                            ->orderBy('Lastname')
                                            ->orderBy('Lastname2')
                                            ->orderBy('Name')->get();

        $types = TypeReport::where('IdState', 1)
                                ->orderBy('Description')
                                ->pluck('Description', 'IdTypeReport');
        
        $companies = array('QYECO', 'SAG');

        return view('admin.reports.create')
                ->with('report', $report)
                ->with('commitments', $commitments)
                ->with('report_managers', $report_managers)
                ->with('types', $types)
                ->with('companies', $companies)
                ->with('report_commitments', $report_commitments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);

        $data = request()->validate([
            'quote' => 'required',
            'business_id' => 'required',
            'business_name' => 'required',
            'business_executive_code' => 'required',
            'business_executive' => 'required',
            'report_manager' => 'required',
            'type' => 'required',
            'expedition' => 'required',
            'company' => 'required'
        ]);
        
        //dd($request);
        
        $report = new Report();
        $report->IdReportManager = $request->report_manager;
        $report->IdReportStatus = 1;
        $report->IdTypeReport = $request->type;
        $report->IdState = 1;
        $report->IdClient = $request->business_id;
        $report->BusinessName = $request->business_name;
        $report->BusinessExecutiveCode = $request->business_executive_code;
        $report->BusinessExecutive = $request->business_executive;
        $report->QuoteNumber = $request->quote;
        $report->ToName = $request->company;
        $report->Expedition = $request->expedition;
        $report->Notification = $request->notification;
        $report->LaboratoryReportNumber = $request->laboratory;
        $report->UserCreated = Auth::user()->username;
        $report->DateCreated = Carbon::now();
        $report->save();
        //dd($report);
        if (isset($request->commitments)) {
            foreach ($request->commitments as $key => $value) {
                $item = new ReportCommitment();
                $item->IdReport = $report->IdReport;
                $item->IdCommitment = $value;
                $item->IdState = 1;
                $item->UserCreated = Auth::user()->username;
                $item->DateCreated = Carbon::now();
                $item->save();
            }
        }

        return redirect()->route('report.index')->with('success', 'Report registered successfully');
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
        $report = Report::find($id);

        $report_commitments = ReportCommitment::where('IdReport', $report->IdReport)->where('IdState', 1)->get()->toArray();

        $commitments = Commitment::where('IdState', 1)
                                    ->orderBy('CodeCommitment')->get();
        
        $report_managers = ReportManager::where('IdState', 1)
                                            ->orderBy('Lastname')
                                            ->orderBy('Lastname2')
                                            ->orderBy('Name')->get();

        $types = TypeReport::where('IdState', 1)
                                ->orderBy('Description')
                                ->pluck('Description', 'IdTypeReport');
        
        $companies = array('QYECO', 'SAG');

        return view('admin.reports.edit')
                ->with('report', $report)
                ->with('commitments', $commitments)
                ->with('report_managers', $report_managers)
                ->with('types', $types)
                ->with('companies', $companies)
                ->with('report_commitments', $report_commitments);
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
        //dd($request);

        $data = request()->validate([
            'quote' => 'required',
            'business_id' => 'required',
            'business_name' => 'required',
            'business_executive_code' => 'required',
            'business_executive' => 'required',
            'report_manager' => 'required',
            'type' => 'required',
            'expedition' => 'required',
            'company' => 'required'
        ]);
        
        //dd($request);
        
        $report = Report::find($id);
        $report->IdReportManager = $request->report_manager;
        //$report->IdReportStatus = 1;
        $report->IdTypeReport = $request->type;
        $report->IdClient = $request->business_id;
        $report->BusinessName = $request->business_name;
        $report->BusinessExecutiveCode = $request->business_executive_code;
        $report->BusinessExecutive = $request->business_executive;
        $report->QuoteNumber = $request->quote;
        $report->ToName = $request->company;
        $report->Expedition = $request->expedition;
        $report->Notification = $request->notification;
        $report->LaboratoryReportNumber = $request->laboratory;
        $report->UserUpdated = Auth::user()->username;
        $report->DateUpdated = Carbon::now();
        $report->save();
        //dd($report);

        ReportCommitment::where('IdReport', $report->IdReport)->update(['IdState' => 2]);
        //dd($request->commitments);

        if (isset($request->commitments)) {
            foreach ($request->commitments as $key => $value) {

                $find = ReportCommitment::where('IdCommitment', $value)->where('IdReport', $report->IdReport)->first();
                //dd($find);
                if (isset($find)) {
                    $item = ReportCommitment::find($find->IdReportCommitment);
                    //$item->IdReport = $report->IdReport;
                    $item->IdCommitment = $value;
                    $item->IdState = 1;
                    $item->UserUpdated = Auth::user()->username;
                    $item->DateUpdated = Carbon::now();
                    $item->save();
                } else {
                    $item = new ReportCommitment();
                    $item->IdReport = $report->IdReport;
                    $item->IdCommitment = $value;
                    $item->IdState = 1;
                    $item->UserCreated = Auth::user()->username;
                    $item->DateCreated = Carbon::now();
                    $item->save();
                }
                
            }
        }

        return redirect()->route('report.index')->with('success', 'Report registered successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::find($id);
        $report->IdState = 2;
        $report->UserUpdated = Auth::user()->username;
        $report->DateUpdated = Carbon::now();
        $report->save();

        return redirect()->route('report.index')->with('success', 'Report deleted successfully');
    }

    public function document($id)
    {
        dd($id);
    }
}
