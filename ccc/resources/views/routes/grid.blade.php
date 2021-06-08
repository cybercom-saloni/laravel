<h3 style="font-weight:bold; font-size:32px;" class="mt-2">Manage Routes</h3>
<hr>

    
    <table class="table table-bordered bg-light  table-hover">
        <thead class="bg-dark text-white">
            <tr>
                <th>Route ID</th>
                <th>Method</th>
                <th>Url</th>
                <th>Controller</th>
                <th>Action</th>
                <th>Name</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            {{$routes}}
        </thead>
        <tbody>
        @foreach($routes as $key =>$value)
        <tr>
            <td>{{value->id}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
