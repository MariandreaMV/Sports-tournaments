<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Tournament;
use App\Register;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /*-----------------------teams---------------------------------*/
    public function newTeam()
    {
        return view('auth.teams.create');
    }

    public function newTeamcreate(Request $request) {
     $user = $request->user();

      $request->validate([
        'user_id' => 'required',
        'team_name' => 'required',
        'short_name' => 'required',
        'date' => 'required',
        'address' => 'required',
        'email' => 'required',
      ]);

      $team_name = Team::all()->where('team_name',$request-> input('team_name') );
      $success = false;
      $exists = false;

      if ( sizeof($team_name) == 0) {
        $register = Team::create([
        'user_id' => $request->input('user_id'),
        'team_name' => $request-> input('team_name'),
        'short_name' => $request-> input('short_name'),
        'date' => $request-> input('date'),
        'address' => $request-> input('address'),
        'email' => $request-> input('email'),
        ]);
        $success = true;
      }else{
        $exists = true;
      }
    

     return view('auth.teams.create',['success' => $success, 'exists' => $exists]);
    }
    /*--------------------------end teams----------------------------*/

    /*--------------------tournaments--------------------------------*/
    public function register()
    {
      $teams = Team::all()->where('user_id', \Auth::user()->id);
      $tournaments = Tournament::all()->where('status', 1);
      return view('auth.teams.register', [
        'teams' => $teams,
        'tournaments' => $tournaments
      ]);
    }

    public function create(Request $request) {
      $user = $request->user();

      $request->validate([
        'team' => 'required',
        'tournament' => 'required',
        'participants' => 'required|max:15',
        'category' => 'required',
      ]);
     
      $team = Register::all()->where('team_id', $request->input('team'));
      $exists = false;
      $success = false;

      foreach ($team as $team) {
        if ($team->category == $request->input('category')) {
          $exists = true;
        }
      }

      if ($exists == false ) {
        $register = Register::create([
        'tournament_id' => $request->input('tournament'),
        'team_id' => $request->input('team'),
        'n_participants' => $request->input('participants'),
        'category' => $request->input('category')
        ]);
        $success = true;
      }
      /*
      $teams = Team::all()->where('user_id', \Auth::user()->id);
      $tournaments = Tournament::all()->where('status', 1);
      
      return view('auth.teams.register', [
        'teams' => $teams,
        'tournaments' => $tournaments,
        'success' => $success,
        'exists' => $exists
      ]);*/
      
      $team = Team::where('id', $request->input('team'))->first();
      $tournaments = Register::all()->where('team_id', $team->id);
      return view('auth.teams.show',[
          'team'=>$team->team_name,
          'tournaments' => $tournaments
        ]);
      
    }

    public function showT($id){
       
        $tournament = tournament::findOrFail($id);

        return view('auth.tournaments.show', compact('tournament'));

    }


    /*--------------------end tournaments-----------------------------*/
}
