<?php

namespace Hassanfayyaz19\Ticketit\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Hassanfayyaz19\Ticketit\Models\Priority;
use Hassanfayyaz19\Ticketit\Helpers\LaravelVersion;

class PrioritiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // seconds expected for L5.8<=, minutes before that
        $time = LaravelVersion::min('5.8') ? 60*60 : 60;
        $priorities = \Cache::remember('ticketit::priorities', $time, function () {
            return Priority::all();
        });

        return view('ticketit::admin.priority.index', compact('priorities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('ticketit::admin.priority.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'color'     => 'required',
        ]);

        $priority = new Priority();
        $priority->create(['name' => $request->name, 'color' => $request->color]);

        Session::flash('status', trans('ticketit::lang.priority-name-has-been-created', ['name' => $request->name]));

        \Cache::forget('ticketit::priorities');

        return redirect()->action('\Hassanfayyaz19\Ticketit\Controllers\PrioritiesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return trans('ticketit::lang.priority-all-tickets-here');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $priority = Priority::findOrFail($id);

        return view('ticketit::admin.priority.edit', compact('priority'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required',
            'color'     => 'required',
        ]);

        $priority = Priority::findOrFail($id);
        $priority->update(['name' => $request->name, 'color' => $request->color]);

        Session::flash('status', trans('ticketit::lang.priority-name-has-been-modified', ['name' => $request->name]));

        \Cache::forget('ticketit::priorities');

        return redirect()->action('\Hassanfayyaz19\Ticketit\Controllers\PrioritiesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $priority = Priority::findOrFail($id);
        $name = $priority->name;
        $priority->delete();

        Session::flash('status', trans('ticketit::lang.priority-name-has-been-deleted', ['name' => $name]));

        \Cache::forget('ticketit::priorities');

        return redirect()->action('\Hassanfayyaz19\Ticketit\Controllers\PrioritiesController@index');
    }
}
