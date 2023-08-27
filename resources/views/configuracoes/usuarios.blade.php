@foreach($usuarios as $usuario)
    <!-- Exibir informações do usuário na tabela -->
<p>{{ $usuario->name }}</p>
    <!-- Botão para abrir modal de edição -->
    <!-- Modal de edição/inclusão do usuário -->
    <div class="modal fade" id="editarUsuarioModal{{ $usuario->id }}" tabindex="-1" role="dialog" aria-labelledby="editarUsuarioModalLabel{{ $usuario->id }}" aria-hidden="true">
        <!-- Conteúdo do modal -->
    </div>
@endforeach
<button class="btn btn-primary" data-toggle="modal" data-target="#editarUsuarioModal{{ $usuario->id }}">
        Novo
    </button>
