<!-- jQuery -->
<script src="{{asset ('admin/js/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset ('admin/asset/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset ('admin/js/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{asset ('admin/asset/nprogress/nprogress.js')}}"></script>
<!-- bootstrap-progressbar -->
<script src="{{asset ('admin/asset/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset ('admin/asset/iCheck/icheck.min.js')}}"></script>
{{--//phai gắn file ckeditor.js để hiển thị khung editor nội dung--}}
<script src="{{asset ('admin/js/ckeditor/ckeditor.js')}}"></script>
<!-- Custom Theme Scripts -->
<script src="{{asset ('admin/js/custom.min.js')}}"></script>

<script src="{{asset ('admin/js/my-js.js')}}"></script>
<script>
    CKEDITOR.replace('editor1', {
        language: 'es'
    });
    CKEDITOR.replace( 'content', {
        filebrowserUploadUrl: "{{route('article/upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

</script>
