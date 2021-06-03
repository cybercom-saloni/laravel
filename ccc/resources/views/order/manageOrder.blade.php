<h3 style="font-weight:bold; font-size:32px;" class="mt-2">Manage Order</h3>
<hr>

    
    <table class="table table-bordered bg-light  table-hover">
        <thead class="bg-dark text-white">
            <tr>
                <th>Order ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Total</th>
                <th>Order Status</th>
                <th>View Order</th>
            </tr>
        </thead>
        <tbody>
     
            @if (!$customerDetails)
                <tr>
                    <td colspan="17" class="text-center">No Records Found</td>
                </tr>
            @else
            
                @foreach($customerDetails as $customer)
                <tr>
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->firstname}}</td>
                    <td>{{$customer->lastname}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->contactno}}</td>
                    <td>{{$customer->total}}</td>
                    <td>{{$customer->status}}</td>
                    <!-- <td>{{$controller->getOrderComment($customer->id) }}</td> -->
                    <td><a onclick="object.setUrl('/InformationCustomer/{{$customer->id}}').setMethod('get').load();" href="javascript:void(0);" class="btn btn-primary">View Order</a></td>
                </tr>
                @endforeach
            @endif
           
        </tbody>
    </table>
  

<div class="col-12">
    <div class = "row">
        <div class="col-9">
            <div>
                <nav>
                    <ul class="pagination">
                        
                        @if($customerDetails->currentPage() != 1)
                        <li class="page-item">
                            <a class="page-link{{$customerDetails->previousPageUrl()? ' ':'disabled'}}" href="javascript:void(0)" onclick="object.setUrl('{{$customerDetails->previousPageUrl()}}').setMethod('get').load()">Previous</a>
                        </li>
                        @endif
                        @for($i=1;$i<=$customerDetails->lastPage();$i++)
                            <li class="page-item {{Request::get('page') == $i ? 'active' : ' '}}">
                                <a class="page-link" onclick="object.setUrl('{{$customerDetails->url($i)}}').setMethod('get').load()" href="javascript:void(0);">{{$i}}</a>
                            </li>
                        @endfor
                        @if($customerDetails->currentPage() != $customerDetails->lastPage())
                        <li class="page-item">
                            <a class="page-link{{$customerDetails->nextPageUrl() ? ' ':'disabled'}}" onclick="object.setUrl('{{$customerDetails->nextPageUrl()}}').setMethod('get').load();" href="javascript:void(0)">Next</a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
       
            <div class="col-3">
            <form action="/setPages/manageOrder" method="post" id="records">
                            @csrf
                            <div class="navbar-btn navbar-btn-right">
                                <div class="form-group">
                                    <label for="recordPerPage">Record Per Page</label>
                                    <select name="recordPerPage" id="recordPerPage" class="form-control col-lg-5">
                                        <option value="2"
                                            {{ Session::has('page') ? (Session::get('page') == 2 ? 'selected' : '') : '' }}>
                                            2
                                        </option>
                                        <option value="4"
                                            {{ Session::has('page') ? (Session::get('page') == 4 ? 'selected' : '') : '' }}>
                                            4
                                        </option>
                                        <option value="20"
                                            {{ Session::has('page') ? (Session::get('page') == 20 ? 'selected' : '') : '' }}>
                                            20
                                        </option>
                                        <option value="50"
                                            {{ Session::has('page') ? (Session::get('page') == 50 ? 'selected' : '') : '' }}>
                                            50
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </form>
            </div>
        
    </div>
</div>

<script>
$(function() {
    $('#recordPerPage').on('change', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: '/setPages/manageOrder',
            data: $('#records').serializeArray(),
            success: function(response) {
                if (typeof response.element == 'undefined') {
                    return false;
                }
                if (typeof response.element == 'object') {
                    $(response.element).each(
                        function(i, element) {
                            $('#content').html(element.html);
                        })
                        } 
                        else {
                            $(response.element.selector).html(response.element.html);
                        }
                }
        });
    });
});




</script>