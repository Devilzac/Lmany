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
                        <div class="altAmount">
                            Server: {{$character->server->name}}
                        </div>
                    </div>
            </li>    
            <hr>      
            @endforeach()    
        </ul>           
    </div>
    <div class="out-relate">
    </br>
        <div class="flex-center">
            <form action="{{ url('/api/a-tor-2024')}}" method="post" class="block">    
                @csrf      
                <button class="btn" type="submit">Auto Relation</button>
            </form>
            <form action="{{ url('/api/c-p-h-2024')}}" method="post" class="block">    
                @csrf      
                <button class="btn" type="submit">Clear List</button>
            </form>
        </div>
        
    </div>
@endsection