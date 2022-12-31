
<x-layout>


    <div class="main-histories">
        <div class="main-histories__title text-center p-5 mt-5 mb-5 rounded" style = 'background-color:#E9E8DD;'>
            <h2 class="main-histories__title_text title">Истории наших пользователей</h2>
        </div>



        <all-history-component></all-history-component>
{{--
        @if(!empty($histories))
            @foreach ($histories as $history)
                <p><a href="/public/history/{{$history -> id}}">{{$history -> title}}</a></p>

            @endforeach

            {{$histories -> links()}}


        @endif --}}




    </div>





    {{-- @foreach ($histories as $history )
    {{$history}}
    @endforeach --}}

</x-layout>

