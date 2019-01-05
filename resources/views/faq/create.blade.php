@extends('master')
@section('title', 'Задать вопрос')

@section('content')
<div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">
            <form class="form-horizontal" method="post" action="{{action("QuestionsController@store")}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{$error}}</p>
                @endforeach
                @if(session('status'))
                    <p>{{session('status')}}</p>
                @endif
                <fieldset>
                    <legend>Задать вопрос</legend>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1" class="col-lg-2 control-label">Рубрика</label>
                        <div class="col-lg-10 col-lg-offset-2">
                            <select name="rubric" class="form-control" id="exampleFormControlSelect1">

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control"  id="email" name="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="content" class="col-lg-2 control-label">Сообщение</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="content" name="question"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
