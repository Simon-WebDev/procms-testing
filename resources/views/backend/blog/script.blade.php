@section('style')
    <link rel="stylesheet" href="/admin/plugins/tag-editor/jquery.tag-editor.css">
@endsection

@section('script')
<!-- tinymce -->
<script src="/admin/plugins/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin/plugins/tinymce/langs/ko_KR.js"></script>

{{-- post tag-editor(https://github.com/Pixabay/jQuery-tagEditor)
 --}}
<script src="/admin/plugins/tag-editor/jquery.caret.min.js"></script>
<script src="/admin/plugins/tag-editor/jquery.tag-editor.min.js"></script>
<script type="text/javascript">
  
  var options = {};

  @if ($post->exists)
      options = {
          initialTags: {!! $post->tags_list !!}
      }
  @endif
  $('input[name=post_tags]').tagEditor(options);
</script>
<!-- end tag-editor -->
<script>
	$('ul.pagination').addClass('no-margin pagination-sm');
  //make slug title the same automatically
  $('#title').on('blur', function(){
    var theTitle = this.value.toLowerCase().trim(),
        slugInput = $('#slug'),
        
        /*speakingurl add korean js*/
        theSlug = getSlug(theTitle);
        /*end speaking url add korean*/
    slugInput.val(theSlug);
  });
  
  $('#datetimepicker1').datetimepicker({
    format : "YYYY-MM-DD HH:mm:ss",
    showClear : true
  });
  //make draft button work well.
  $('#draft-btn').click(function(e) {
    e.preventDefault();
    //make published_at value empty string. the empyt string will be null by post model method.
    $('#published_at').val("");
    $('#post-form').submit();
  });
</script>
@include('backend.partials.tinymce')
@endsection
