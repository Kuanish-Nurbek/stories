    <!DOCTYPE html>
<html>
	<head>
		<x-meta.meta />
		<title>{!! isset($title) ? $title : 'title' !!}</title>

	</head>
	<body class="className">



		<x-header.header >

        </x-header.header >



        {{-- В $slot  попадает то что в предствалениях которые ссылаются в этот layout  --}}

		<x-main.main>
			@if(isset($slot))
			{{$slot}}
			@endif
		</x-main.main>


        <div id="app">
            <example-component>
                
            </example-component>
        </div>

		<x-footer.footer />

        <script src='build/assets/app.9f37aa36.js'></script>
	</body>
</html>
