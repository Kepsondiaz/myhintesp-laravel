<div>
    @foreach($users as $user)
    {
        <p>{{$user->name}}  {{$user->email}}</p>
    }
    @
</div>