<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id_current = Auth::user()->id;
        $members = User::where('id', '!=', $id_current)->get();
        return view('members.index', ['members' => $members]);
    }

    /**
     * @param Request $request
     * @param $user_to
     * @return mixed
     */
    public function conversation(Request $request, $user_to)
    {
        //J'isole l'id de mon User
        $id_current = Auth::user()->id;
        //Je crée un tableau avec l'id du user visé par le message, et l'id du user actuel
        $arraySum = [$user_to, $id_current, 3];
        //Je fais le produit des deux ID fois 3 , afin  d'être sur d'obtenir un ID unique pour la conversation
        $conv_id = array_product($arraySum);

        //je cherche dans Conversation si une ligne existe avec pour id_conv l'id que je viens de créer
        $conversation = Conversation::where('id_conv', $conv_id)->get();

        //Si cette ligne n'existe pas, je vais préparer la table Conversation et Message afin d'accueillir les messages
        if (count($conversation) <= 0) {

            //Je crée une nouvelle ligne avec l'id crée
            Conversation::create([
                'id_conv' => $conv_id,
            ]);

            
            $user_id_to = User::find($user_to);
            
            //Je recupere dans le tableau conversation la ligne que je viens de créer (afin de recuperer l'id de la ligne)
            $getConv = Conversation::where('id_conv',$conv_id)->get();
            //Je recupere les lignes dans la table Message où conversation_id est égale à l'id de la ligne conversation
            $conversations = Message::where('conversation_id',$getConv[0]->id)->get();

            //Je retourne le tout
            return view('members.contact', ['user_id_from' => $id_current, 'user_id_to' => $user_id_to, 'conversations' => $conversations,'id_conv'=>$conv_id]);


        } else {

            $id_current = Auth::user()->id;
            $arraySum = [$user_to, $id_current, 3];
            $conv_id = array_product($arraySum);

            $user_id_from = Auth::user()->id;
            $user_id_to = User::find($user_to);


            $getConv = Conversation::where('id_conv',$conv_id)->get();
            $conversations = Message::where('conversation_id',$getConv[0]->id)->get();

            return view('members.contact', ['user_id_from' => $user_id_from, 'user_id_to' => $user_id_to, 'conversations' => $conversations,'id_conv'=>$conv_id]);

        }
    }


    public function store(Request $request, $user_id, $id_conv)
    {

        $this->validate($request,
            [
                'content_msg' => 'required'
            ],
            [
                'content_msg.required' => 'Votre message ne doit pas être vide'
            ]);

        $conversation = Conversation::where('id_conv',$id_conv)->get();
        Message::create([
            'user_id_from' => Auth::user()->id,
            'user_id_to' => $user_id,
            'content' => $request->content_msg,
            'conversation_id' => $conversation[0]->id,
        ]);
        
        return redirect()->route('members.conv',$user_id);

    }
    
    public function show($user_id) {
        
    }
}
