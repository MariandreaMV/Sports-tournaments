<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\team;
use Illuminate\Http\Request;

class teamsController extends Controller
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

        if (!empty($keyword)) {
            $teams = team::where('team_name', 'LIKE', "%$keyword%")
                ->orWhere('short_name', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('website', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $teams = team::paginate($perPage);
        }

        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.teams.create');
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
        $this->validate($request, [
    			'team_name' => 'required',
    			'short_name' => 'required',
    			'date' => 'required',
    			'email' => 'required'
    		]);
        $requestData = $request->all();

        team::create($requestData);

        return redirect('admin/teams')->with('flash_message', 'team added!');
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
        $team = team::findOrFail($id);

        return view('admin.teams.show', compact('team'));
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
        $team = team::findOrFail($id);

        return view('admin.teams.edit', compact('team'));
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
        $this->validate($request, [
			'team_name' => 'required',
			'short_name' => 'required',
			'date' => 'required',
			'email' => 'required'
		]);
        $requestData = $request->all();

        $team = team::findOrFail($id);
        $team->update($requestData);

        return redirect('admin/teams')->with('flash_message', 'team updated!');
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
        team::destroy($id);

        return redirect('admin/teams')->with('flash_message', 'team deleted!');
    }
}
