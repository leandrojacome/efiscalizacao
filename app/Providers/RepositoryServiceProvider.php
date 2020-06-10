<?php

namespace App\Providers;

use App\Repositories\CidadeRepository;
use App\Repositories\CidadeRepositoryEloquent;
use App\Repositories\DiligenciaRepository;
use App\Repositories\DiligenciaRepositoryEloquent;
use App\Repositories\EscalaRepository;
use App\Repositories\EscalaRepositoryEloquent;
use App\Repositories\FiscalRepository;
use App\Repositories\FiscalRepositoryEloquent;
use App\Repositories\FotoRepository;
use App\Repositories\FotoRepositoryEloquent;
use App\Repositories\HistoricoRepository;
use App\Repositories\HistoricoRepositoryEloquent;
use App\Repositories\LocalizacaoRepository;
use App\Repositories\LocalizacaoRepositoryEloquent;
use App\Repositories\NoticiaContravencionalRepository;
use App\Repositories\NoticiaContravencionalRepositoryEloquent;
use App\Repositories\OcorrenciaRepository;
use App\Repositories\OcorrenciaRepositoryEloquent;
use App\Repositories\OrigemRepository;
use App\Repositories\OrigemRepositoryEloquent;
use App\Repositories\PapelRepository;
use App\Repositories\PapelRepositoryEloquent;
use App\Repositories\PermissaoRepository;
use App\Repositories\PermissaoRepositoryEloquent;
use App\Repositories\PermissionRepository;
use App\Repositories\PermissionRepositoryEloquent;
use App\Repositories\RoleRepository;
use App\Repositories\RoleRepositoryEloquent;
use App\Repositories\RotaRepository;
use App\Repositories\RotaRepositoryEloquent;
use App\Repositories\SituacaoRepository;
use App\Repositories\SituacaoRepositoryEloquent;
use App\Repositories\TermoRepresentacaoRepository;
use App\Repositories\TermoRepresentacaoRepositoryEloquent;
use App\Repositories\TipoDocumentoRepository;
use App\Repositories\TipoDocumentoRepositoryEloquent;
use App\Repositories\TipoHistoricoRepository;
use App\Repositories\TipoHistoricoRepositoryEloquent;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use App\Repositories\ViagemRepository;
use App\Repositories\ViagemRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(CidadeRepository::class, CidadeRepositoryEloquent::class);
        $this->app->bind(RotaRepository::class, RotaRepositoryEloquent::class);
        $this->app->bind(OrigemRepository::class, OrigemRepositoryEloquent::class);
        $this->app->bind(OcorrenciaRepository::class, OcorrenciaRepositoryEloquent::class);
        $this->app->bind(DiligenciaRepository::class, DiligenciaRepositoryEloquent::class);
        $this->app->bind(FotoRepository::class, FotoRepositoryEloquent::class);
        $this->app->bind(SituacaoRepository::class, SituacaoRepositoryEloquent::class);
        $this->app->bind(LocalizacaoRepository::class, LocalizacaoRepositoryEloquent::class);
        $this->app->bind(TipoHistoricoRepository::class, TipoHistoricoRepositoryEloquent::class);
        $this->app->bind(TipoDocumentoRepository::class, TipoDocumentoRepositoryEloquent::class);
        $this->app->bind(HistoricoRepository::class, HistoricoRepositoryEloquent::class);
        $this->app->bind(PermissaoRepository::class, PermissaoRepositoryEloquent::class);
        $this->app->bind(PapelRepository::class, PapelRepositoryEloquent::class);
        $this->app->bind(FiscalRepository::class, FiscalRepositoryEloquent::class);
        $this->app->bind(EscalaRepository::class, EscalaRepositoryEloquent::class);
        $this->app->bind(ViagemRepository::class, ViagemRepositoryEloquent::class);
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(TermoRepresentacaoRepository::class, TermoRepresentacaoRepositoryEloquent::class);
        $this->app->bind(NoticiaContravencionalRepository::class, NoticiaContravencionalRepositoryEloquent::class);
    }

}
