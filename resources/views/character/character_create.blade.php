@extends('layout')
@section('title', 'Adding Character')
@section('content')

<div id="container" class="add-char">     
    <form action={{ url('/adding-char') }} method="POST">
        @csrf
        <label for="name">Name: </label><input type="text" required placeholder="Character exact name (Case sensitive)" name="name" required id="name">
        <label for="tribe">Tribe: </label><input type="text" required placeholder="Current tribe or NONE if no tribe" name="tribe" required id="tribe">
        <label for="description">Description: </label><input type="text" required placeholder="Small description" name="description" required id="description">
        
        <label>Select server:</label>
        <select name="server_id" class="form-control" required>
            @foreach($serversOptions as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>

        <div>
          <input type="checkbox" value="1" name="main_character" id="main_character">
          <label for="main_character">Is it a main account? </label>
        </div>
        <div>
          <input type="checkbox" value="1" name="ghana" id="ghana">
          <label for="ghana">Is it a troll account? </label>
        </div>
      <button type="submit">Submit</button>
    </form>
</div>

@endsection