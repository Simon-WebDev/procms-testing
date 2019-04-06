<div class="col-md-3">
    <aside class="right-sidebar">
        {{-- <div class="search-widget">
            <form action="{{route('board.index')}}">
                <div class="input-group">
                  <input type="text" class="form-control input-lg" name="term" value="{{request('term')}}" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-lg btn-default" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
            </form>
        </div> --}}

        <div class="widget">
            <div class="widget-heading">
                <h4 class="text-center">게시판</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    
                    @foreach($groups as $group)
                    <li>
                        <a href="{{route('group', $group->slug)}}"><i class="fa fa-angle-right"></i> {{$group->title}}</a>
                        <span class="pull-right"><i class="fa fa-angle-double-right"></i></span>
                        {{-- <span class="badge pull-right">{{$group->boards()->where('is_active',1)->get()->count()
                    }}</span> --}}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </aside>
</div>
