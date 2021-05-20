    <div id="table_data">
       @include('product.pagination')
     </div>
     <!-- storing page no -->
    <!-- <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

    vakues changes when user clicks
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id"/> -->
    <!-- <form method="post" id="record">
        <label>Record per Page</p>
        <select name="selectpage">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
0    </form> -->
    <script>
        $(document).ready(function()
        {  
            $(document).on('click','.pagination a',function(event)
            {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });
        
            function fetch_data(page)
            {
                $.ajax({
                    url:"/product/fetch_data?page="+page,
                    success:function(data)
                    {
                        $('#table_data').html(data);
                        console.log(data);
                    }
                });
            }
        });
    </script>

