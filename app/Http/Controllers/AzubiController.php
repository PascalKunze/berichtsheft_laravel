<?php


namespace app\Http\Controllers;


use App\Models\Mitarbeiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AzubiController
{
    public function getViewNewAzubi()
    {

        return view("newAzubi");
    }

    public function createNewAzubi(Request $request)
    {
        $vorname = $request->input('VornameMA');
        $nachname = $request->input('NachnameMA');
        //return response('Bitte VornameMa eingeben!',500);
        $newMa = new Mitarbeiter();
        $newMa->Vorname = $vorname;
        $newMa->Nachname = $nachname;
        $newMa->save();

        return redirect('/azubi/new');
    }

    public function getAzubi($azubiId = null)
    {
        $azubis = null;
        if (!$azubiId) {
            $azubis = DB::table('tbl_Mitarbeiter')->paginate(5);

        } else {
            $azubis = Mitarbeiter::where('id', $azubiId)->firstOrFail();
        }
        return view('allAzubi', ['azubis' => $azubis]);
    }

    private function getAll()
    {
        $azubis = Mitarbeiter::all();
        return $azubis;
    }

    public function deleteAzubi($id)
    {

        $mitarbeiter = Mitarbeiter::find($id);
        $mitarbeiter->delete();

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }

    public function updateAzubi(id $ma)
    {
        $ma->Vorname = request('vorname');
        $ma->Nachname = request('nachname');
        $ma->save();
    }

}
