@extends('master')
@section('title', 'Questions list')

@section('content')

<div class="container col-md-8 col-md-offset-2 d-flex justify-content-between">
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Список вопросов </h2>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Вопрос</th>
                    <th>Рубрика</th>
                    <th>Статус</th>
                    <th>Пользователь</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td>№{{$question->id}}</td>

                        <td><a href="{{action("AdminController@edit", $question->id)}}">{{$question->question}}</a></td>

                        <td>{{ $question->rubric->name }}</td>

                        <td>{{$question->publish? "Публикуется" : "Не публикуется"}}</td>

                        <td>{{$question->user->email}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $questions->links() }}
    </div>

    <div class="w-25 p-3">
        @foreach ($errors->all() as $error)
            <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
        <form class="form-horizontal" method="post" action="/admin/settings">
            @csrf
            <legend>Настройки сервиса</legend>
            <div class="form-group">
               <label class="control-label">Суточный лимит</label>
               <div class="col-xlg">
                   <input name="daily_questions_limit" class="form-control" value="{{$settings->daily_questions_limit}}">
               </div>
            </div>
            <div class="form-group">
               <label class="control-label">Персональный лимит</label>
               <div class="col-xlg">
                   <input name="personal_limit" class="form-control" value="{{$settings->personal_limit}}">
               </div>
            </div>
            <div class="form-group">
               <div class="col-xlg">
                  <button type="submit" class="btn btn-primary">Сохранить</button>
               </div>
            </div>
        </form>
    </div>

</div>
@endsection