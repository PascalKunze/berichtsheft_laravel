@extends ('layout')

@section ('bodycontent')
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                Bericht Suchen
            </div>

            <div class="links">
                <a href='{!! url('/'); !!}'>Home </a>
                <a href='{!! url('/azubi/new'); !!}'>Neuer Azubi </a>
                <a href='{!! url('/bericht/new'); !!}'>Neuer Bericht</a>
                <a href='{!! url('/azubi/all'); !!}'>Alle Azubi</a>
                <a href='{!! url('/bericht/all'); !!}'>Bericht Suchen</a>
            </div>
            <br>
            <table border='1px solid black;' class="azubiTable">
                <tr>
                    <th>Mitarbeiter ID</th>
                    <th>Datum</th>
                    <th>Bericht</th>
                    <th>actions</th>
                </tr>
                @foreach($berichte as $bericht)
                    <tr>
                        <td>{{$bericht->mitarbeiter_id}}</td>
                        <td>{{$bericht->Datum}}</td>
                        <td>{{$bericht->Bericht}}</td>
                        <td>
                            <input type='submit' name='action' value='Update' class='btn'>
                            <button class="deleteBericht" data-id="{{ $bericht->id }}" data-token="{{ csrf_token() }}">
                                Löschen
                            </button>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="pagination p9">
                <li>{{$berichte->links()}}</li>
            </div>
        </div>
    </div>
    <script>
        $(".deleteBericht").click(function () {
            var id = $(this).data("id");
            var path = "{!! url('bericht') !!}" + "/" + id;
            var token = $(this).data("token");
            $.ajax(
                {
                    url: path,
                    type: 'DELETE',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                    success: function () {
                        location.reload();
                    }
                });

            console.log("It failed");
        });
    </script>
@endsection
