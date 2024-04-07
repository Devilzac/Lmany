@extends('layout')
@section('title', 'Characters Relationship')
@section('content')
  <form  id="container"  action="{{ url('/relationship')}}" method="post" class="block">    
      @csrf      
        <div class="container">                 
          <h3>Mains</h3>
          <div class="row justify-content-between">
            <div class="form-check relation-list">
              @foreach ($character as $char)
                  <div class="flexiCenter">
                    <input name="main[]" class="" type="radio" id="flexSwitch{{$char->name}}" value="{{$char->id}}">
                    <label name="main[]"  class="form-check-label" for="flexSwitch{{$char->name}}">{{$char->name}}</label>
                  </div>
              @endforeach   
            </div>
          </div>
        </div>
      <hr>
        <div class="container">     
          <h3>Alts</h3> 
          <div class="row justify-content-between">          
            <div class="form-check relation-list">
              @foreach ( $character as $altChar)
                  <div class="flexiCenter">
                    <input name="alt[]"  class="" type="checkbox" id="flexCheck{{$altChar->name}}" value="{{$altChar->id}}">
                    <label name="alt[]"  class="form-check-label" for="flexCheck{{$altChar->name}}">{{$altChar->name}}</label>
                  </div>
              @endforeach   
            </div>
          </div>
        </div>
        <hr>
        <button type="submit">Submit</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@endsection