<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use DB;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $mes = Journal::latest()->where('user_id',auth()->user()->id)->paginate(3);
 
      
        
        // $mes = DB::table('journal')->select(DB::raw('ROW_NUMBER() OVER(ORDER BY CREATED_AT DESC) AS Row,id, entry, created_at'))->where('user_id', auth()->user()->id)->paginate(3);
        // dd($mes);
        
        $counter = $mes->count();
        return view('home', compact('mes'));
    }
}
