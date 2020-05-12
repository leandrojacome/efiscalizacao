<div class="card-body card-block">
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text"
                   class="form-control @error('name') is-invalid @enderror" name="name"
                   value="{{ $usuario->name ?? old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="username"
               class="col-md-4 col-form-label text-md-right">{{ __('Nome de Usuário') }}</label>

        <div class="col-md-6">
            <input id="username" type="text"
                   class="form-control @error('username') is-invalid @enderror" name="username"
                   value="{{ $usuario->username ?? old('username') }}" required autocomplete="username" autofocus>

            @error('username')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="sigla"
               class="col-md-4 col-form-label text-md-right">{{ __('Sigla') }}</label>

        <div class="col-md-6">
            <input id="sigla" type="text"
                   class="form-control @error('sigla') is-invalid @enderror" name="sigla"
                   value="{{ $usuario->sigla ?? old('sigla') }}" required autocomplete="sigla" autofocus>

            @error('sigla')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email"
               class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

        <div class="col-md-6">
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ $usuario->email ?? old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>
    @if(!isset($usuario))
        <div class="form-group row">
            <label for="password"
                   class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror" name="password"
                       required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm"
                   class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control"
                       name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>
    @endif
    @hasanyrole('gerencia|super-admin')
    <div class="form-group row">
        <label for="papel"
               class="col-md-4 col-form-label text-md-right">{{ __('Papel') }}</label>

        <div class="col-md-6">
            <select id="papel" name="papel" class="form-control">
                <option value="">Selecione um papel</option>
                @foreach($papeis as $papel)
                    @if($papel->slug === 'Admin')
                        @role('super-admin')
                        <option value="{{$papel->id}}" {{((isset($usuario)) and ($usuario->hasRole($papel->name))) ? 'selected' : null}}>{{$papel->slug}}</option>
                        @endrole
                    @else
                        <option value="{{$papel->name}}" {{((isset($usuario)) and ($usuario->hasRole($papel->name))) ? 'selected' : null}}>{{$papel->slug}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    @endhasanyrole
</div>

