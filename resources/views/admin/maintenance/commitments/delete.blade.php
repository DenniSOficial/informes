<div class="btn-group mr-1 mt-1">
    <form action="{{ route('commitment.destroy', $commitment->IdCommitment) }}" method="post">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones  
            <i class="mdi mdi-chevron-down"></i>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('commitment.edit', $commitment->IdCommitment) }}">Editar</a>
            <div class="dropdown-divider"></div>
            @csrf
            @method('DELETE')
            <button type="submit" class="dropdown-item">Eliminar</button>
        </div>
    </form>
</div>