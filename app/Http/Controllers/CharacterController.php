<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Character;
use App\Models\PendingCharacter;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    protected $servers;
    protected $totalCharacters;

    public function __construct(Server $servers)
    {
        $this->servers = $servers::all();
        $this->totalCharacters = Character::count();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {         
        $totalCharacters = $this->totalCharacters;
        $serversList = $this->servers;
        $characters =  Character::orderBy('name', 'asc')->paginate(50);
        $search=false;
        return view("character.character_list", compact("characters", "serversList","search","totalCharacters"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        $serversList = $this->servers;        
        $serversOptions = Server::pluck('name', 'id');
        return view("character.character_create", compact('serversList','serversOptions'));
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
        $serversList = $this->servers;
        $char = new Character();
        $character =  $char->findById($id);        
        return view("character.character_detail", compact('character','serversList'));
    }

    
  
    public function search(Request $request)
    {
        $totalCharacters = $this->totalCharacters;
        $serversList = $this->servers;
        $character = new Character();
        $search_param = $request->query('search');
        $characters = $character->findByName($search_param);
        $search=true;
        return view('character.character_list', compact('characters','serversList','search','search_param', 'totalCharacters'));
      
    }

    public function filterSearch(Request $request){      
        if($request->get('character-type') == null){
            $charType = 0;
        } else {
            $charType = $request->get('character-type');
        }
        $s = $request->selectedServer;
        return redirect()->route('character.filterserv', ['serverid' => $s, 'chartype' => $charType]);
    
    }

    public function fServer($serverid, $chartype){
        
        $serversList = $this->servers;
        $characters = Character::where('main_character', $chartype)
                                ->where('server_id', $serverid)
                                ->orderBy('name', 'asc')
                                ->paginate(50);
        $search=true;
        return view('character.character_server_list', compact('characters','serversList', 'search','serversList'));      
    }

    public function relationIndex(Request $request)
    {        
        $serversList = $this->servers;
        $character = Character::all();
        return view('character.character_relation', compact('character','serversList'));
    }

    public function relationing(Request $request)
    {               
        $mainRelationn = new Character();
        $main = $request->input('main');
        $alt = $request->input('alt');  
        
        $mainRelationn->mainRelation($main, $alt);
        return redirect('/')->with('message', 'Item saved correctly!!!');;
    }
    
    public function unlink($mainid,$altid)
    {
        $character = new Character();
        $result = $character->unlink($mainid,$altid); 
        return redirect()->back()->with('message', 'Character Unlinked correctly!!!');;;
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $serversList = $this->servers;
        $character = Character::find($id);
        return view('character.character_edit', compact('character','serversList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        if($request->get('main') == null){
            $main = 0;
        } else {
            $main = $request->get('main');
        }
        
        if($request->get('ghana') == null){
            $ghana = 0;
        } else {
            $ghana = $request->get('ghana');
        }

        $char = Character::find($id);
        $char->tribe = $request->input('tribe');
        $char->description = $request->input('description');
        $char->main_character = $main;
        $char->ghana = $ghana;
        $char->save();

        return redirect('/character/'.$id)->with('message', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        //
    }

    public function syncRelatedCharacters()
    {
        // Get all characters
        $characters = Character::all();

        // Loop through each character
        foreach ($characters as $character) {
            // Get the related characters for the current character
            $relatedCharacters = $character->relatedCharacters()->pluck('id');
            // Loop through each related character ID
            foreach ($relatedCharacters as $relatedId) {
                // Find the related character
                $relatedCharacter = Character::findOrFail($relatedId);

                // Check if the related character is already related to the current character
                if (!$relatedCharacter->relatedCharacters()->where('related_id', $character->id)->exists()) {
                    // If not, attach the current character to the related character
               
                    $relatedCharacter->relatedCharacters()->attach($character->id);
                }
            }
        }

        return response()->json(['message' => 'Related characters synced successfully']);
    }
}
