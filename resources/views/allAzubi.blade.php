@extends ('layout')

@section ('bodycontent')
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                Alle Azubis
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
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>actions</th>
                </tr>
                @foreach($azubis as $ma)
                    <tr>
                        <td><input type='textarea' name='nachname' id="vorname" value= {{$ma->Vorname}} ></td>
                        <td><input type='textarea' name='nachname' id="nachname" value= {{$ma->Nachname}} ></td>
                        <td>
                            <button class="updateAzubi" data-id="{{ $ma->id }}" data-token="{{ csrf_token() }}">
                                Update
                            </button>
                            <button class="deleteAzubi" data-id="{{ $ma->id }}" data-token="{{ csrf_token() }}">
                                Löschen
                            </button>

                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="pagination p9">
                <li>{{$azubis->links()}}</li>
            </div>
            <div id="dialog-form" title="Create new user">
                <p class="validateTips">All form fields are required.</p>
                <form method="POST">
                    @csrf
                    <fieldset>
                        <label for="vornamepop">Vorname</label>
                        <input type="text" name="vornamepop" id="vornamepop" value="Platzhalter"
                               class="text ui-widget-content ui-corner-all">
                        <p></p>
                        <label for="nachnamepop">Nachname</label>
                        <input type="text" name="nachnamepop" id="nachnamepop" value="Platzhalter"
                               class="text ui-widget-content ui-corner-all">
                        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
                    </fieldset>
                </form>
            </div>
            <button id="create-user">Create new user</button>
        </div>
    </div>
    <script>
        //--------------------------------------------------------------------(Popout Fenster)
        function addUser() {
            var token = $('input[name="_token"]').val();
            var path = "{!! route('createNewAzubi')!!}";
            var vorname = $('#vornamepop').val();
            var nachname = $('#nachnamepop').val();
            $.ajax(
                {
                    url: path,
                    type: 'POST',
                    dataType: "JSON",
                    data: {
                        "VornameMA": vorname,
                        "NachnameMA": nachname,
                        "_token": token,

                    },
                    success: function () {
                        location.reload();
                    },
                    error: function (data) {
                        if(data.success == true ){
                            alert('f');
                        } else {
                            alert('t')
                        };
                    }
                });

            console.log(token)

        };


        let dialog = $("#dialog-form").dialog({
            autoOpen: false,
            height: 400,
            width: 350,
            modal: true,
            buttons: {
                "Create an account": addUser,
                Cancel: function () {
                    dialog.dialog("close");
                }
            },
            close: function () {
                form[0].reset();
                allFields.removeClass("ui-state-error");
            }
        });


        $("#create-user").button().on("click", function () {


            dialog.dialog("open");


        });
        //------------------------------------------------------------------------------
        $(".deleteAzubi").click(function () {
            var id = $(this).data("id");
            var path = "{!! url('azubi') !!}" + "/" + id
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

        //------------------------------------------------------------------------------


        $(".updateAzubi").click(function () {
            var id = $(this).data("id");
            var path = "{!! url('azubi') !!}" + "/" + id
            $.ajax(
                {
                    url: path,
                    type: 'UPDATE',
                    dataType: "JSON",
                    data: id + popID,
                    success: function (new_data) {
                        $(popID).html(new_data);
                        $(popID).dialog();
                        alert('Load was performed.');
                    }
                });

            console.log("It failed");
        });
        //------------------------------------------------------------------------------

    </script>
@endsection
