<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\PendingCharacter;
use App\Models\Server;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{

    public function handle(Request $request){
       $data = $request->json()->all(); 

        $character1 = $data['character1'];
        $character2 =$data['character2'];
        $ss = $data['server'];

        $character = new Character();
        $server = new Server();
        $serverID = $server->findServerByExactName($ss);
       
        $primaryCharacter = $character->findOrCreateByExactName($character1, $serverID);
        $secondaryCharacter = $character->findOrCreateByExactName($character2, $serverID);
    
            if(!$primaryCharacter->relatedCharacters()->where('related_id', $secondaryCharacter->id)->exists()){ 
               
                try {
                    $resPen = PendingCharacter::firstOrCreate([
                        'character1' => $character1,
                        'character2' => $character2
                    ]);
                    $resPen->server_id = $serverID;                    
                    $resPen->save();   

                } catch (Exception $e) {
                    // Log the exception
                    Log::error($e->getMessage());
                    // Return an error response
                    return response()->json(['error' => $e->getMessage()], 500);
                }
           }
       
       return response()->json(['message' => "All went smooth"]);
    }
}
