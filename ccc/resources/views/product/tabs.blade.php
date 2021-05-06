<div class="col-3">
<ul class="nav flex-column">
    <li class="nav-item list-group p-0 h-100 w-100" style="margin-left: -60px;">
         <a class="nav-link list-group-item list-group-item-action bg-warning mt-2 text-center font-weight-bold font-weight italic" href="/product/form{{ $data ? '/' . $data[0]->id : '' }}">Information</a>
    </li>
         <li class="nav-item list-group p-0 h-100 w-100" style="margin-left: -60px;">
            <a  class="nav-link list-group-item bg-warning list-group-item-action mt-2 text-center font-weight-bold font-weight italic" href="/product/media{{ $data ? '/' . $data[0]->id : '' }}">Media</a>
        </li>

    </ul>
</div>


