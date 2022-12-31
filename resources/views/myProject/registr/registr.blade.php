<x-layout>

    <h2 class="title text-center p-5 mt-5  rounded" style = 'background-color:#E9E8DD; margin-bottom:100px'>Регистрация</h2>

    <form action="/public/registr/validation">
        <div class="mb-3" style="margin-bottom: 0 !important;">
            <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
            <input type="text" name="email" class="form-control">
        </div>
        @if($errors -> has('email'))
            <span class="errorLog mb-3 alert-danger text-center p-1 mt-1 mb-3 rounded" style = 'background-color:#F8D7D9; display:block;'>{{$errors -> get('email')[0]}}</span>
        @endif

        <div class="mb-3" style="margin-bottom: 0 !important;">
          <label for="exampleInputPassword1" class="form-label mt-3">Пароль</label>
          <input type="password" class="form-control" name="password" value="{{old('email')}}">
        </div>
        @if($errors -> has('password'))
            <span class="errorLog mb-3 alert-danger text-center p-1 mt-1 mb-3 rounded" style = 'background-color:#F8D7D9; display:block;'>{{$errors -> get('password')[0]}}</span>
        @endif
        <button type="submit " class="btn btn-primary mt-3">Зарегистрироваться</button>
      </form>

</x-layout>

