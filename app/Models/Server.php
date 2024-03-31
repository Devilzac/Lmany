<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
            //eturn $cases->paginate(1);

    }
    
    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
