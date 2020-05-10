<?php

namespace App\Http\Controllers\Backend\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MatchSchedule\MatchSchedule;
use App\Models\RegisterTeam\RegisterTeam;
use App\Models\Tournament\Tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OperationController extends Controller
{
   function generateSchedule(){
       $tournamentID = '1';
       $teamData = RegisterTeam::select(['*'])
           ->where('tournament_id',$tournamentID)->get();
       $array_elems_to_combine = array();

        foreach ($teamData as $val){
           array_push($array_elems_to_combine,$val->id);
       }

       $generatedTeamArray = array();

       for($i=0;$i<1000;$i++){
               $random_keys=array_rand($array_elems_to_combine,2);
               if(in_array([$random_keys[0],$random_keys[1]],$generatedTeamArray)){

               }else{
                   array_push($generatedTeamArray,[
                       $random_keys[0],
                       $random_keys[1],
                   ]);

                   $createMatchSchedule = new MatchSchedule();
                   $createMatchSchedule->tournament_id = $tournamentID;
                   $createMatchSchedule->team_1 = $array_elems_to_combine[$random_keys[0]];
                   $createMatchSchedule->team_2 =  $array_elems_to_combine[$random_keys[1]];
                   $createMatchSchedule->created_by = \Auth::user()->id;
                   $createMatchSchedule->created_at = Carbon::now();
                   $createMatchSchedule->save();
               }
               if(count($generatedTeamArray)>10){
                   break;
               }
       }


       return $generatedTeamArray;

   }

   public function matchScheduleView(){
       return view('backend.matchSchedule.index');
   }



    //populate data for getData_matchSchedule datatable
    public function getData_matchSchedule(){
        $matchDetails = MatchSchedule::all();
        return datatables()->of($matchDetails)
            ->addColumn('tournament', function ($matchDetails){
                    return Tournament::find($matchDetails->tournament_id)->display_name;
            })
            ->addColumn('team_1', function ($matchDetails){
                return RegisterTeam::find($matchDetails->team_1)->display_name;
            })
            ->addColumn('team_2', function ($matchDetails){
                return RegisterTeam::find($matchDetails->team_2)->display_name;
            })
            ->addColumn('action', function ($matchDetails){
                return view('backend.matchSchedule.matchEditBtn',['data'=>$matchDetails])->render();
            })


            ->rawColumns(['action'])
            ->make(true);
    }

    public function addPointsView($matchID){
      $matchDetails =  MatchSchedule::find($matchID);
      $team01 = RegisterTeam::find($matchDetails->team_1);
      $team02 = RegisterTeam::find($matchDetails->team_2);
        return view('backend.matchSchedule.addPoints')->with([
            'team01'=>$team01,
            'team02'=>$team02,
        ]);
    }


    function addPoints(Request $request){
       $team_id = $request->get('team_id');
        $TeamDetails = RegisterTeam::find($team_id);
        $TeamDetails->trys = $request->get('trys');
        $TeamDetails->conversions = $request->get('conversions');
        $TeamDetails->update();




    }
}
