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

    public function newTeam()
    {
        return view('auth.teams.create');
    }

    public function register()
    {
      $teams = Team::all()->where('user_id', \Auth::user()->id);
      $tournaments = Tournament::all()->where('status', 1);
      return view('auth.teams.register', [
        'teams' => $teams,
        'tournaments' => $tournaments
      ]);
    }

    function create(Request $request) {
      $user = $request->user();

      $request->validate([
        'team' => 'required',
        'tournament' => 'required',
        'participants' => 'required|max:15',
        'category' => 'required',
      ]);

      $register = Register::create([
        'tournament_id' => $request->input('tournament'),
        'team_id' => $request->input('team'),
        'n_participants' => $request->input('participants'),
        'category' => $request->input('category')
      ]);

      $teams = Team::all()->where('user_id', \Auth::user()->id);
      $tournaments = Tournament::all()->where('status', 1);

      return view('auth.teams.register', [
        'teams' => $teams,
        'tournaments' => $tournaments,
        'success' => true
      ]);
    }
}
