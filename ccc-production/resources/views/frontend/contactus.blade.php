@include('layoutTemplate.frontend.main')
@include('layoutTemplate.frontend.header')
<div id="table_data">
<div id="Content">
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="container-fluid">

            <!-- OVERVIEW -->
            <div class="panel panel-headline">

                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"> Contact-Us</h3>
                                    @if(!$attribute->count()< 0)
                                    <h6>No Data Found for this form....</h6>
                                    @endif
                                    @foreach($attribute as $key=>$value)

                                    @if ($value->input_type == 'textarea')
                                    <div class="row" style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->label}}"> {{$value->label}}</label>
                                        </div>
                                        <div class="col-lg-10">
                                        <textarea name="" id="description" style="resize: vertical" class="form-control" placeholder="PRODUCT DESCRIPTION"></textarea>
                                        </div>
                                    </div><br>
                                        @endif
                                    @if ($value->input_type == 'text')
                                    <div class="row" style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->label}}"> {{$value->label}}</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="{{$value->placeholder}}">
                                        </div>
                                    </div>
                                    @endif
                                    @if ($value->input_type == 'select')
                                    <div class="row"  style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->label}}"> {{$value->label}}</label>
                                        </div>
                                        <div class="col-lg-10">

                                            <select class="form-control" name="{{$value->label}}">
                                            @foreach($controller->getOptions($value->id) as $key =>$option)
                                                <option value={{$option->id}}>{{$option->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($value->input_type == 'date')
                                    <div class="row"  style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->label}}"> {{$value->label}}</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    @endif

                                    @endforeach

                </div>
            </div>
        </div>
        <!-- END OVERVIEW -->
    </div>
</div>
<!-- END MAIN CONTENT -->
<script type="text/javascript">
        $(document).ready(function() {
            $('#description').summernote({
                height: 200,
            });
        });
</script>


