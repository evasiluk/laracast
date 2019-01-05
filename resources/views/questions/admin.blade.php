@extends('master')
@section('title', 'Questions list')

@section('content')

<div class="container col-md-8 col-md-offset-2">
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

                    <td>{{ $rubrics_ar[$question->rubric_id] }}</td>

                    <td>{{$question->publish? "Публикуется" : "Не публикуется"}}</td>

                    <td>{{$question->user->email}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection