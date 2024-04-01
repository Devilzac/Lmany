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
        'server',
    ];
    public function autoRelateLeftToRight()
    {
        try {
           // Retrieve pending characters and sort by name in descending order
            $pending = PendingCharacter::orderBy('character1', 'desc')->get();

            foreach ($pending as $p_char) {
                // Find or create left character
                $leftChar = Character::firstOrCreate(['name' => $p_char->character1]);
                $leftChar->server_id = $p_char->server->id;
                $leftChar->save();

                // Find or create right character
                $rChar = Character::firstOrCreate(['name' => $p_char->character2]);
                $rChar->server_id = $p_char->server->id;
                $rChar->save();

                // Relate characters left to right
                if (!$leftChar->relatedCharacters()->where('related_id', $rChar->id)->exists()) {
                    $leftChar->relatedCharacters()->attach($rChar->id);
                    
                    // Delete the pending character after successful relationship attachment
                    $p_char->delete();
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
