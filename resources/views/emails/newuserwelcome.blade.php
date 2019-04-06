@component('mail::message')


![alt text](https://github.com/adam-p/markdown-here/raw/master/src/common/images/icon48.png "Logo Title Text 1")

![product](http://procms.devv/images/welcome_email.jpg)

# {{$user->name}}님,{{env('APP_NAME')}}에 회원가입해 주셔서 감사합니다.

이것은 메세지 입니다. 오마이갓. 이 이메일은 마크다운 문법으로 작성되었기 때문에 마크다운 문법을 좀 배울 필요가 있습니다.
회원가입후 보내진 이메일 연습입니다.

	-one

	-two

	-three

@component('mail::button', ['url' => 'http://procms.devv'])
Button Text
@endcomponent

@component('mail::panel', ['url' => 'http://procms.devv'])
This is panel component text
@endcomponent

감사합니다,<br>
{{env('APP_NAME')}}
@endcomponent
