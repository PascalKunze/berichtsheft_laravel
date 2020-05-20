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
                <a href='{!! url('/azubi/'); !!}'>Alle Azubi</a>
                <a href='{!! url('/bericht/search'); !!}'>Bericht Suchen</a>
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

                            <div id="dialog-form" title="Create new user">
                                <p class="validateTips">All form fields are required.</p>

                                <form>
                                    <fieldset>
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" value="Jane Smith" class="text ui-widget-content ui-corner-all">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" value="jane@smith.com" class="text ui-widget-content ui-corner-all">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" value="xxxxxxx" class="text ui-widget-content ui-corner-all">

                                        <!-- Allow form submission with keyboard without duplicating the dialog button -->
                                        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
                                    </fieldset>
                                </form>
                            </div>


                            <div id="users-contain" class="ui-widget">
                                <h1>Existing Users:</h1>
                                <table id="users" class="ui-widget ui-widget-content">
                                    <thead>
                                    <tr class="ui-widget-header ">
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>John Doe</td>
                                        <td>john.doe@example.com</td>
                                        <td>johndoe1</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button id="create-user">Create new user</button>


                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="pagination p9">
                <li>{{$azubis->links()}}</li>
            </div>
        </div>
    </div>
    <script>


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
                    data: id + popID ,
                    success: function (new_data) {
                        $(popID).html(new_data);
                        $(popID).dialog();
                        alert('Load was performed.');
                    }
                });

            console.log("It failed");
        });

    </script>
    <script>
        $( function() {
            var dialog, form,

                // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
                emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
                name = $( "#name" ),
                email = $( "#email" ),
                password = $( "#password" ),
                allFields = $( [] ).add( name ).add( email ).add( password ),
                tips = $( ".validateTips" );

            function updateTips( t ) {
                tips
                    .text( t )
                    .addClass( "ui-state-highlight" );
                setTimeout(function() {
                    tips.removeClass( "ui-state-highlight", 1500 );
                }, 500 );
            }

            function checkLength( o, n, min, max ) {
                if ( o.val().length > max || o.val().length < min ) {
                    o.addClass( "ui-state-error" );
                    updateTips( "Length of " + n + " must be between " +
                        min + " and " + max + "." );
                    return false;
                } else {
                    return true;
                }
            }

            function checkRegexp( o, regexp, n ) {
                if ( !( regexp.test( o.val() ) ) ) {
                    o.addClass( "ui-state-error" );
                    updateTips( n );
                    return false;
                } else {
                    return true;
                }
            }

            function addUser() {
                var valid = true;
                allFields.removeClass( "ui-state-error" );

                valid = valid && checkLength( name, "username", 3, 16 );
                valid = valid && checkLength( email, "email", 6, 80 );
                valid = valid && checkLength( password, "password", 5, 16 );

                valid = valid && checkRegexp( name, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
                valid = valid && checkRegexp( email, emailRegex, "eg. ui@jquery.com" );
                valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );

                if ( valid ) {
                    $( "#users tbody" ).append( "<tr>" +
                        "<td>" + name.val() + "</td>" +
                        "<td>" + email.val() + "</td>" +
                        "<td>" + password.val() + "</td>" +
                        "</tr>" );
                    dialog.dialog( "close" );
                }
                return valid;
            }

            dialog = $( "#dialog-form" ).dialog({
                autoOpen: false,
                height: 400,
                width: 350,
                modal: true,
                buttons: {
                    "Create an account": addUser,
                    Cancel: function() {
                        dialog.dialog( "close" );
                    }
                },
                close: function() {
                    form[ 0 ].reset();
                    allFields.removeClass( "ui-state-error" );
                }
            });

            form = dialog.find( "form" ).on( "submit", function( event ) {
                event.preventDefault();
                addUser();
            });

            $( "#create-user" ).button().on( "click", function() {
                dialog.dialog( "open" );
            });
        } );
    </script>
@endsection
