@if(isset($categoryName))
    <div class="alert alert-info">
        <p>카테고리: <strong>{{$categoryName}}</strong></p>
    </div>
@endif
@if(isset($authorName))
    <div class="alert alert-info">
        <p>작성자: <strong>{{$authorName}}</strong></p>
    </div>
@endif
@if($term = request('term'))
    <div class="alert alert-info">
        <p>검색어: <strong>{{$term}}</strong></p>
    </div>
@endif
@if(! $posts->count())
    <div class="alert alert-default">
        <p>포스트가 존재하지 않습니다.</p>
    </div>
@endif