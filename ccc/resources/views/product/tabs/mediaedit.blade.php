@extends('core.head')

@section('container')
    <div class="row">
        <?php $data = $product->getMedias(); ?>
        <?php $product_id = $data[0]->product_id;?>

        @include('product.tabs')

        <div class="col-sm-9">
        <h3 style="font-weight:bold; font-size:32px;" class="mt-2">Media </h3>
            <form  id= "mediaUpdate" method="POST">
                <button type="submit" name="update" value="update"  onclick="media();" class="btn btn-md btn-success"> <i
                        class="fa fa-pencil"></i></button>
                <button type="submit" name="delete" value="delete" class="btn btn-md btn-secondary"> <i
                        class="fa fa-trash"></i></button>
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
                                                <form action="/product/imageUpdateUpload/{{ $media->id }}" method="post" enctype="multipart/form-data">
                                                 @csrf
                                                 @method('post')
                                                <input type="file" name="image[{{ $media->id }}][media]" class="btn btn-md btn-success" value=" {{$media->media}}"> 
                                                <button class="btn btn-success"><i class="fa fa-pencil"></i></button>
                                                </form>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    name="image[{{ $media->id }}][label]" placeholder="Label" id="name"
                                                    value="{{ $media->label }}">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="small[{{ $media->id }}]"
                                                    value="{{ $media->id }}" class="form-control"
                                                    name="image[small]" {{ $media->small == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="thumb[{{ $media->id }}]"
                                                    value="{{ $media->id }}" class="form-control"
                                                    name="image[thumb]" {{ $media->thumb == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="base[{{ $media->id }}]"
                                                    value="{{ $media->id }}" class="form-control"
                                                    name="image[base]" {{ $media->base == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="form-control"
                                                    id="gallery[{{ $media->id }}]"
                                                    name="image[{{ $media->id }}][gallery]"
                                                    {{ $media->gallery == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="form-control"
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
                        <button class="btn btn-success">upload</i></button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script type="text/javascript">
function media()
{
    var form=document.getElementById('mediaUpdate');
    form.setAttribute('Action','/mediaUpdate');
    form.submit();
}
</script>

@stop
