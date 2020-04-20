
@extends('layouts.app')

@section('content')


<div class="col-md-10 mx-auto " style="margin-top:6%;height: 80vh">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8149837.481632142!2d105.12235203708244!3d4.138917011901259!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3034d3975f6730af%3A0x745969328211cd8!2sMalaysia!5e0!3m2!1sen!2smy!4v1587330808828!5m2!1sen!2smy"
     width="100%" height="100%" frameborder="0" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" allowfullscreen="true" aria-hidden="false" tabindex="0"></iframe>

</div>

   <script >
            $('#nav_u').addClass('text-dark');

            function next(){
              window.location.href  = "/report";
            }
    </script>

    @endsection
    