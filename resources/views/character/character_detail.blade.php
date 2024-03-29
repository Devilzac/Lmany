@extends('layout')
@section('title', 'Adding Character')
@section('content')
    <div id="container" class="detail">     
        @if (isset($character))     
            <h1>Main</h1>
            <!-- START LIST -->
            <ul class="list-flex">
                <li>          
                        <div class="charList">                        
                            <img class="" src="{{url('images/'.rand(1, 10).'.webp')}}" alt="{{$character->name}}">
                            <div class="mainCharInfo">
                                <span class="">
                                {{$character->name}}
                                </span>
                                <span class="">
                                    {{$character->tribe}}
                                </span>
                            </div>
                            <div class="altAmount">
                                Alt: {{ count($character->relatedCharacters) }} 
                            </div>
                        </div>   
                </li>    
                <hr>
                
                <h3>Description</h3>
                <li>
                    <div class="charList">
                        <div class="mainCharInfo description">
                            {{$character->description}}
                        </div>
                    </div>
                </li> 
            </ul>   
        @else        
            <h3>There is no character with that name. </h3>              
        @endif

    </div>    
    @if (isset($character))   
        <div id="container" class="detail">       
            <h2>Alts</h2>
                <ul class="list-grid">
                    @foreach ($character->relatedCharacters as $alt) 
                        <li class="chip">
                            <a href="{{url('/character/'.$alt->id)}}">
                                <div class="charList">
                                    <img class="" src="{{url('images/'.rand(1, 10).'.webp')}}" alt="{{$alt->name}}">
                                    <div class="mainCharInfo">
                                        <span class="">
                                        {{$alt->name}} 
                                        </span>
                                        <span class="">
                                            {{$alt->tribe}}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>      
                    @endforeach()    
                </ul>       
        </div>
    @endif
@endsection