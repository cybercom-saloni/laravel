
        <?php $data = $product->getMedias(); ?>
        @if($data)
        @include('product.tabs')
        @endif
        <div class="col-sm-9">
        <h3 style="font-weight:bold; font-size:32px;" class="mt-2">Media </h3>
        <form action="/media/update/{{ request()->id }}" id="formupdate" method="POST">
                <!-- <button type="button" name="update"   value="update" onclick="object.setForm('formupdate').setUrl('/media/update/{{ request()->id }}').setMethod('post').load();" name="update" value="update" class="btn btn-md btn-success"> <i
                        class="fa fa-pencil"></i></button>
                <button type="button" name="delete" onclick="object.setForm('formupdate').setUrl('/media/delete/{{ request()->id }}').setMethod('post').load();" value="delete" class="btn btn-md btn-secondary"> <i
                        class="fa fa-trash"  value="delete"></i></button> -->
                        <button type="submit" name="update"   value="update"  name="update" value="update" class="btn btn-md btn-success"> <i
                        class="fa fa-pencil"></i></button>
                <button type="submit" name="delete"  value="delete" class="btn btn-md btn-secondary"> <i
                        class="fa fa-trash"  value="delete"></i></button>
                @csrf
                <div class="row">
                    <table class="table table-bordered bg-light  table-hover">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Image</th>
                                <th>Label</th>
                                <th>Small</th>
                                <th>Thumb</th>
                                <th>Base</th>
                                <th>Gallery</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$data)
                                <tr>
                                    <td colspan="7">No Images Found</td>
                                </tr>
                            @else
                                @foreach ($data as $media)
                                    <tr>
                                        
                                        <td>
                                            <img src="\images\products\{{ $product->id }}\{{ $media->media }}"
                                                height=" 100px" width="100px">
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    name="image[{{ $media->id }}][label]" placeholder="Label" id="name"
                                                    value="{{ $media->label }}">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="custom-control">
                                                <input type="radio" id="small[{{ $media->id }}]"
                                                    value="{{ $media->id }}"
                                                    name="image[small]" {{ $media->small == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="custom-control">
                                                <input type="radio" id="thumb[{{ $media->id }}]"
                                                    value="{{ $media->id }}"
                                                    name="image[thumb]" {{ $media->thumb == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="custom-control">
                                                <input type="radio" id="base[{{ $media->id }}]"
                                                    value="{{ $media->id }}"
                                                    name="image[base]" {{ $media->base == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="custom-control">
                                                <input type="checkbox"
                                                    id="gallery[{{ $media->id }}]"
                                                    name="image[{{ $media->id }}][gallery]"
                                                    {{ $media->gallery == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control">
                                                <input type="checkbox"
                                                    id="remove[{{ $media->id }}]"
                                                    name="image[{{ $media->id }}][remove]">
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </form>
            <form action="/product/imageUpload/{{ $product->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="row">
                    <div class="col-10">
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="col-2">
                        <button type="button" onclick="object.setUrl('/product/imageUpload/{{ $product->id }}').setMethod('post').uploadFile().resetParams();" class="btn btn-success">upload</i></button>
                    </div>
                </div>

            </form>
        </div>
