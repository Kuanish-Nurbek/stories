
@if (count($histories) != 0)
@php
    // записываем в сессию для того чтобы ставить в атрибут value в представлении update
    session() -> put('histories',$histories);
@endphp
<userhistories>
<div class="main__user_histories user-histories">
    <div class="user-histories__title">
        <h2 class="title">Вами созданные истории</h2>
    </div>
    <div class="user-histories__body">
        <table class="user-histories__table">
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Update</th>
                <th>Delete</th>
            </th>
                @foreach ($histories as $history )
                    <tr>
                        <td>{{$history['title']}}</td>
                        <td>{{$history['date_of_made']}}</td>
                        <td><a href="/public/update/{{$history['id']}}">Update</a></td>
                        <td><a href="/public/delete/{{$history['id']}}">Delete</a></td>
                    </tr>
                @endforeach
        </table>
    </div>
</div>
</userhistories>
@endif


