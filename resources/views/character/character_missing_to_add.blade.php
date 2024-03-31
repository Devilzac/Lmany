@extends('layout')
@section('title', 'Characters Relationship')
@section('content')
<div id="container" class="out-relate-cnt">     
        <!-- START LIST -->
        <ul class="list-flex">
            @foreach ($list as $key => $character)    
            <li>
                    <div class="charList">
                        <img class="" src="{{url('images/'.rand(1, 10).'.webp')}}" alt="{{$character->name}}">
                        <div class="mainCharInfo">
                            <span class="">
                                {{$character->character1}}
                            </span>
                            <span class="">
                                {{$character->character2}}
                            </span>
                        </div>
                        <span class="mainCharInfo">{{$character->message}}</span>
                    </div>
            </li>    
            <hr>      
            @endforeach()    
        </ul>           
    </div>
    <div class="out-relate">
        <form action="{{ url('/a-tor-2024')}}" method="post" class="block">    
            @csrf      
            <button class="btn" type="submit">Auto Relation</button>
        </form>
    </div>
@endsection