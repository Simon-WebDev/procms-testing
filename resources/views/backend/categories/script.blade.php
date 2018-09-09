@section('script')
<script>
	
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
</script>
@endsection
