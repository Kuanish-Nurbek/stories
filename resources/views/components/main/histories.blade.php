
@if (is_countable($histories) && count($histories) != 0)
@php
    // записываем в сессию для того чтобы ставить в атрибут value в представлении update
    session() -> put('histories',$histories);
@endphp
<div class="main__user_histories user-histories">
    <div class="user-histories__title">
        <h2 class="title text-center p-5 mt-5 mb-3 rounded" style = 'background-color:#E9E8DD;'>Вами созданные истории</h2>
    </div>
    <div class="user-histories__body">
        <table class="table">
            <thead>
              <tr>
                {{-- <th scope="col">#</th> --}}
                <th scope="col">Title</th>
                <th scope="col">Date</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($histories as $history )
                <tr>
                    <td>{{$history['title']}}</td>
                    <td>{{$history['date_of_made']}}</td>
                    <td><a href="/update/{{$history['id']}}">Update</a></td>
                    <td><a href="/delete/{{$history['id']}}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
          </table>


    </div>
</div>
@endif


