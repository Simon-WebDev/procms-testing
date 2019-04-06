<div class="col-md-3">
    <aside class="right-sidebar">
        
        <div class="widget">
            <div class="widget-heading">
                <h4>커뮤니티</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    <li>
                        <a href="{{route('pages.index')}}" class="active iso-filter"><i class="fa fa-angle-right"></i> ALL
                        </a>
                    </li>
                    @foreach($chapters as $chapter)
                    <li>
                        <a href="{{route('chapter', $chapter->id)}}" class="iso-filter"><i class="fa fa-angle-right"></i> {{$chapter->title}}</a>
                        <span class="pull-right"><i class="fa fa-angle-double-right"></i></span>
                       
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        
    </aside>
</div>
