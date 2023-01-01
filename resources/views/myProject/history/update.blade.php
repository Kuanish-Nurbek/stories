@if ( (session('histori')) != null) {{-- histori мы записали после изменения истории в контроллере  --}}
   @php
    $title = session('histori')['title'];
    $text = session('histori')['text'];
        session() -> forget('histori')   // удаляем сессию для того чтобы не было ошибки если юзер захочет изменить другую историю
   @endphp

@else           {{-- histories данного юзера мы записали в сесию в компоненте user-histories  --}}
    @foreach (session('histories') as $story)
    @if ($story['id'] == session('id'))
    @php
        $title = $story['title'];
        $text = $story['text'];
    @endphp
    @endif
    @endforeach
@endif


<x-layout>
    <div class="main-history-update history-update">
        <div class="history-update__title ">
            <h2 class="title text-center p-5 mt-5  rounded" style = 'background-color:#E9E8DD; margin-bottom:100px'>Здесь вы можете обновить вашу историю</h2>
        </div>


        <form action="/public/update/make" method="POST">
            @csrf

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Тайтл</label>
              <input type="text" class="form-control" name="title" aria-describedby="emailHelp" value="{{ $title }}">
              {{-- <div id="emailHelp" class="form-text">Мы никогда никому не передадим вашу электронную почту.</div> --}}
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Текст</label>
                {{-- <input type="text" class="form-control" name="text" value="{{ $text }}"> --}}
                {{-- <textarea name="text"  cols="30" rows="10" value="{{ $text }}"></textarea> --}}
                {{-- <label for="exampleFormControlTextarea1" class="form-label">Текст</label> --}}
                <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ $text }}"></textarea>
            </div>
            <p class="success">{{session('success')}}</p>

            {{-- @if (session()->get('errorLog'))
                <span class="errorLog mb-3 alert-danger text-center p-1 mt-1 mb-3 rounded" style = 'background-color:#F8D7D9; display:block;'>{{session()->get('errorLog')}}</span>
            @endif --}}

            <button type="submit " class="btn btn-primary">Обновить</button>
          </form>


        {{-- <form action="/public/update/make" method="POST">
            @csrf
            <label for="">title</label><input type="text" name="title" value="{{ $title }}">
            <label for="">text</label><input type="text" name="text" value="{{ $text }}">
            <input type="submit" value="обновить">
        </form> --}}
        {{-- <p class="success">{{session('success')}}</p> --}}
    </div>

</x-layout>

