@if(isset($groupName))
    <div class="callout callout-default">
        <h4>{{$groupName}}</h4>

        <p><i class="fa fa-tasks"></i> 게시판</p>
    </div>
@endif
{{-- @if(isset($tagName))
    <div class="alert alert-info">
        <p>태그: <strong>{{$tagName}}</strong></p>
    </div>
@endif --}}
@if(isset($authorName))
    <div class="callout callout-warning">
        <h4>{{$authorName}}</h4>

        <p><i class="fa fa-user"></i> 작성자</p>
    </div>
@endif
@if($term = request('term'))
<div class="callout callout-default">
    <h4>{{$term}}</h4>

    <p><i class="fa fa-search"></i> 검색어</p>
</div>
@endif
@if(! $boards->count())
    <div class="callout callout-danger">
        <p><i class="fa fa-warning"></i> 게시판글이 존재하지 않습니다.</p>
    </div>
@endif