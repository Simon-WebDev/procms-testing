@extends('layouts.backend.main')
@section('title')

@section('content')
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          회원관리
          <small>삭제 세부사항</small>
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href="{{ url('/backend/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="{{ route('backend.users.index') }}">회원관리</a></li>
          <li class="active">삭제세부사항</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
          <div class="row">
              {!! Form::model($user, [
                  'method' => 'DELETE',
                  'route'  => ['backend.users.destroy', $user->id],
              ]) !!}

              <div class="col-xs-12">
                  <div class="box">
                      <div class="box-body ">
                          <p>
                              아래의 회원을 삭제하려고 선택하셨습니다:
                          </p>
                          <p>
                              ID #{{ $user->id }}: {{ $user->name }}
                          </p>
                          
                          <p>
                              회원이 작성한 글의 처리를 어떻게 하시겠습니까?
                          </p>
                          <p>
                              <input type="radio" name="delete_option" value="delete" checked> 전부삭제
                          </p>

                          <p>
                              <input type="radio" name="delete_option" value="attribute"> 다음 사용자의 글로 전환 :
                              {!! Form::select('selected_user', $users, null,['placeholder'=>'선택하세요']) !!}
                          </p>

                      </div>
                      <div class="box-footer">
                          <button type="submit" class="btn btn-danger btn-labeled"><span class="btn-label"><i class="fa fa-check"></i></span>확인</button>
                          <a href="{{ route('backend.users.index') }}" class="btn btn-default btn-labeled m-l-10"><span class="btn-label"><i class="fa fa-undo"></i></span>취소</a>
                      </div>
                  </div>
              </div>

            {!! Form::close() !!}
          </div>
        <!-- ./row -->
      </section>
      <!-- /.content -->
    </div>
@endsection
