<?php

namespace App\Http\Controllers;


use App\Models\dailyMenu;
use App\Models\dish;
use App\Models\category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dagmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menucards = dailyMenu::all();
        $dishes = dish::all();
        $categories = category::all();
        return view('dagmenus.index')->with('menucards',$menucards)->with('dishes',$dishes)->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = 1;
        $old_string = $request->input('old_string');
        $new_string = $request->input('new_string');

        // Replace "old_string" with "new_string" in the "name" column
        DB::update("UPDATE daily_menus SET dishes_id = REPLACE(dishes_id, ?, ?) WHERE id = ?", [$old_string, $new_string, $id]);



        $menucards = dailyMenu::all();
        $dishes = dish::all();
        $categories = category::all();
        return view('dagmenus.index')->with('menucards',$menucards)->with('dishes',$dishes)->with('categories',$categories);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
