@section('script')
<script>
	
  //make slug title the same automatically
  $('#name').on('blur', function(){
    var theTitle = this.value.toLowerCase().trim(),
        slugInput = $('#slug'),
        theSlug = theTitle.replace(/&/g,'-그리고-')
                  .replace(/[^a-zA-Z0-9가-힣ㄱ-ㅎ]+/g, '-')
                  .replace(/\-\-+/g, '-')
                  .replace(/^-+|-+$/g,'');

    slugInput.val(theSlug);
    
  });
</script>
@endsection
