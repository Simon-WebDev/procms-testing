@section('style')
    <link rel="stylesheet" href="/backend/plugins/tag-editor/jquery.tag-editor.css">
@endsection

@section('script')
<!-- tinymce -->
<script src="/backend/plugins/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/backend/plugins/tinymce/langs/ko_KR.js"></script>

{{-- post tag-editor(https://github.com/Pixabay/jQuery-tagEditor)
 --}}
<script src="/backend/plugins/tag-editor/jquery.caret.min.js"></script>
<script src="/backend/plugins/tag-editor/jquery.tag-editor.min.js"></script>
<script type="text/javascript">
  
  var options = {};

  @if($post->exists)
      options = {
          initialTags: {!! $post->tags_list !!},
      };
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
        theSlug = theTitle.replace(/&/g,'-그리고-')
                  .replace(/[^a-zA-Z0-9가-힣ㄱ-ㅎ]+/g, '-')
                  .replace(/\-\-+/g, '-')
                  .replace(/^-+|-+$/g,'');
        console.log(theTitle);
    slugInput.val(theSlug);
  });
  //simplemde plugin
  // var simplemde1 = new SimpleMDE({ element: $("#excerpt")[0] });
  // var simplemde2 = new SimpleMDE({ element: $("#body")[0] });

  /*tinymce*/

    tinymce.init({
      selector: '#excerpt',
      'plugins' : 'link'
      // language : 'ko',

    });

    
    var editor_config = {
      path_absolute : "/",
      // language : 'ko',
      selector: "#body",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
        });
      }
    };

    tinymce.init(editor_config);

    
   

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
