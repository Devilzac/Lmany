<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class Character extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'tribe',
        'description',
        'main_character',
        'ghana',
        'main',
        'alt'
    ];
    

    protected $casts = [
        'main'=>[],
        'alt'=>[]
    ];

    public function mainRelation($idMain, $alts)
    {
        try {
            $main = Character::findOrFail($idMain);
                // Ensure $alts is an array
            // if (!is_array($alts)) {
            //     // Handle invalid input
            //     return response()->json(['error' => 'Invalid input'], 400);
            // }
            foreach ($main as $char) {
                foreach ($alts as $alt_id) {
                    if(!$char->relatedCharacters()->where('related_id', $alt_id)->exists()){
                        $char->relatedCharacters()->attach($alt_id);                 
                    }
                    
                    $alt = Character::findOrFail($alt_id);
                    if(!$alt->relatedCharacters()->where('related_id', $char->id)->exists()){
                        $alt->relatedCharacters()->attach($char->id);                 
                    }
            
                }
            }
            
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Character not found'], 404);
        }
    }

    public function findById($id){
        try {
            $result = Character::findOrFail($id);
            return $result;
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Character not found'], 404);
        }
    }
    
    public function findByName($search_param){
        try {
            $result = Character::where('name', 'like', '%' . $search_param . '%')
            ->orderBy('name', 'asc') // Order alphabetically by name
            ->paginate(15);
            return $result;
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Character not found'], 404);
        }
    }

    
    public function findOrCreateByExactNameAndServer($search_param, $serv){
        try {
          
            $result = Character::firstOrNew([
                'name' => $search_param,
                'server_id' => $serv
            ]);
            
            if (!$result->exists) {
                $result->server_id = $serv;
                $result->save();
            }     
 
            return $result;

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Character not found'], 404);
        }
    }
    
 
    public function saveCharacterIfNoRecoreds($data)
    {
        $result = Character::firstOrNew([
            'name' => $data->input('name'),
            'server_id' => $data->input('server_id')
            ]
        );

        if (!$result->exists) {
            $name = str_replace(' ', '', $data->input('name'));
            $result->name = $name;
            $result->tribe = $data->input('tribe');
            $result->description = $data->input('description');
            $result->server_id = $data->input('server_id');
            $result->main_character = $data->has('main_character');
            $result->ghana = $data->has('ghana');
            $result->save();
        }     
        
        return $result;
    }


    
    public function unlink($mainid,$altid)
    {
        try {
            $principal = Character::find($mainid); 
            $secondary = Character::find($altid);
            $result = $principal->relatedCharacters()->detach($secondary->id); // Detach a related character from principal Left to right
            $result2 = $secondary->relatedCharacters()->detach($principal->id); // Detach a related character from secondary Right to Left
            return $result;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'error' => 'Cant Unlink',
                'result'=> $result,
                'result2'=> $result2,
            ], 400);
        }
    }
    


    public function relatedCharacters()
    {
        return $this->belongsToMany(Character::class, 'character_character', 'character_id', 'related_id')->withTimestamps();
    }
    
    public function relatedMainCharactersCount()
    {   
        return $this->belongsToMany(Character::class, 'character_character', 'character_id', 'related_id')
        ->where('characters.main_character', 1)
        ->withTimestamps()->count();
    }
    
    public function server()
    {
        return $this->belongsTo(Server::class);
    }
    
}
