@if(session()->has('message'))
<notification message="{{session('message')}}"></notification>
@endif