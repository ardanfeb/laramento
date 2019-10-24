<form action="{{ $delete_url }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <div class="btn-group pull-right">
        <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-h" style="padding:0 10px;"></i>
        </button>
        <ul class="dropdown-menu">
            <li><a href="{{ $show_url }}">Show</a></li>
            <li><a href="{{ $edit_url }}">Edit</a></li>
            <li role="separator" class="divider"></li>
            <li><a style="cursor:pointer;" onclick="$(this).closest('form').submit()">Delete</a></li>
        </ul>
    </div>
</form>