<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{Auth::user()->gravatar()}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{Auth::user()->name}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="{{Nav::isRoute('backend.home')}}">
        <a href="{{route('backend.home')}}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview {{Nav::isResource('blog','backend')}} {{Nav::isResource('categories','backend')}}">
        <a href="#">
          <i class="fa fa-pencil"></i>
          <span>블로그</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{Nav::isRoute('backend.blog.index')}}"><a href="{{route('backend.blog.index')}}"><i class="fa fa-circle-o"></i> 블로그</a></li>
          {{-- <li class="{{Nav::isRoute('backend.blog.create')}}"><a href="{{route('backend.blog.create')}}"><i class="fa fa-circle-o"></i> 새 블로그</a></li> --}}
          @if(check_user_permissions(request(), "Categories@index"))
          <li class="{{Nav::isResource('categories','backend')}}"><a href="{{route('backend.categories.index')}}"><i class="fa fa-folder-open"></i><span>카테고리관리</span></a></li>
          @endif
        </ul>
      </li>
      
      
      <li class="{{Nav::isResource('comment','backend')}}"><a href="{{route('backend.comment.index')}}"><i class="fa fa-paint-brush"></i> <span>블로그댓글</span></a></li>

      @if(check_user_permissions(request(), "Users@index"))
      <li class="{{Nav::isResource('users','backend')}}"><a href="{{route('backend.users.index')}}"><i class="fa fa-users"></i> <span>Users</span></a></li>
      @endif

      <li class="{{Nav::isResource('media','backend')}}"><a href="{{route('backend.media.index')}}"><i class="fa fa-image"></i> <span>Media</span></a></li>

      <li class="treeview {{Nav::isResource('board','backend')}} {{Nav::isResource('group','backend')}}">
        <a href="#">
          <i class="fa fa-comments"></i>
          <span>게시판</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{Nav::isRoute('backend.board.index')}}">
              <a href="{{route('backend.board.index')}}"><i class="fa fa-comments"></i> 모든 게시판 <span class="badge pull-right">{{App\Board::count()}}</span></a>
          </li>
          @foreach(App\Group::all() as $group)
          <li class="{{Nav::isRoute('backend.board.index')}}">
              <a href="{{route('backend.board.index',['group_id'=>$group->id])}}"><i class="fa fa-circle-o"></i> {{$group->title}} <span class="badge pull-right">{{$group->boards->count()}}</span></a> 
          </li>
          @endforeach
          <li class="{{Nav::isResource('group','backend')}}"><a href="{{route('backend.group.index')}}"><i class="fa fa-tasks"></i> <span>게시판분류</span></a></li>
        </ul>
        
      </li>
      
      <li class="{{Nav::isResource('answer','backend')}}"><a href="{{route('backend.answer.index')}}"><i class="fa fa-bullhorn"></i> <span>답글</span></a></li>
      <li class="{{Nav::isResource('reservation','backend')}}"><a href="{{route('backend.reservation')}}"><i class="fa fa-calendar"></i> <span>예약</span></a></li>
      <li class="{{Nav::isResource('staff','backend')}}"><a href="{{route('backend.staff.index')}}"><i class="fa fa-user-md"></i> <span>스텝</span></a></li>
      <li class="treeview {{Nav::isResource('page','backend')}} {{Nav::isResource('chapter','backend')}}">
        <a href="#">
            <i class="fa fa-microphone"></i>
            <span>공지사항</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{Nav::isRoute('backend.page.index')}}">
              <a href="{{route('backend.page.index')}}"><i class="fa fa-microphone"></i> 모든 공지사항 <span class="badge pull-right">{{App\Page::count()}}</span></a>
          </li>
          @foreach(App\Chapter::all() as $chapter)
          <li class="{{Nav::isRoute('backend.page.index')}}">
              <a href="{{route('backend.page.index',['chapter_id'=>$chapter->id])}}"><i class="fa fa-circle-o"></i> {{$chapter->title}} <span class="badge pull-right">{{$chapter->pages->count()}}</span></a> 
          </li>
          @endforeach
          <li class="{{Nav::isResource('chapter','backend')}}"><a href="{{route('backend.chapter.index')}}"><i class="fa fa-bell"></i> <span>공지사항분류</span></a></li>
        </ul>
      </li>
      
      <li class="{{Nav::isResource('setting','backend')}}"><a href="{{route('backend.setting.index')}}"><i class="fa fa-wrench"></i> <span>설정</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
