<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>분류명</th>
			<th width="100">공지사항 수</th>
			<th width="160">관리</th>
			
		</tr>
	</thead>
	<tbody>
		@foreach($chapters as $chpater)
		<tr>
			
			<td>{{$chpater->title}}</td>
			<td>{{$chpater->pages->count()}}</td>
			<td>
        {!! Form::open(['method' => 'DELETE', 'route'=>['backend.chapter.destroy',$chpater->id]]) !!}
				<a href="{{route('backend.chapter.edit', $chpater->id)}}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>수정</a>
				@if($chpater->id == config('cms.default_chapter_id'))
					<button type="submit" class="btn btn-sm btn-danger disabled" onclick="return false"><i class="fa fa-trash"></i> 삭제</button>
				@else
					<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('삭제하시겠습니까?')"><i class="fa fa-trash"></i> 삭제</button>
				@endif
        {!! Form::close() !!}
			</td>
		</tr>
		@endforeach
	</tbody>
</table> 