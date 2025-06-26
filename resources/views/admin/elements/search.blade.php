<div class="row">
      <div class="col-md-12">
        <div class="m-box d-flex">
    <div class="search-wrapper search-btns-group d-flex">
      <form action="{{route($route)}}" method="GET" >
        <input type="text" name="search" class="form-control ticket-search" placeholder="Search Here..">
        <button type="submit" class="btn btn-search">Search</button>
      <a href="{{route($route)}}" class="btn btn-search btn-reset">Reset</a>
      </form>
    </div>
        </div>
      </div>
    </div>
<div class="row">
  <div class="col-md-12">
    @if($search != '')
    <h3 class="search-for">Search for : {{$search}}</h3>
  @endif
  </div>
</div>