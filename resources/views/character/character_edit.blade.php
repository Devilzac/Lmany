@extends('layout')
@section('title', 'All Characters')
@section('content')

<div id="container" class="edit-cnt detail">  
    <h2>
        {{$character->name}}
    </h2>
    <form action="/char-update/{{ $character->id }}" method="post">
        @csrf
        @method('PUT')
        
        <label for="tribe">Tribe: </label>
        <input type="text" name="tribe" id="tribe" value="{{ $character->tribe }}">

        <label for="description">Character Description: </label>
        <textarea id="description" name="description" rows="4" cols="50">{{ $character->description }}</textarea>

        <div class="flex-checkbox">
            <input type="checkbox" name="main" class="main" id="main" {{ ($character->main_character == 0) ? '' : 'checked' }} value=1>
            <label for="main">Is it a Main account? </label>
        </div>
        
        <div class="flex-checkbox">
            <input type="checkbox" name="ghana" class="ghana" id="ghana" {{ ($character->ghana == 0) ? '' : 'checked' }} value=1>
            <label for="ghana">Is it a troll account? </label>
        </div>

        <button type="submit" class="btn edit">
            {{ __('Submit') }}
        </button>
    </form>   
</div> 
@endsection