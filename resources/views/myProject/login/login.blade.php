


<x-layout>
{{--

    <form action="login/auth">
        <label for="">email</label><input type="text" name="email" value="{{old('email')}}">
        <label for="">password</label><input type="password" name="password" value="{{old('email')}}">
        <input type="submit" value="войти">
        <span class="errorLog">{{session()->get('errorLog')}}</span>
    </form> --}}
    <h2 class="title text-center p-5 mt-5  rounded" style = 'background-color:#E9E8DD; margin-bottom:100px'>Авторизация</h2>

    <form action="login/auth">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
          <input type="email" class="form-control" name="email" aria-describedby="emailHelp" value="{{old('email')}}">
          <div id="emailHelp" class="form-text">Мы никогда никому не передадим вашу электронную почту.</div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Пароль</label>
          <input type="password" class="form-control" name="password" value="{{old('email')}}">
        </div>
        @if (session()->get('errorLog'))
            <span class="errorLog mb-3 alert-danger text-center p-1 mt-1 mb-3 rounded" style = 'background-color:#F8D7D9; display:block;'>{{session()->get('errorLog')}}</span>
        @endif
        <button type="submit " class="btn btn-primary">Войти</button>
      </form>
</x-layout>
