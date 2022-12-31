

<x-layout>
    <div class="add-history__title text-center p-5 mt-5 mb-5 rounded" style = 'background-color:#E9E8DD;'>
        <h2>Здесь вы можете добавить свою историю</h2>
    </div>
    <form action="/public/add_history/add_validation">
        <div class="mb-3" style="margin-bottom: 0 !important;">
            <label for="exampleInputEmail1" class="form-label">Тема истории</label>
            <input type="text" name="title" class="form-control" value="{{old('title')}}">
        </div>
        @if ($errors -> has('title'))
            <span class="error_message mb-3 alert-danger text-center p-1 mt-1 mb-3 rounded" style = 'background-color:#F8D7D9; display:block;' >{{$errors -> get('title')[0]}}</span>
        @endif

        <div class="mb-3" style="margin-bottom: 0 !important;">
          <label for="exampleInputPassword1" class="form-label mt-3">Текст</label>
          <input type="text" class="form-control" name="text" value="{{old('text')}}">
        </div>
        @if ($errors -> has('text'))
            <span class="error_message mb-3 alert-danger text-center p-1 mt-1 mb-3 rounded" style = 'background-color:#F8D7D9; display:block;'>{{$errors -> get('text')[0]}}</span>
        @endif
        @if(session('success'))
            <p class="success mb-3 alert-danger text-center p-1 mt-1 mb-3 rounded" style = 'background-color:#D1E6DD;'>{{session('success')}}</p>
        @endif
        <button type="submit " class="btn btn-primary mt-3">Отправить истроию на рассмотрение модератором</button>
      </form>
</x-layout>
