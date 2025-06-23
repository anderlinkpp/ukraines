<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CaptchaController extends AbstractController
{
    /**
     * @Route("/verify-captcha", name="verify_captcha", methods={"POST"})
     */
    public function verifyCaptcha(Request $request): JsonResponse
    {
        // Récupération de la réponse du captcha du formulaire
        $captchaResponse = $request->request->get('g-recaptcha-response');

        // Clé secrète reCAPTCHA
        $secretKey = '6LdqhaUpAAAAAB6zIppY9IzPkBfgnboiCEXZSe08';

        // Adresse IP de l'utilisateur
        $userIP = $request->getClientIp();

        // URL de vérification de reCAPTCHA de Google
        $verifyURL = 'https://www.google.com/recaptcha/api/siteverify';

        // Paramètres de la requête POST
        $postData = array(
            'secret' => $secretKey,
            'response' => $captchaResponse,
            'remoteip' => $userIP
        );

        // Configuration de la requête
        $options = array(
            'http' => array(
                'method' => 'POST',
                'content' => http_build_query($postData)
            )
        );

        // Création du contexte de la requête
        $context = stream_context_create($options);

        // Envoi de la requête POST à Google pour la vérification
        $response = file_get_contents($verifyURL, false, $context);

        // Décodage de la réponse JSON
        $result = json_decode($response);

        // Vérification du résultat de la réponse
        if ($result->success) {
            // Le captcha est valide
            return new JsonResponse(['success' => true]);
        } else {
            // Le captcha est invalide
            return new JsonResponse(['success' => false], 400);
        }
    }
}
