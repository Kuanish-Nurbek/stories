<!DOCTYPE html>
<html>
	<head>
		<x-meta.meta />
		<title>{!! isset($title) ? $title : 'title' !!}</title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
	</head>
	<body class="className">
        <div id="app">

            <x-header.header>
            </x-header.header >

            <div class="container h-100" >

                {{-- @yield('content') --}}

                {{-- <example-component></example-component>

                <post-component></post-component>

                <component-users :users="{{ json_encode(\App\Models\User::query() -> get()) }}" ></component-users> --}}

                {{-- <user-name-component></user-name-component> --}}



                {{-- В $slot  попадает то что в предствалениях которые ссылаются в этот layout  --}}
                <x-main.main>
                    @if(isset($slot))
                    {{$slot}}
                    @endif
                </x-main.main>




            </div>


            <x-footer.footer />



        </div>



	</body>
</html>
