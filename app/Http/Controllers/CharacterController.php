<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Character::all();
        return view("character.character_list", compact("characters"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        return view("character.character_create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = new Character();
        $storeResult = $response->saveCharacterIfNoRecoreds($request);
        return redirect()->route('character.index')->with('message', 'Record added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $char = new Character();
        $character =  $char->findById($id);        
        return view("character.character_detail", compact('character'));
    }

    
  
    public function search(Request $request)
    {
        $character = new Character();
        $search_param = $request->query('search');
        $character = $character->findByName($search_param);
        return view('character.character_detail', compact('character'));
      
    }
    public function relationIndex(Request $request)
    {        
        $character = Character::all();
        return view('character.characterRelation', compact('character'));
    }

    public function relationing(Request $request)
    {               
        $mainRelationn = new Character();
        $main = $request->input('main');
        $alt = $request->input('alt');  
        
        $mainRelationn->mainRelation($main, $alt);
        return redirect('/')->with('message', 'Item saved correctly!!!');;
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Character $character)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Character $character)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        //
    }
}
