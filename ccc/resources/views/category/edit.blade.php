<form method="GET" action="{{route('categorEditSave',$categoryData[0]->id)}}">
                @csrf
                <div class="form-group">
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <label>Category Name</label>
                    </div>
                    <div class="col-md-8 col-sm-8 col-lg-8 col-xl-8">
                        <input type="text" class="form-control" name="category[name]" value="@if(!$categoryData[0]->name){{' '}}@else {{$categoryData[0]->name}}@endif">
                    </div>
                    <div class="form-group">
                       <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                            <label>Category Status</label>
                        </div>
                        <div class="col-md-8 col-sm-8 col-lg-8 col-xl-8">
                            <select class="form-control" name="category[status]" id="status">
                                <option disabled selected>Select Status</option>
                                <option value="1"<?php if($categoryData[0]->status==1)echo'selected'; else ' '; ?>>ENABLE</option>
                                <option value="0"<?php if($categoryData[0]->status==0)echo'selected'; else ' ';?>>DISABLE</option>
                            </select>
                        </div>
                     </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <label>Description</label>
                    </div>
                    <div class="col-md-8 col-sm-8 col-lg-8 col-xl-8">
                        <textarea class="form-control" name="category[description]">@if(!$categoryData[0]->description){{' '}}@else {{$categoryData[0]->description}}@endif</textarea>
                    </div>  
               </div>
               <button class="btn btn-md btn-success">UPDATE</button>
               </form>