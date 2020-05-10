<?php

namespace App\Http\Controllers\Backend\MasterData;

use App\Http\Controllers\Controller;
use App\Models\RegisterTeam\RegisterTeam;
use App\Models\Tournament\Tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use File;
use Illuminate\Support\Facades\Storage;
class TournamentController extends Controller
{
    public function index(){
        return view('backend.tournament.index');
    }
    public function store(Request $request){
        $newTournament = new Tournament();
        $newTournament->display_name = $request->get('display_name');
        $newTournament->created_by = \Auth::user()->id;
        $newTournament->created_at = Carbon::now();

        //Upload logo
        $file = $request->file('logo');
        $filename ="logo-". $request->get('display_name')."_".Carbon::now()->format('YmdHs').'.' . $file->getClientOriginalExtension();
        $mainpath = '/TournamentLogo/' .  $request->country;
        Storage::disk('public')->makeDirectory($mainpath);
        $storestatus = Storage::disk('public')->put($mainpath . '/' . $filename, File::get($file));
        $uploadedPath = $mainpath . '/' . $filename;

        $newTournament->logo = $uploadedPath;
        $newTournament->save();
        return Redirect::route('admin.tournament.index')->withFlashSuccess('Tournament has been created!');

    }
    //populate data for tournament datatable
    public function getData_tournaments(){
        $tournamentDetails = Tournament::all();
        return datatables()->of($tournamentDetails)
            ->addColumn('tournament_count_cap', function ($tournamentDetails){
                $countRegTeams = RegisterTeam::select(['id'])->where('tournament_id', $tournamentDetails->id)
                    ->get()->count();
                if($countRegTeams>=5){
                    return '<span class="label label-warning">Limit Filled</span>';
                }else{
                    return '<span class="label label-success">Approving Teams</span>';
                }

            })

            ->rawColumns(['tournament_count_cap'])
            ->make(true);
    }
}
