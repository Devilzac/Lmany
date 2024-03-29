<a class="navbar-brand" href="{{ url('/') }}">Mystera Legacy Tracker</a>
<nav class="navbar">
      <div id="navbarSupportedContent">            
            <!-- START SEARCH -->
            <form action={{ route('character.search') }} class="d-flex" role="search" method="GET">
                <div class="cntSearch">
                        <input type="search" id="search" name="search" class="form-control" placeholder="Character name..." aria-label="Search">                    
                        <div class="btnAlt">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </div>
                </div>
            </form>            
      </div>
</nav>