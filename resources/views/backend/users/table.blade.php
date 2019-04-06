<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th width="80">이름</th>
			<th width="100">이메일</th>
			<th width="80">지위</th>
			<th width="80">가입일</th>
			<th width="150">관리</th>
		</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
		<tr>
			<td>{{$user->name}}</td>
			<td>{{$user->email}}</td>
			<td>{{$user->roles->first()->display_name}}</td>
			<td><abbr title="{{$user->dateFormatted(true)}}">{{$user->dateFormatted(false)}}</abbr></td>
			<td>
				<a href="{{route('backend.users.edit', $user->id)}}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> 수정</a>
				@if($user->id == config('cms.default_user_id'))
					<button type="submit" class="btn btn-sm btn-danger disabled" onclick="return false"><i class="fa fa-trash"></i> 삭제</button>
				@else
					<a href="{{route('backend.users.confirm',$user->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('삭제하시겠습니까?')"><i class="fa fa-trash"></i> 삭제</a>
				@endif
			    
			</td>
		</tr>
		@endforeach
	</tbody>
</table> 