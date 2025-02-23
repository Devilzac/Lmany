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

        if (empty($data['character1']) || empty($data['character1']) || empty($data['server'])) {            
            return response()->json(['error' => 'Invalid input'], 400);
        }

        $character1 = $data['character1'];
        $character2 = $data['character2'];
        $ss = $data['server'];

        $character = new Character();
        $server = new Server();
        $serverID = $server->findServerByExactName($ss);
       
        $primaryCharacter = $character->findOrCreateByExactNameAndServer($character1, $serverID);
        $secondaryCharacter = $character->findOrCreateByExactNameAndServer($character2, $serverID);
    
        if(!$primaryCharacter->relatedCharacters()->where('related_id', $secondaryCharacter->id)->exists()){ 
            try {
                $resPen = PendingCharacter::firstOrCreate([
                    'character1' => $character1,
                    'character2' => $character2
                ]);
                $resPen->server_id = $serverID;                    
                $resPen->save();   

            } catch (Exception $e) {
                Log::error($e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } else {
            // Increment find_count for both relationships (bidirectional)
            try {
                $primaryCharacter->relatedCharacters()->updateExistingPivot($secondaryCharacter->id, [
                    'find_count' => \DB::raw('find_count + 1')
                ]);
                
                $secondaryCharacter->relatedCharacters()->updateExistingPivot($primaryCharacter->id, [
                    'find_count' => \DB::raw('find_count + 1')
                ]);
            } catch (Exception $e) {
                Log::error($e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
       
       return response()->json(['message' => "All went smooth"]);
    }


    public function clearPendingCharacter()
    {              
        $pendingCharacters = PendingCharacter::all(); 

        foreach ($pendingCharacters as $character) {
            $character->delete();
        }
        
       return response()->json(['message' => "All went smooth"]);
    }

    public function relationing(Request $request)
    {      
        
        $data = $request->json()->all(); 

        if (empty($data['character1']) || empty($data['character2']) || empty($data['server'])) {            
            return response()->json(['error' => 'Invalid input'], 400);
        }

        $character1 = $data['character1'];
        $character2 = $data['character2'];
        $ss = $data['server'];

        $character = new Character();
        $server = new Server();
        $serverID = $server->findServerByExactName($ss);
       
        $primaryCharacter = $character->findOrCreateByExactNameAndServer($character1, $serverID);
        $secondaryCharacter = $character->findOrCreateByExactNameAndServer($character2, $serverID);
    
        try {
            if(!$primaryCharacter->relatedCharacters()->where('related_id', $secondaryCharacter->id)->exists()){ 
                // Create new relationship with find_count = 1
                $primaryCharacter->relatedCharacters()->attach($secondaryCharacter->id, ['find_count' => 1]);     
                $secondaryCharacter->relatedCharacters()->attach($primaryCharacter->id, ['find_count' => 1]);  
            } else {
                // Increment existing relationship's find_count
                $primaryCharacter->relatedCharacters()->updateExistingPivot($secondaryCharacter->id, [
                    'find_count' => \DB::raw('find_count + 1')
                ]);
                
                $secondaryCharacter->relatedCharacters()->updateExistingPivot($primaryCharacter->id, [
                    'find_count' => \DB::raw('find_count + 1')
                ]);
            }

            // Create or update pending character
            $resPen = PendingCharacter::firstOrCreate([
                'character1' => $character1,
                'character2' => $character2
            ]);
            $resPen->server_id = $serverID;                    
            $resPen->save();   

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }

       return response()->json(['message' => "All went smooth"]);
    }
    
    

}
