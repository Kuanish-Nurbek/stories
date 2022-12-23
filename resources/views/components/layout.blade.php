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




		<x-footer.footer />

	</body>
</html>
