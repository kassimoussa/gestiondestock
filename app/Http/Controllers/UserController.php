<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPass;
use Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.connexion');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function create()
    {
        return view('add_user');
    }

    public function store(Request $request)
    {
        //validate the input
        $request->validate([
            "name" => 'required',
            "email" => 'required|email|unique:users',
            "password" => 'required|min:8|max:16',
            "level" => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->level = $request->level;
        $query = $user->save();

        if ($query) {
            return back()->with('success', 'Ajout réussi !!!');
        } else {
            return back()->with('fail', 'Echec de l\'ajout !!!');
        }

    }

    public function check(Request $request)
    {
        //validate the input
        $request->validate([
            "email" => 'required|email',
            "password" => 'required',
        ]);

        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if ($request->password == $user->password) {
                $request->session()->put('id', $user->id);
                $request->session()->put('level', $user->level);
                $request->session()->put('name', $user->name);
                return redirect('index');
            } else {
                return back()->with('fail', 'Mot de passe incorrecte pour ce compte !');
            }
        } else {
            return back()->with('fail', "Il n'y a pas de compte qui correspond à cet email dans la base des données ! ");
        }
    }

    public function index()
    {
        $stocks = Stock::all();
        $level = session('level');

        return view($level . '.index', compact('stocks'));
    }
    
    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

   public function profile()
    {
        $user = User::where('id', session('id'))->first();

        return view('profile', compact('user'));
    }

    public function change_infos(Request $request, User $user)
    {
        $user->update($request->all());
        return back()->with('success', 'Changement réussi avec succès');
    }

    public function change_pass(Request $request, User $user)
    {
        if ($request->current_password == $user->password) {
            $user->update(['password' => $request->new_password]);
            return back()->with('success', 'Changement réussi avec succès');
        } else {
            return back()->with('fail', 'Le mot de passe que vous avez taper ne correspond pas au mot de passe actuel!');
        }
    }

    public function forgot()
    {
        return view('auth.forgot');
    }

    public function resetpassword(Request $request)
    {

        $to_email = $request->email;
        if (User::where('email', $to_email )->exists()) {
            $request->session()->put('reset', $to_email);
        $rand = rand(100000, 999999);
        User::where('email',  $to_email)
            ->update(['reset_pass' => $rand]);

        Mail::to($to_email)
            ->later(now()->addSeconds(1), new ResetPass($rand));
        return redirect('/resetview');
        }else{
            return back()->with('fail', "Votre email n'apparait pas dans notre base des données");
        }
        
    }

    public function resetview(Request $request)
    {
        return view('auth.reset');
    }

    public function reset(Request $request)
    {
        $to_email = session('reset');
        $user = User::where('email', $to_email)->first();
        $rand =  $user->reset_pass;

        $pass1 = $request->password;
        $pass2 = $request->password2;
        if ($rand == $request->reset_pass) {
            if ($pass1 == $pass2) {
                User::where('email',  $to_email)
                    ->update(['password' => $pass1]);
                return redirect('/');
            } else {
                return back()->with('fail', 'La confirmation et le mot de passe doivent correspondre !');
            }
        } else {
            return back()->with('fail', 'Le code secret est incorrect');
        }
    }

    public function admin(Request $request)
    {
        $users = User::where('id', session('Loggeduser'))->first();

        if (session('userLevel') == '2') {
            return view('2.sih.admin.index', compact('users'));
        } elseif (session('userLevel') == '3') {
            return view('3.admin.index');
        }
    }

    public function list(Request $request)
    {
        // $users = User::orderBy('level', 'asc')->paginate(10);
        $search = $request['search'] ?? "";
        if ($request->has('search')) {
            $search = $request['search'];
            $users = User::Where('level',   $search)
                ->orWhere('name', 'Like', '%' . $search . '%')
                ->orWhere('email', $search)
                ->orWhere('direction', 'Like', '%' . $search . '%')
                ->orWhere('service', 'Like', '%' . $search . '%')
                ->orWhere('level',   $search)
                ->orderBy('name', 'asc')->paginate(10);;
        } else {
            $users = User::orderBy('name', 'asc')->paginate(10);
        }
        if (session('userLevel') == '2') {
            return view('2.sih.admin.listusers', compact('users', 'search'));
        } elseif (session('userLevel') == '3') {
            return view('3.admin.listusers', compact('users', 'search'));
        }
    }

    

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return back()->with('success', 'Modification réussie');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'Suppression réussie');
    }
}
