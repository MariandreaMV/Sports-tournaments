<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\tournament;
use Illuminate\Http\Request;

class tournamentsController extends Controller
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
        $allowed = array('id', 'name', 'date', 'status');
        $sort = in_array($request->get('sort'), $allowed) ? $request->get('sort') : 'id';
        $order = $request->get('order') === 'asc' ? 'desc' : 'asc';

        if (!empty($keyword)) {
            $tournaments = tournament::where('name', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $tournaments = tournament::orderBy($sort, $order)->paginate($perPage);
        }

        return view('admin.tournaments.index', [
          'tournaments' => $tournaments,
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
        return view('admin.tournaments.create');
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
			'name' => 'required',
			'date' => 'required',
			'status' => 'required'
		]);
        $requestData = $request->all();

        tournament::create($requestData);

        return redirect('admin/tournaments')->with('flash_message', 'tournament added!');
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
        $tournament = tournament::findOrFail($id);

        return view('admin.tournaments.show', compact('tournament'));
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
        $tournament = tournament::findOrFail($id);

        return view('admin.tournaments.edit', compact('tournament'));
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
			'name' => 'required',
			'date' => 'required',
			'status' => 'required'
		]);
        $requestData = $request->all();

        $tournament = tournament::findOrFail($id);
        $tournament->update($requestData);

        return redirect('admin/tournaments')->with('flash_message', 'tournament updated!');
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
        tournament::destroy($id);

        return redirect('admin/tournaments')->with('flash_message', 'tournament deleted!');
    }
}
