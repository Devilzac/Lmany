<div class="navbar-plus-filter">            
    <!-- START SEARCH -->
    <form action={{ route('character.search') }} class="d-flex" role="search" method="GET">
        <div class="cntSearch">
            <div class="form-check relation-list">
                @dd($servers)
                @foreach ($servers as $server)
                    <div class="flexiCenter">
                      <input name="main[]" class="" type="radio" id="flexSwitch{{$server->name}}" value="{{$server->id}}">
                      <label name="main[]"  class="form-check-label" for="flexSwitch{{$server->name}}">{{$server->name}}</label>
                    </div>
                @endforeach   
              </div>
              <div class="btnAlt">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
        </div>
    </form>            
</div>  