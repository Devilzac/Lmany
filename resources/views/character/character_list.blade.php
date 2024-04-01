@extends('layout')
@section('title', 'All Characters')
@section('content')
    @if (session('message'))
    <div class="alert">{{ session('message') }}</div>
    @endif    
    <div id="container" class="main-list">     
        <!-- START LIST -->
        <ul class="list-flex">
            @if (count($characters)>0)                
                @foreach ($characters as $key => $character)    
                <li>
                    <a href="{{url('/character/'.$character->id)}}">
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
                                Related: {{ count($character->relatedCharacters) }}</br>
                                Server: {{$character->server->name}}
                            </div>
                        </div>
                    </a>
                </li>    
                <hr>      
                @endforeach()  
                
                @else
                    <h3>
                        No Characters Found!
                    </h3>  
                @endif
        </ul> 
    </div>   
    <div class="out-relate">     
        @if($characters instanceof \Illuminate\Pagination\LengthAwarePaginator )
            {{ $characters->links('pagination::bootstrap-4') }}
        @endif
    </div>
@endsection