@extends('layout')
@section('title', 'Adding Character')
@section('content')
    <form action={{ url('/adding-char') }} method="POST">
        @csrf
        <label for="name">Name: </label><input type="text" required placeholder="Main Character Name" name="name" required id="name">
        <label for="tribe">Tribe: </label><input type="text" required placeholder="Current tribe" name="tribe" required id="tribe">
        <label for="description">Description: </label><input type="text" required placeholder="Small description" name="description" required id="description">
       
        <label for="main_character">Is it a main account? </label><input type="checkbox" value="1" name="main_character" id="main_character">
        <label for="ghana">Is it a ghana account? </label><input type="checkbox" value="1" name="ghana" id="ghana">

      <button type="submit">Submit</button>
    </form>
@endsection