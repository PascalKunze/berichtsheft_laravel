<?php


namespace App\Http\Controllers;


use App\Models\Bericht;
use App\Models\Mitarbeiter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerichteController extends Controller
{

    public function getViewNewBericht()
    {
        return view("newBericht");
    }


    public function createNewBericht(Request $request)
    {
        $vorname = $request-> input("VornameMa");
        $nachname = $request-> input("NachnameMa");
        $date = $request->input('Datum');
        $bericht = $request->input('Bericht');
        //return response('Bitte VornameMa eingeben!',500);
        $maid = Mitarbeiter::where("Vorname", $request->input('Vorname'))->where("Nachname", $request->input('Nachname'));
        $id = $maid->firstOrFail(['id']);
        /*if (!$date || !$bericht || !$vorname || !$nachname ) {
            die("Du hast eins der Felder vergessen auszufüllen!");

        }*/
            $newBericht = new Bericht();
            $newBericht->mitarbeiter_id = $id->id;
            $newBericht->Datum = $date;
            $newBericht->Bericht = $bericht;
            $newBericht->save();

            return redirect('/bericht/new');
    }

    public function getBericht($berichtId = null)
    {
        $berichte = null;
        if (!$berichtId) {
            $berichte = DB::table('tbl_Berichte')->paginate(5);
        } else {
            $berichte = Bericht::where('id', $berichtId)->firstOrFail();
        }
        return view('searchBericht', ['berichte' => $berichte]);
    }

    private function getAll()
    {
        $berichte=Bericht::all();
        return $berichte;
    }

    public function deleteBericht($id)
    {

        $bericht = Bericht::find($id);
        $bericht->delete();

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }
}

