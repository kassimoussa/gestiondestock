<?php

namespace App\Http\Controllers;

use App\Models\Rentree;
use App\Models\Sortie;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dir = session('dir');
        $service = session('service');
        $sih = 'IT HelpDesk';
        if (session('userLevel') == '1') {
            return view('1.stock.create');
        } elseif (session('userLevel') == '2') {
            if ($service == $sih) {
                return view('2.sih.stock.create');
            } else {
                return view('2.stock.create');
            }
        } elseif (session('userLevel') == '3') {
            return view('3.stock.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMateriel(Request $request)
    {
        $nom_materiel = $request->input('nom_materiel');
        $quantite = $request->input('quantite');
        $nbr = count($nom_materiel);

        for ($i = 0; $i < $nbr; $i++) {
            $stock = new Stock();
            $stock->materiel = $nom_materiel[$i];
            $stock->quantite = $quantite[$i];
            $query = $stock->save();
        }
        if ($query) {
            return back()->with('success', 'Ajout réussi');
        } else {
            return back()->with('fail', 'Echec de l\'ajout ');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        return view('1.stock.edit', compact('stock'));
    }
    public function rentree(Stock $stock)
    {
        $rentrees = Rentree::where('materiel', $stock->materiel)->orderby('date_rentree', 'desc')->get();
       
        return view('1.rentree', compact('stock', "rentrees"));
    }

    public function sortie(Stock $stock)
    {
        $sorties = Sortie::where('materiel', $stock->materiel)->orderby('date_sortie', 'desc')->get(); 
        
        return view('1.sortiee', compact('stock', "sorties"));
    }

    public function soustraction(Request $request, Stock $stock)
    {
        $old_quantite = $stock->quantite;
        $new_quantite =  $old_quantite - $request->quantite;
        $query1 = $stock->update(['quantite' => $new_quantite]);

        $sortie = new Sortie();
        $sortie->materiel = $stock->materiel;
        $sortie->quantite = $request->quantite;
        $sortie->raison = $request->raison;
        $sortie->date_sortie = $request->date_sortie;
        $query2 = $sortie->save();
        if ($query1 && $query2) {
            return back()->with('success', 'Rétrait effectué');
        } else {
            return back()->with('fail', 'Echec du rétrait ');
        }
    }

    public function addition(Request $request, Stock $stock)
    {
        $old_quantite = $stock->quantite;
        $new_quantite =  $old_quantite + $request->quantite;
        $query1 = $stock->update(['quantite' => $new_quantite]);

        $rentree = new Rentree();
        $rentree->materiel = $stock->materiel;
        $rentree->quantite = $request->quantite;
        $rentree->fournisseur = $request->fournisseur;
        $rentree->date_rentree = $request->date_rentree;
        $query2 = $rentree->save();
        if ($query1 && $query2) {
            return back()->with('success', 'Ajout effectué');
        } else {
            return back()->with('fail', 'Echec de l\'ajout ');
        }
    }

    public function allsortie()
    {
        $annee = '';

        for ($i = 1; $i <= 12; $i++) {
            $sorties[$i] = Sortie::whereMonth('date_sortie',  $i)->count();
        } 

        $janvier = Sortie::whereMonth('date_sortie',  "1")->orderby('date_sortie', 'desc')->get(); 
        $fevrier = Sortie::whereMonth('date_sortie',  "2")->orderby('date_sortie', 'desc')->get(); 
        $mars = Sortie::whereMonth('date_sortie',  "3")->orderby('date_sortie', 'desc')->get(); 
        $avril = Sortie::whereMonth('date_sortie',  "4")->orderby('date_sortie', 'desc')->get(); 
        $mai = Sortie::whereMonth('date_sortie',  "5")->orderby('date_sortie', 'desc')->get(); 
        $juin = Sortie::whereMonth('date_sortie',  "6")->orderby('date_sortie', 'desc')->get(); 
        $juillet = Sortie::whereMonth('date_sortie',  "7")->orderby('date_sortie', 'desc')->get(); 
        $aout = Sortie::whereMonth('date_sortie',  "8")->orderby('date_sortie', 'desc')->get(); 
        $septembre = Sortie::whereMonth('date_sortie',  "9")->orderby('date_sortie', 'desc')->get(); 
        $octobre = Sortie::whereMonth('date_sortie',  "10")->orderby('date_sortie', 'desc')->get(); 
        $novembre = Sortie::whereMonth('date_sortie',  "11")->orderby('date_sortie', 'desc')->get(); 
        $decembre = Sortie::whereMonth('date_sortie',  "12")->orderby('date_sortie', 'desc')->get(); 

        return view('1.all_sortiee', compact('annee','sorties', 'janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre', ));
    }

    public function allsortieby(Request $request)
    {
        $annee = $request->input('annee');
        $dir = session('dir');
        $service = session('service');
        $sih = 'IT HelpDesk'; 
        
        if ($annee == "ALL" || $annee == null) {
            return redirect('/stocks/allsortie');
        } else {
            for ($i = 1; $i <= 12; $i++) {
                $sorties[$i] = Sortie::whereYear('date_sortie',  $annee)->whereMonth('date_sortie',  $i)->count();
            } 
    
            $janvier = Sortie::whereYear('date_sortie',  $annee)->whereMonth('date_sortie',  "1")->orderby('date_sortie', 'desc')->get(); 
            $fevrier = Sortie::whereYear('date_sortie',  $annee)->whereMonth('date_sortie',  "2")->orderby('date_sortie', 'desc')->get(); 
            $mars = Sortie::whereYear('date_sortie',  $annee)->whereMonth('date_sortie',  "3")->orderby('date_sortie', 'desc')->get(); 
            $avril = Sortie::whereYear('date_sortie',  $annee)->whereMonth('date_sortie',  "4")->orderby('date_sortie', 'desc')->get(); 
            $mai = Sortie::whereYear('date_sortie',  $annee)->whereMonth('date_sortie',  "5")->orderby('date_sortie', 'desc')->get(); 
            $juin = Sortie::whereYear('date_sortie',  $annee)->whereMonth('date_sortie',  "6")->orderby('date_sortie', 'desc')->get(); 
            $juillet = Sortie::whereYear('date_sortie',  $annee)->whereMonth('date_sortie',  "7")->orderby('date_sortie', 'desc')->get(); 
            $aout = Sortie::whereYear('date_sortie',  $annee)->whereMonth('date_sortie',  "8")->orderby('date_sortie', 'desc')->get(); 
            $septembre = Sortie::whereYear('date_sortie',  $annee)->whereMonth('date_sortie',  "9")->orderby('date_sortie', 'desc')->get(); 
            $octobre = Sortie::whereYear('date_sortie',  $annee)->whereMonth('date_sortie',  "10")->orderby('date_sortie', 'desc')->get(); 
            $novembre = Sortie::whereYear('date_sortie',  $annee)->whereMonth('date_sortie',  "11")->orderby('date_sortie', 'desc')->get(); 
            $decembre = Sortie::whereYear('date_sortie',  $annee)->whereMonth('date_sortie',  "12")->orderby('date_sortie', 'desc')->get(); 
    
            return view('1.all_sortiee', compact('annee','sorties', 'janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre', ));
        }
    }

    public function allrentree()
    {
        $annee = '';
        $dir = session('dir');
        $service = session('service');
        $sih = 'IT HelpDesk'; 

        for ($i = 1; $i <= 12; $i++) {
            $rentres[$i] = Rentree::whereMonth('date_rentree',  $i)->count();
        } 

        $janvier = Rentree::whereMonth('date_rentree',  "1")->orderby('date_rentree', 'desc')->get(); 
        $fevrier = Rentree::whereMonth('date_rentree',  "2")->orderby('date_rentree', 'desc')->get(); 
        $mars = Rentree::whereMonth('date_rentree',  "3")->orderby('date_rentree', 'desc')->get(); 
        $avril = Rentree::whereMonth('date_rentree',  "4")->orderby('date_rentree', 'desc')->get(); 
        $mai = Rentree::whereMonth('date_rentree',  "5")->orderby('date_rentree', 'desc')->get(); 
        $juin = Rentree::whereMonth('date_rentree',  "6")->orderby('date_rentree', 'desc')->get(); 
        $juillet = Rentree::whereMonth('date_rentree',  "7")->orderby('date_rentree', 'desc')->get(); 
        $aout = Rentree::whereMonth('date_rentree',  "8")->orderby('date_rentree', 'desc')->get(); 
        $septembre = Rentree::whereMonth('date_rentree',  "9")->orderby('date_rentree', 'desc')->get(); 
        $octobre = Rentree::whereMonth('date_rentree',  "10")->orderby('date_rentree', 'desc')->get(); 
        $novembre = Rentree::whereMonth('date_rentree',  "11")->orderby('date_rentree', 'desc')->get(); 
        $decembre = Rentree::whereMonth('date_rentree',  "12")->orderby('date_rentree', 'desc')->get(); 

        return view('1.all_rentree', compact('annee','rentres', 'janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre', ));
    }

    public function allrentreeby(Request $request)
    {
        $annee = $request->input('annee');
        $dir = session('dir');
        $service = session('service');
        $sih = 'IT HelpDesk'; 
        
        if ($annee == "ALL" || $annee == null) {
            return redirect('/stocks/allrentree');
        } else {
            for ($i = 1; $i <= 12; $i++) {
                $rentres[$i] = Rentree::whereYear('date_rentree',  $annee)->whereMonth('date_rentree',  $i)->count();
            } 
    
            $janvier = Rentree::whereYear('date_rentree',  $annee)->whereMonth('date_rentree',  "1")->orderby('date_rentree', 'desc')->get(); 
            $fevrier = Rentree::whereYear('date_rentree',  $annee)->whereMonth('date_rentree',  "2")->orderby('date_rentree', 'desc')->get(); 
            $mars = Rentree::whereYear('date_rentree',  $annee)->whereMonth('date_rentree',  "3")->orderby('date_rentree', 'desc')->get(); 
            $avril = Rentree::whereYear('date_rentree',  $annee)->whereMonth('date_rentree',  "4")->orderby('date_rentree', 'desc')->get(); 
            $mai = Rentree::whereYear('date_rentree',  $annee)->whereMonth('date_rentree',  "5")->orderby('date_rentree', 'desc')->get(); 
            $juin = Rentree::whereYear('date_rentree',  $annee)->whereMonth('date_rentree',  "6")->orderby('date_rentree', 'desc')->get(); 
            $juillet = Rentree::whereYear('date_rentree',  $annee)->whereMonth('date_rentree',  "7")->orderby('date_rentree', 'desc')->get(); 
            $aout = Rentree::whereYear('date_rentree',  $annee)->whereMonth('date_rentree',  "8")->orderby('date_rentree', 'desc')->get(); 
            $septembre = Rentree::whereYear('date_rentree',  $annee)->whereMonth('date_rentree',  "9")->orderby('date_rentree', 'desc')->get(); 
            $octobre = Rentree::whereYear('date_rentree',  $annee)->whereMonth('date_rentree',  "10")->orderby('date_rentree', 'desc')->get(); 
            $novembre = Rentree::whereYear('date_rentree',  $annee)->whereMonth('date_rentree',  "11")->orderby('date_rentree', 'desc')->get(); 
            $decembre = Rentree::whereYear('date_rentree',  $annee)->whereMonth('date_rentree',  "12")->orderby('date_rentree', 'desc')->get(); 
    
            return view('1.all_rentree', compact('annee','rentres', 'janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre', ));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return back()->with('success', 'Matériel supprimé');
    }
}
