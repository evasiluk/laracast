@extends('master')

@section('title', 'Список заданных вопросов')

@section('content')
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2> Персональный архив </h2>
        </div>

        @if($questions->isEmpty())
            <p>Вопросы не найдены</p>
        @else
        <div id="accordion">
            @foreach($questions as $i=>$question)
                <div class="card">
                    <div class="card-header" id="heading{!! $i !!}">
                        <h5 class="mb-0">
                            № {{ $question->id }}<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{!! $i !!}" aria-expanded="true" aria-controls="collapse{!! $i !!}">
                                 {{$question->question}}
                            </a>
                        </h5>
                    </div>
                    <div id="collapse{!! $i !!}" class="collapse" aria-labelledby="heading{!! $i !!}" data-parent="#accordion">
                        <div class="card-body">
                            {{$question->answer}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection