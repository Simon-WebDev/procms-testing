@section('script')
<script>
  //make slug title the same automatically
   $('#title').on('blur', function(){
     var theTitle = this.value.toLowerCase().trim(),
         slugInput = $('#slug'),
         
         /*my custom*/
         // theSlug = theTitle.replace(/&/g,'-그리고-')
         //           .replace(/[^a-zA-Z0-9가-힣ㄱ-ㅎ]+/g, '-')
         //           .replace(/\-\-+/g, '-')
         //           .replace(/^-+|-+$/g,'');
         // console.log(theTitle);
         /*end mycustom*/

         /*speakingurl add korean js*/
         theSlug = getSlug(theTitle);
         /*end speaking url add korean*/
     slugInput.val(theSlug);
   });
</script>
@endsection
