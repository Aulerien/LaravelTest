<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class verifier extends Controller
{



    public function tester(Request $request)
    {
        $nomMail = $request->get('testname');
        $etat = $this->VerifierMail($nomMail);
        dump($etat);
        die();
        return new JsonResponse(array('resulat' => $etat));
    }

    //

    /*
     Ce code permet, si votre hebergement permet les socket, de verifier la validite d'une adresse email
    au niveau serveur. Donc, une adresse de forme xxx@xxx.com sera peut etre bonne au niveau syntaxe,
    mais renverra une erreur, car non connu au niveau du serveur MX
     */

    function VerifierMail($Email) {

        global $HTTP_HOST;
        $Return = array();

        if (!filter_var(trim($Email), FILTER_VALIDATE_EMAIL))
        {
            $Return[0]=false;
            $Return[1]="$Email a un format non valide.";
            return $Return;
        }

       /*
        if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $Email)) {    // test si le format de l'email est bon
            $Return[0]=false;
            $Return[1]="$Email a un format non valide.";
            return $Return;
        }*/

        //list($Username, $Domain) = split("@", $Email);  // Split le nom et le domaine
        list($Username, $Domain) = explode("@", $Email);  // Split le nom et le domaine

        if (checkdnsrr($Domain, "MX")) { //verifie existance serveur de mail sur ce domaine
            if (getmxrr($Domain, $MXHost)) { // Si enregitrement MX , on le met comme adresse de connexion
                for ($i = 0,$j = 1; $i < count ($MXHost); $i++,$j++) {
                    echo "Result($j) - $MXHost[$i]<BR>";
                }
            }
            $ConnectAddress = $MXHost[0];
        } else {   // Si pas d'enregistrement MX, on met simplement le domaine comme adresse de connexion
            $ConnectAddress = $Domain;
        }

        $Connect = fsockopen($ConnectAddress, 25);

        if ($Connect) {  // Si socket ouvert
            if (preg_match("/^220/", $Out = fgets($Connect, 1024))) {
                fputs($Connect, "HELO $HTTP_HOST\r\n");
                $Out = fgets($Connect, 1024);
                fputs($Connect, "MAIL FROM: <{$Email}>\r\n");
                $From = fgets($Connect, 1024);
                fputs($Connect, "RCPT TO: <{$Email}>\r\n");
                $To = fgets($Connect, 1024);
                fputs($Connect, "QUIT\r\n");
                fclose($Connect);

                if (!preg_match ("/^250/", $From) || !preg_match ("/^250/", $To)) { // Si adresse n'existe pas
                    $Return[0]=false;
                    $Return[1]="$Email n'existe pas sur le serveur mail.";
                    return $Return;
                }
            }
        } else { // Si la connection echoue
            $Return[0] = false;
            $Return[1] = "Impossible de se connecter au serveur mail ($ConnectAddress).";
            return $Return;
        }

        // Si tout est OK
        $Return[0]=true;
        $Return[1]="$Email EXISTE BIEN.";
        return $Return;
    }
}
