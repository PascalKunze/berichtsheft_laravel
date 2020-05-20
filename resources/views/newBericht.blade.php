@extends ('layout')

@section ('bodycontent')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {

            $("#datepicker").datepicker({dateFormat: "dd.mm.yy"});
        });

    </script>
    <div class="flex-center position-ref full-height">


        <div class="content">
            <div class="title m-b-md">
                Neuer Bericht
            </div>

            <div class="links">
                <a href='{!! url('/'); !!}'>Home </a>
                <a href='{!! url('/azubi/new'); !!}'>Neuer Azubi </a>
                <a href='{!! url('/bericht/new'); !!}'>Neuer Bericht</a>
                <a href='{!! url('/azubi/all'); !!}'>Alle Azubi</a>
                <a href='{!! url('/bericht/all'); !!}'>Bericht Suchen</a>
            </div>
            <br>
            <form method="POST" action={{route('createNewBericht')}}>
                @csrf
                <p>Vorname:</p> <input type="text" name="Vorname">
                <br><br>
                <p>Nachname:</p> <input type="text" name="Nachname">
                <br><br>
                <p>Datum:</p> <input type="text" name="Datum" id="datepicker" value=".">
                <br><br>
                </p>
                <p>Bericht:</p> <textarea name="Bericht" rows="5" cols="40" class="bericht"></textarea>
                <br><br>

                <input type="submit" name="action" value="Speichern" >
            </form>
        </div>
    </div>
@endsection
