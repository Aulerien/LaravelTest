<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class MonMail extends Controller
{
    public function envoyer(Request $request)
    {
        $titre = $request->get('titre');
        $contenu = $request->get('message');
        $destination = $request->get('destination');
        $nom = $request->get('nom');

        try
        {

            $data = ['email'=> $destination,'name'=> $nom,'subject' => $titre, 'content' => $contenu];
            Mail::send('Mail/notification', $data, function($message) use($data)
            {
                $subject = $data['subject'];
                $message->from('info@www.jtek-solutions.com');
                $message->to($data['email'], 'JTEK-Solutions')->subject($subject);
            });
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }

        $request->session()->flash('message.envoyer', 'success');
        $request->session()->flash('message.contenu', 'Mail bien envoyer !');
        return \redirect()->route('accueil');
    }
}
