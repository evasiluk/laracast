@component('mail::message')
# Добрый день!
На сайте на ваш вопрос был опубликован ответ.

Ваш вопрос: {{$question->question}}<br>
Ответ: {{$question->answer}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
