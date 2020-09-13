        <img src="{{ asset('images/')}}/{{$image}}" id="cropimage" class="img-responsive">

        <form method="post" action="{{route('jcropprocess')}}" enctype="multipart/form-data" id="cropprocess">
        {{csrf_field()}}
            <input type="hidden" name="image" value="{{ $image}}" id="hidimg">
            <input type="hidden" name="index" value="{{$index}}" id="hidindex">

            <input type="hidden" name="x" value="" id="x">
            <input type="hidden" name="y" value="" id="y">
            <input type="hidden" name="w" value="" id="w">
            <input type="hidden" name="h" value="" id="h">
            <input type="submit" name="submit" value="crop it" id="cropthis" class="btn btn-success">
                </form>

        <script type="text/javascript">
         $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
         var index={{$index}};
            $(function() {
                $('#cropimage').Jcrop({
                    onSelect: updateCoords,
                    boxWidth:700,
                     aspectRatio: 9 / 6
                });
            });
            function updateCoords(c) {
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#w').val(c.w);
                $('#h').val(c.h);
            };
             $(document).ready(function(){
                $('#cropprocess').submit(function(e){
                    e.preventDefault();
                var form=$('#cropprocess');
                var formData = form.serialize();
                var url=form.attr('action');
                var rand = Math.floor((Math.random() * 100000) + 1);

                $.ajax({
                    type:'post',
                    data:formData,
                    url:url,
                    async: true,
                    success:function(data)
                    {

                            $(document).find($('#photo_'+index +' img')).attr('src',data+'?'+rand);
                            $('.modal').modal('hide');

                    }
                });
            });
                });
            
            
        </script>