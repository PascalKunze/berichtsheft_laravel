@extends ('layout')

@section ('bodycontent')
    <div class="flex-center position-ref full-height">


        <div class="content">
            <div class="title m-b-md">
                Berichtsheft
            </div>

            <div class="links">
                <a href='{!! url('/'); !!}'>Home </a>
                <a href='{!! url('/azubi/new'); !!}'>Neuer Azubi </a>
                <a href='{!! url('/bericht/new'); !!}'>Neuer Bericht</a>
                <a href='{!! url('/azubi/all'); !!}'>Alle Azubi</a>
                <a href='{!! url('/bericht/all'); !!}'>Bericht Suchen</a>
            </div>
        </div>
    </div>
@endsection
