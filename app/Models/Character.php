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
            $result =  Character::where('name', 'like', '%' . $search_param . '%')->paginate(15);
            return $result;
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Character not found'], 404);
        }
    }

    
    public function findOrCreateByExactName($search_param, $serv){
        try {
          
            $result = Character::firstOrCreate(['name' => $search_param]);
            $result->server_id = $serv;
            $result->save();           

            return $result;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Character not found'], 404);
        }
    }
    
 
    public function saveCharacterIfNoRecoreds($data)
    {
        $result = Character::firstOrCreate([
            'name' => $data->input('name')
            ],
            [
                'name' => $data->input('name'),
                'tribe' =>  $data->input('tribe'),
                'description' => $data->input('description'),
                'main_character' => $data->has('main_character'),
                'ghana' => $data->has('ghana')
            ]
        );
        return $result;
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
