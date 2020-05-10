<?php

namespace App\Http\Controllers\Backend\MasterData;

use App\Http\Controllers\Controller;
use App\Models\RegisterTeam\RegisterTeam;
use App\Models\Tournament\Tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;

class TeamController extends Controller
{
    public function index(){
        $tournaments = Tournament::all();
        return view('backend.team.index')->with([
            'tournaments'=>$tournaments
        ]);
    }

    public function store(Request $request){
        $tournamentID = $request->get('tournament_id');
       $countRegTeams = RegisterTeam::select(['*'])->where('tournament_id', $tournamentID)->get()->count();

       if($countRegTeams >= 5){

           return Redirect::route('admin.reg_team.index')->withFlashDanger('Tournament Team Limit Fullfilled!');
       }else{
           $newTeamReg = new RegisterTeam();
           $newTeamReg->tournament_id =$tournamentID;
           $newTeamReg->display_name = $request->get('display_name');
           $newTeamReg->created_by = \Auth::user()->id;
           $newTeamReg->created_at = Carbon::now();
           $newTeamReg->save();
           return Redirect::route('admin.reg_team.index')->withFlashSuccess('Team has been Registered!');

       }



    }
    //populate data for Teams datatable
    public function getData_teams(){
        $teamDetails = RegisterTeam::all();
        return datatables()->of($teamDetails)
            ->addColumn('tournament', function ($teamDetails){
                return Tournament::find($teamDetails->tournament_id)->display_name;
            })
            ->rawColumns(['tournament'])
            ->make(true);
    }
}
