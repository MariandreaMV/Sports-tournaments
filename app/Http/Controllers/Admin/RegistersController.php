<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Team;
use App\Tournament;
use App\Register;
use Illuminate\Http\Request;

class RegistersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        $allowed = array('id', 'tournament_id', 'team_id', 'n_participants', 'category');
        $sort = in_array($request->get('sort'), $allowed) ? $request->get('sort') : 'id';
        $order = $request->get('order') === 'asc' ? 'desc' : 'asc';

        if (!empty($keyword)) {
            $registers = Register::where('tournament_id', 'LIKE', "%$keyword%")
                ->orWhere('team_id', 'LIKE', "%$keyword%")
                ->orWhere('n_participants', 'LIKE', "%$keyword%")
                ->orWhere('category', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $registers = Register::orderBy($sort, $order)->paginate($perPage);
        }

        return view('admin.registers.index', [
          'registers' => $registers,
          'order' => $order
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $teams = Team::all();
        $tournaments = Tournament::all()->where('status', 1);
        return view('admin.registers.create', [
          'teams' => $teams,
          'tournaments' => $tournaments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        Register::create($requestData);

        return redirect('admin/registers')->with('flash_message', 'Register added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $register = Register::findOrFail($id);
        $team = Team::where('id', $register->team_id)->first();
        $tournament = Tournament::where('id', $register->tournament_id)->first();
        return view('admin.registers.show', [
          'register' => $register,
          'tournament' => $tournament,
          'team' => $team
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $register = Register::findOrFail($id);
        $team = Team::where('id', $register->team_id)->first();
        $tournament = Tournament::where('id', $register->tournament_id)->first();
        return view('admin.registers.edit', [
          'register' => $register,
          'tournament' => $tournament,
          'team' => $team
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $register = Register::findOrFail($id);
        $register->update($requestData);

        return redirect('admin/registers')->with('flash_message', 'Register updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Register::destroy($id);

        return redirect('admin/registers')->with('flash_message', 'Register deleted!');
    }
}
