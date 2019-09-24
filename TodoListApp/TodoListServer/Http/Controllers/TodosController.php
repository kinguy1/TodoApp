<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class TodosController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$activeTodos = DB::table('todos')->where('isDone', 0)->get();
        $activeTodos = DB::table('todos')->get();
        return $activeTodos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$input = $request->all();

        //return response()->json(['success'=>'Got Simple Ajax Request.']);
        DB::table('todos')->insert(
            ['title' => $request->input('title'), 'isDone' => $request->input('isDone')]
        );
    }

    public function update(Request $request, $id)
    {
        DB::table('todos')
            ->where('id',  $id)
            ->update(
                ['title' => $request->input('title'), 'isDone' => $request->input('isDone')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('todos')->where('id',  $id)->delete();
    }
}
