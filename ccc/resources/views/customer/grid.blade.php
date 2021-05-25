@if(session('custstatus'))
<div class ="alert alert-success">{{session('custstatus')}}</div>
@endif
@if(session('custDelete'))
<div class ="alert alert-success">{{session('custDelete')}}</div>
@endif
@if(session('custSave'))
<div class ="alert alert-success">{{session('custSave')}}</div>
@endif
<div id="table_data">
@include('customer.pagination')
</div>
<script>
        // $(document).ready(function()
        // {
        //     $(document).on('click','.pagination a',function(event)
        //     {
        //         event.preventDefault();
        //         var page = $(this).attr('href').split('page=')[1];
        //         fetch_data(page);
        //     });
        
        //     function fetch_data(page)
        //     {
        //         $.ajax({
        //             url:"/customerGrid/fetch_data?page="+page,
        //             success:function(data)
        //             {
        //                 $('#table_data').html(data);
        //                 console.log(data);
        //             }
        //         });
        //     }
        // });
    </script>
    
