<div class="card-body card-block">
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text"
                   class="form-control @error('name') is-invalid @enderror" name="name"
                   value="{{ $fiscal->user->name ?? old('name') }}" required autocomplete="name" autofocus>

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
                   value="{{ $fiscal->user->username ?? old('username') }}" required autocomplete="username" autofocus>

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
                   value="{{ $fiscal->user->sigla ?? old('sigla') }}" required autocomplete="sigla" autofocus>

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
                   value="{{ $fiscal->user->email ?? old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email"
               class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>

        <div class="col-md-6">
            <input id="telefone" type="email"
                   class="form-control @error('telefone') is-invalid @enderror" name="telefone"
                   value="{{ $fiscal->telefone ?? old('telefone') }}" required autocomplete="telefone">

            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>
    @if(!isset($fiscal))
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
    <div class="form-group row">
        <label for="disponivel"
               class="col-md-4 col-form-label text-md-right">Disponível</label>

        <div class="col-md-6">
            <label class="switch switch-3d switch-success mr-3">
                <input id="disponivel" name="disponivel" class="switch-input" type="checkbox"
                @if(isset($fiscal->disponivel) and ($fiscal->disponivel == 'on')){{"checked=true"}}@else{{old('disponivel')}}@endif>
                <span class="switch-label"></span>
                <span class="switch-handle"></span>
            </label>
        </div>
    </div>
</div>

