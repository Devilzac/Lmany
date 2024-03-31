<?php
namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Character;
use App\Models\PendingCharacter;
use Illuminate\Http\Request;

class PendingCharacterController extends Controller
{    
    protected $servers;

    public function __construct(Server $servers)
    {
        $this->servers = $servers::all();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(){

        $serversList = $this->servers;

        $allChars = new PendingCharacter();
        $list = $allChars->getList();
        return view("character.character_missing_to_add", compact("list","serversList"));
    }


    
    public function autoRelationing(Request $request)
    {               
        $pending = new PendingCharacter();
        $pending->autoRelateLeftToRight();
        return redirect('/pnd-char')->with('message', 'Item saved correctly!!!');;
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
    public function show(PendingCharacter $pendingCharacter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PendingCharacter $pendingCharacter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PendingCharacter $pendingCharacter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendingCharacter $pendingCharacter)
    {
        //
    }
}
