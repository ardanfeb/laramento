<form action="{{ $delete_url }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button class="btn btn-xs btn-default" type="submit">
        <i class="fas fa-trash" style="padding:0 10px;color:#777;"></i>
    </button>
</form>