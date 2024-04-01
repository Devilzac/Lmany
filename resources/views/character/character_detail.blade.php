@extends('layout')
@section('title', 'Adding Character')
@section('content')
    <div id="container" class="detail">     
        @if (isset($character->name) && !empty($character->name))   
            <!-- START LIST -->
            <ul class="list-flex">
                <li>          
                    @if($character->relatedMainCharactersCount() > 1)
                    <small class="white">>>> Shared Account <<<</small>
                    @endif
                        <div class="charList">                        
                            <img src="{{url('images/'.rand(1, 10).'.webp')}}" alt="{{$character->name}}">
                            <div class="mainCharInfo">
                                <span>
                                {{$character->name}}
                                </span>
                                <span>
                                    {{$character->tribe}}   
                                </span>
                            </div>
                            <div class="altAmount">
                                Related: {{ count($character->relatedCharacters) }}
                                Server: {{$character->server->name}}
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
    @if (isset($character->name) && !empty($character->name))   
        <div id="container" class="detail">       
            <h2>Related</h2>
                <ul class="list-grid">
                    @foreach ($character->relatedCharacters as $alt) 
                        <li class="chip">
                            <a href="{{url('/character/'.$alt->id)}}">
                                <div class="charList">
                                    <img src="{{url('images/'.rand(1, 10).'.webp')}}" alt="{{$alt->name}}">
                                    <div class="mainCharInfo">
                                        <span>
                                        {{$alt->name}} 
                                        </span>
                                        <span>
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