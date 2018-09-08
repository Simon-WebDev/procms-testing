@section('script')
<script>
	$('ul.pagination').addClass('no-margin pagination-sm');
  //make slug title the same automatically
  $('#title').on('blur', function(){
    var theTitle = this.value.toLowerCase().trim(),
        slugInput = $('#slug'),
        theSlug = theTitle.replace(/&/g,'-그리고-')
                  .replace(/[^a-zA-Z0-9가-힣ㄱ-ㅎ]+/g, '-')
                  .replace(/\-\-+/g, '-')
                  .replace(/^-+|-+$/g,'');
        console.log(theTitle);
    slugInput.val(theSlug);
  });
  //simplemde plugin
  var simplemde1 = new SimpleMDE({ element: $("#excerpt")[0] });
  var simplemde2 = new SimpleMDE({ element: $("#body")[0] });

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
@endsection