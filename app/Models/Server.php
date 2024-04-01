<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Server extends Model
{
    use HasFactory;
    
    public function filteredCharacterMainServerSearch($request)
    {
        
        if($request->get('character-type') == null){
            $charType = 0;
        } else {
            $charType = $request->get('character-type');
        }
            $id = $request->selectedServer;
            $result = Server::findOrFail($id);
            $result2 = $result->characters->whereIn('main_character', $charType);
            return $result2;
    }


    public function findServerByExactName($name){
        try {
            $name = strtoupper($name);
            $result =  Server::where('name', '=', $name )->first();
            return $result->id;
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Character not found'], 404);
        }

    }

    public function pendingCharacters()
    {
        return $this->hasMany(PendingCharacter::class);
    }
    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
