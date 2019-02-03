@extends('master')

@section('title', 'Задать вопрос')

@section('content')
<div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            <p><a href="{{ action('QuestionsController@create') }}">Задать новый вопрос</a></p>
        @elseif(count($limits_status))
            @if(isset($limits_status["global_limit_reached"]))
                <p class="alert alert-danger">Сервис принял максимальное количество вопросов на сегодня.</p>
            @endif
            @if(isset($limits_status["personal_limit_reached"]))
               <p class="alert alert-danger">Ваш дневной лимит вопросов исчерпан.</p>
            @endif
            <p class="alert alert-danger">Новый вопрос можно будет задать в следующий рабочий день.</p>
        @else
        <form class="form-horizontal" method="post" action="{{ action('QuestionsController@store') }}">
            @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
            @endforeach
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token()  }}">
                <fieldset>
                    <legend>Задать вопрос</legend>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1" class="col-lg-2 control-label">Рубрика</label>
                        <div class="col-lg-10 col-lg-offset-2">
                            <select name="rubric_id" class="form-control" id="exampleFormControlSelect1">
                                @foreach($rubrics as $i => $rub)
                                    <option value = "{!! $rub->id !!}" >{!! $rub->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="content" class="col-lg-2 control-label">Сообщение</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="content" name="question">{{ old('question') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        @endif
        </div>
    </div>
@endsection