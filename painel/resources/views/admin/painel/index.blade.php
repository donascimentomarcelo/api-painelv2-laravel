@extends('app')

@section('content')

{!! Html::style('css/style.css') !!}
{!! Html::style('css/altered.css') !!}


<div class="container-fluid align-div-principal" >
	<div class="row">
		<div class="col-md-8 col-md-offset-2 align-div-button">
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align: center;"><h4>{{ auth()->user()->name }}, bem vindo ao Painel!!!</h4></div>

				<div class="panel-body">
					<ul class="nav nav-pills  nav-justified">
						<li class="active"><a href="#first-tab" data-toggle="tab">Dashboard</a></li>
						<li><a href="#second-tab" data-toggle="tab">Projetos</a></li>
						<li><a href="#third-tab" data-toggle="tab">Promoções</a></li>
						<li><a href="#fourth-tab" data-toggle="tab">Publicações</a></li>
						<li><a href="#fitth-tab" data-toggle="tab">E-mails</a></li>
						<li><a href="#sixth-tab" data-toggle="tab">Configurações</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane fade active in" id="first-tab">
							<p>Aqui vai o conteúdo da primeira aba.</p>
						</div>
						<div class="tab-pane fade" id="second-tab">
							<p>Aqui vai o conteúdo da segunda aba.</p>
						</div>
						<div class="tab-pane fade" id="third-tab">
							<p>Aqui vai o conteúdo da terceira aba.</p>
						</div>
						<div class="tab-pane fade" id="fourth-tab">
							<p>Aqui vai o conteúdo da quarta aba.</p>
						</div>
						<div class="tab-pane fade" id="fitth-tab">
							<p>Aqui vai o conteúdo da quinta aba.</p>
						</div>
						<div class="tab-pane fade" id="sixth-tab">
							<p>Aqui vai o conteúdo da sexta aba.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection