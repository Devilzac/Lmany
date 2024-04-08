@extends('layout')
@section('title', 'Adding Character')
@section('content')
    <div id="container" class="detail">     
        @if (isset($character->name) && !empty($character->name))   
            <div class="edit-cnt">
                <a class="btn edit" href="{{ url('/char/' . $character->id . '/edit') }}">Edit</a>
            </div>
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
                                Related: {{ count($character->relatedCharacters) }}</br>
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
                @auth                    
                    {{-- <hr>
                    <h5>Confirmation Message:</h5>
                    <li>
                        <div class="charList">
                            <div class="mainCharInfo msg">
                                @foreach ($character->relatedCharacters as $alt)                               
                                    <small>{{$character->name}} has returned. (same IP as {{$alt->name}})</small>
                                @endforeach()    
                            </div>
                        </div>
                    </li>  --}}
                @endauth
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
                                    @guest
                                        <img src="{{url('images/'.rand(1, 10).'.webp')}}" alt="{{$alt->name}}">
                                    @endguest
                                    <div class="mainCharInfo">
                                        <span>
                                        {{$alt->name}} 
                                        </span>
                                        <span>
                                            {{$alt->tribe}}
                                        </span>
                                    </div>
                                    @auth
                                        @if(auth()->user()->is_admin)
                                            <form method="post" action="{{ url('/unlink/'. $character->id . '/' . $alt->id) }} ">
                                                @csrf                              
                                                <button type="submit" class="btn unlink-character">
                                                </button>
                                            </form>
                                        @endif
                                    @endauth                                  
                                </div>
                            </a>
                        </li>      
                    @endforeach()    
                </ul>       
        </div>
    @endif


    
    @auth()
        <script>
            $('.unlink-character').click(function(e){
                e.preventDefault();
                if (confirm('Are you sure you want to unlink this Alt?')) {
                $(e.target).closest('form').submit();
            }
            });
        </script>    
    @endauth
@endsection