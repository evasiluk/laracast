@extends('master')

@section('title', 'Задать вопрос')

@section('content')
<div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">
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
        </div>
    </div>
@endsection