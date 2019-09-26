@php
    /** @var \Illuminate\Database\Eloquent\Collection|\App\User[] $users */
@endphp
@extends('layouts.main')

@section('content')
    <div class="panel panel-default">

        <div class="panel-body">

            @include('layouts/flash-message')

            <h3>Usuários da Clínica</h3>
            @foreach ($users as $user)
                <div class="col-lg-12" style="background-color: #c8e0f0; margin-top: 15px; padding-top: 20px;"
                     id="user-row-{{ $user->id }}">
                    <div class="col-lg-1">
                        <img src="{{ route('profile.user.avatar', ['user' => $user->id, 'size' => 'small']) }}" class="img-responsive" style="height: 60px; width: 60px;">
                    </div>
                    <div class="col-lg-6">
                        <p>
                            Nome:&nbsp;&nbsp;<b>{{ $user->name }}</b>
                        </p>
                        <p>
                            Email:&nbsp;&nbsp;<b>{{ $user->email }}</b>
                        </p>
                        <p>
                            Dentista? &nbsp;&nbsp;<b>{{ $user->dentist_id ? "Sim ({$user->dentist->cro})" : "Não" }}</b>
                        </p>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 5px;">
                    @if(Auth::user()->id !== $user->id)
                    <form
                        action="{{ route('clinic.user_remove', ['user' => $user->id]) }}"
                        method="post"
                        style="display:inline;"
                        onsubmit="return confirm('Deseja realmente remover o acesso do usuário {{ $user->name }} da clínica')"
                    >
                        @csrf
                        @method ('delete')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash-o"></i> Excluir Usuário
                        </button>
                    </form>
                    @else
                        <p>Esse usuário não pode ser excluído, pois é o usuário logado.</p>
                    @endif
                </div>
            @endforeach
            <br/>&nbsp;<hr/>
            <h3>Solicitações de acesso</h3>
            @if (count($applicants) == 0)
                <p>Nenhuma solicitação de acesso</p>
            @else
                @foreach($applicants as $applicant)
                <div class="col-lg-12" style="background-color: #c8e0f0; margin-top: 15px; padding-top: 20px;"
                     id="user-row-{{ $applicant->id }}">
                    <div class="col-lg-1">
                        <img src="{{ route('profile.user.avatar', ['user' => $applicant->id, 'size' => 'small']) }}" class="img-responsive" style="height: 40px; width: 40px;">
                    </div>
                    <div class="col-lg-6">
                        <p>
                            Nome:&nbsp;&nbsp;<b>{{ $applicant->name }}</b>
                        </p>
                        <p>
                            Email:&nbsp;&nbsp;<b>{{ $applicant->email }}</b>
                        </p>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 5px;">
                    <form
                        action="{{ route('clinic.applicant_approve', ['applicant' => $applicant->id]) }}"
                        method="post"
                        style="display:inline;"
                        onsubmit="return confirm('Deseja realmente aprovar o acesso do usuário {{ $applicant->name }} a clínica?')"
                    >
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-thumbs-up"></i> Aprovar Acesso
                        </button>
                    </form>
                    <form
                        action="{{ route('clinic.applicant_reprove', ['applicant' => $applicant->id]) }}"
                        method="post"
                        style="display:inline;"
                        onsubmit="return confirm('Deseja realmente reprovar o acesso do usuário {{ $applicant->name }} a clínica?')"
                    >
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash-o"></i> Reprovar Acesso
                        </button>
                    </form>
                </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@section('scripts')

@endsection
