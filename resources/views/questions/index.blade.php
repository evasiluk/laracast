@extends('master')

@section('title', 'Список заданных вопросов')

@section('content')
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2> Список заданных вопросов </h2>
        </div>
        <form name="faq" class="form-horizontal" method="get" action="{{ action('QuestionsController@index') }}">
            <input type = "hidden" name = "_token" value = "{!! csrf_token() !!}">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Рубрика</label>
                <select name="rubric" class="form-control" id="exampleFormControlSelect1">
                    <option value="">Все</option>
                    @foreach($rubrics as $i => $rub)
                        <option @if(isset($current_rubric) && $rub->id == $current_rubric) selected @endif value = "{!! $rub->id !!}" >{!! $rub->name !!}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Поиск</button>
        </form>

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