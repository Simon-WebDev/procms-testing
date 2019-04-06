@if(isset($categoryName))
    <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-folder-open"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">카테고리</span>
          <span class="info-box-number">{{$categoryName}}</span>
        </div>
        <!-- /.info-box-content -->
    </div>
@endif
@if(isset($tagName))
    <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-tag"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">태그</span>
          <span class="info-box-number">{{$tagName}}</span>
        </div>
        <!-- /.info-box-content -->
    </div>
@endif
@if(isset($authorName))
    <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">작성자</span>
          <span class="info-box-number">{{$authorName}}</span>
        </div>
        <!-- /.info-box-content -->
    </div>
@endif
@if($term = request('term'))

    <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-search"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">검색어</span>
          <span class="info-box-number">{{$term}}</span>
        </div>
        <!-- /.info-box-content -->
    </div>
@endif
@if(! $posts->count())
    <div class="alert alert-default">
        <p><i class="fa fa-warning"></i> 블로그 글이 존재하지 않습니다.</p>
    </div>

@endif

