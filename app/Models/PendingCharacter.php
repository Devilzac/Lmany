<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PendingCharacter extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'character1',
        'character2',
    ];
    public function autoRelateLeftToRight()
    {
        try {
            $pending = PendingCharacter::all()->sortBy('name', SORT_NATURAL, true);
            foreach ($pending as $p_char) {
                
                $leftChar = Character::where('name', $p_char->character1)->first(); 
                $rChar = Character::where('name', $p_char->character2)->first();   
                $server_id = $p_char->server->id;
            
                // if characters do not exist, create them
                    if(empty($leftChar->name) || isset($leftChar->name) ){
                        Character::firstOrCreate([
                            'name' => $p_char->character1
                            ],
                            [
                                'name' => $p_char->character1,
                                'server_id'=> $server_id
                            ]
                        );
                    }
                    
                    if(empty($rChar->name) || isset($rChar->name) ){
                        Character::firstOrCreate([
                            'name' => $p_char->character2
                            ],
                            [
                                'name' => $p_char->character2,
                                'server_id'=> $server_id
                            ]
                        );
                    }
                    
                    // Update their server
                    $leftChar = Character::where('name', $p_char->character1)->first();                     
                    $leftChar->server_id = $server_id;
                    $leftChar->save();

                    $rChar = Character::where('name', $p_char->character2)->first();                   
                    $rChar->server_id = $server_id;
                    $rChar->save();

                    // Relate characters left to right
                    if(!$leftChar->relatedCharacters()->where('related_id', $rChar->id)->exists()){
                        $leftChar->relatedCharacters()->attach($rChar->id);                 
                    }  

            }
            
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Character not found'], 404);
        }        
    }

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function getList()
    {
        return PendingCharacter::all()->sortBy('character1', SORT_NATURAL, true);
    }

}
