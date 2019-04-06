<article class="box box-default m-t-50" id="post-comments">
    <div class="box-header with-border">
        @php
        $answers = $board->answers()->where('is_active',1)->paginate(5);
        @endphp
        <h3 class="box-title"><i class="fa fa-comments"></i>{{--  ({{$answers->count()}}) --}}</h3>
    </div>
    <div class="comment-body padding-10">
       {{--  @include('includes.messages') --}}
        <ul class="comments-list">
            @foreach($answers as $answer)
            <li class="comment-item">
                <div class="comment-heading clearfix">
                    <div class="comment-author-meta">
                        <h4 class="pull-left">{{$answer->user->name}} <small>{{$answer->created_at->format('Y/m/d H:i')}}</small></h4>
                    </div>
                    @if(Auth::user()->hasRole(['admin','editor','author']))
                    <div class="pull-right">
                        {!! Form::open(['method'=>'delete','action'=>['AnswersController@destroy',$answer->id],'style'=>'display:inline']) !!}
                             <button type="submit" class="btn btn-default btn-sm" onclick="return(confirm('정말 삭제하시겠습니까?'))"><i class="fa fa-trash"></i></button>
                        {!! Form::close() !!} 
                    </div>
                    @endif
                </div>
                <div class="comment-content">
                    {!! $answer->body_html !!}
                </div>
            </li>
            @endforeach
        </ul>
        <nav class="text-center">
            {!! $answers->links() !!}
        </nav>

    </div>
    @if(Auth::user()->hasRole(['admin','editor','author']))
    <div class="box m-t-50">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pencil"></i> </h3>
        </div>
        <div class="box-body">
        {{-- @if(session('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
        @endif --}}
       
        @include('includes.errors')
       
        {!! Form::open(['method'=>'post','action'=>'AnswersController@store','data-toggle' => "validator"]) !!}
         <div class="form-group required has-feedback {{ $errors->has('body') ? 'has-error' : '' }}">
           <input type="hidden" name="board_id" value="{{$board->id}}">
           {!!  Form::label('body','내용')  !!}
           {!!  Form::textarea('body', null, ['class'=>'form-control','required'])  !!}
           @if($errors->has('body'))
               <span class="help-block form-group-feedback" aria-hidden="true">
                   <strong>{{ $errors->first('body') }}</strong>
               </span>
           @endif
         </div>
         <div class="box-footer">
             <div class="form-group">
               <button type="submit" class="btn btn-primary btn-labeled"><span class="btn-label"><i class="fa fa-check"></i></span>확인</button>
               
               <a href="{{route('board.index')}}" class="btn btn-warning m-l-10 btn-labeled"><span class="btn-label"><i class="fa fa-list"></i></span>목록</a>
             </div>
         </div>
        {!! Form::close() !!} 
        </div>
    </div>
    @endif
</article>

