<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tribe',
        'description',
        'main_character',
        'ghana'
    ];

    public function findById($id){
        try {
            $result = Character::findOrFail($id);
            return $result;
        } catch (ModelNotFoundException $e) {
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
}
