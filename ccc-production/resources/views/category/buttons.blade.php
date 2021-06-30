<!-- <a href="{{ route('category.export') }}" class="btn btn-info">
    Export <i class="fa fa-file-download"></i>
</a> -->


<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importData">
    Import <i class='fa fa-file-export'></i>
</button> -->


<!-- Modal -->
<!-- <div class="modal fade" id="importData" tabindex="-1" role="dialog" aria-labelledby="importDataLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h1 class="modal-title" id="importDataLabel">Import Products</h1>
            </div>

            <div class="modal-body">
                <div class="list-group-item list-group-item-warning">
                    <span><b>Xlsx file must have mentioned headers.</b></span>
                    <div>
                        sku,
                        categoryId,
                        name,
                        price,
                        discount,
                        quantity,
                        description,
                        status
                    </div>
                    <span>
                        <h5 class="mt-4">Note</h5>
                    </span>
                    <ul style="margin-top:8px" class="small">
                        <li>For status ( 1= enabled, 2= disabled ).</li>
                    </ul>
                    <a href="{{ route('category.download') }}" class="mb-2 m-5 btn btn-info">click
                        here
                        to download xlsx format</a>
                </div>


                <form action="{{ route('category.import') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="csvFile">Upload CSV</label>
                        <input type="file" name="csvFile" id="csvFile" class="form-control required"
                            accept=".csv,.xlsx">
                    </div>
                    <button type="submit" class="btn btn-primary">Import Data</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->
