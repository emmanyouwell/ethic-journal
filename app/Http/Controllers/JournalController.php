<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use App\Models\User;
use Auth;
use DB;


class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Journal::latest()->where('user_id', auth()->user()->id)->paginate(3);
        $counter = $data->count();
        return view('pdf.export', compact('data','counter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Journal::where('id', $id)->get();
        return view('edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $entry = Journal::find($id);
        $entry->entry = $request['entry'];
        $entry->save();
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        Journal::destroy($id);
        return redirect()->route('home');
    }

    public function saveEntry(Request $request){
        $message = new Journal();
        $message->entry = $request['entry'];
        $message->created_at = now();
        $message->updated_at = now();
        $message->user_id = auth()->user()->id;
        $message->save();
        $mes = Journal::where('user_id',auth()->user()->id)->get();
        return redirect()->route('home');
    }
}
