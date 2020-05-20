@extends ('layout')

@section ('bodycontent')
    <div class="flex-center position-ref full-height">


        <div class="content">
            <div class="title m-b-md">
                Neuer Azubi
            </div>

            <div class="links">
                <a href='{!! url('/'); !!}'>Home </a>
                <a href='{!! url('/azubi/new'); !!}'>Neuer Azubi </a>
                <a href='{!! url('/bericht/new'); !!}'>Neuer Bericht</a>
                <a href='{!! url('/azubi/all'); !!}'>Alle Azubi</a>
                <a href='{!! url('/bericht/all'); !!}'>Bericht Suchen</a>
            </div>
            <br>

            <form method="POST" action={{route('createNewAzubi')}}>
                @csrf
                <p>Vorname:</p> <input type="text" name="VornameMA">
                <br>
                <p>Nachname:</p> <input type="text" name="NachnameMA"><br>
                <br>
                <input type="submit" name="action" value="Anlegen">
            </form>
        </div>
    </div>

@endsection
