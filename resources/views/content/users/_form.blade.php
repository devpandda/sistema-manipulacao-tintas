<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="password" class="form-label">Senha {{ isset($user) ? '(Deixe em branco para manter a atual)' : '' }}</label>
        <input type="password" class="form-control" id="password" name="password" {{ isset($user) ? '' : 'required' }}>
    </div>
    <div class="col-md-6 mb-3">
        <label for="password_confirmation" class="form-label">Confirmar Senha</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" {{ isset($user) ? '' : 'required' }}>
    </div>
</div>
<div class="mt-2">
    <button type="submit" class="btn btn-primary me-2">{{ isset($user) ? 'Atualizar' : 'Criar' }} Usuário</button>
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancelar</a>
</div>
