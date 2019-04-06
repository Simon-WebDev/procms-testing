<article  id="post-comments">
    <div class="box m-b-50">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-comments"></i> {{$post->commentsNumber('Comment')}}</h3>
        </div>
        
        
        <div class="box-body padding-10">
            <ul class="comments-list">
                @foreach($postComments as $comment)
                <li class="comment-item">
                    <div class="comment-heading clearfix">
                        <div class="comment-author-meta">
                            <h4>{{$comment->author_name}} <small>{{$comment->created_at->format('Y/m/d')}}</small></h4>
                        </div>
                    </div>
                    <div class="comment-content">
                        {!! $comment->body_html !!}
                    </div>
                </li>
                @endforeach
            </ul>
           
            <nav class="text-center">
                {!! $postComments->links() !!}
            </nav>

        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-pencil"></i> 글 작성</h3>
        </div>
        
        @if(session('message'))
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ session('message') }}
            </div>
        @endif
        @include('includes.messages')
        @include('includes.errors')
        <div class="box-body">
        {!! Form::open(['route' => ['blog.comments', $post->slug],'id'=>'comment-form','data-toggle' => "validator",'role'=>'form']) !!}
            <div class="form-group required has-feedback {{ $errors->has('author_name') ? 'has-error' : '' }}">
                <label for="author_name">이름</label>
                {!! Form::text('author_name', null, ['class' => 'form-control','required','id'=>'author_name']) !!}
                @if($errors->has('author_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('author_name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group required has-feedback {{ $errors->has('author_email') ? 'has-error' : '' }}">
                <label for="author_email">이메일</label>
                {!! Form::email('author_email', null, ['class' => 'form-control','required','id'=>'author_email']) !!}
                @if($errors->has('author_email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('author_email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group required has-feedback {{ $errors->has('body') ? 'has-error' : '' }}">
                <label for="body">내용</label>
                {!! Form::textarea('body', null, ['row' => 6, 'class' => 'form-control','required','id'=>'body']) !!}
                @if($errors->has('body'))
                    <span class="help-block">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
            </div>
            <div class="clearfix box-footer">
                <div class="pull-left">
                    <button type="submit" class="btn btn-primary btn-labeled"><span class="btn-label"><i class="fa fa-check"></i></span>확인</button>
                    <a href="{{URL::previous()}}" class="btn btn-default m-l-10 btn-labeled"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>이전</a>
                </div>
                <div class="pull-right">
                    <p class="text-muted">
                        <span class="required">*</span>
                        <em>필수입력사항 입니다.</em>
                    </p>
                </div>
            </div>
        {!! Form::close() !!}
        </div>
    </div>

</article>