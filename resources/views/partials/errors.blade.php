@if ($errors->any())
    <div class="card-body">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif