<?php

use Illuminate\Routing\Controller;
use LucaDegasperi\OAuth2Server\Authorizer;

class OAuthController extends Controller
{
    protected $authorizer;

    public function __construct(Authorizer $authorizer)
    {
        $this->authorizer = $authorizer;

        $this->beforeFilter('auth', ['only' => ['getAuthorize', 'postAuthorize']]);
        $this->beforeFilter('csrf', ['only' => 'postAuthorize']);
        $this->beforeFilter('check-authorization-params', ['only' => ['getAuthorize', 'postAuthorize']]);
    }

    public function postAccessToken()
    {
        return Response::json($this->authorizer->issueAccessToken());
    }

    public function getAuthorize()
    {
        $client_id = Input::get('client_id');

        $params['user_id'] = 1;
        $params_check = $this->authorizer->getAuthCodeRequestParams();


        $redirectUri = $this->authorizer->issueAuthCode('user', $params['user_id'], $params);
        return Redirect::to($redirectUri);
    }


    public function postAuthorize()
    {
        return Response::json("Disallowed, sorry.");
    }


    public function getAuthorizeOrig()
    {
        //return View::make('authorization-form', $this->authorizer->getAuthCodeRequestParams());
    }


    public function postAuthorizeOrig()
    {
        /*// get the user id
        $params['user_id'] = Auth::user()->id;

        $redirectUri = '';

        if (Input::get('approve') !== null) {
            $redirectUri = $this->authorizer->issueAuthCode('user', $params['user_id'], $params);
        }

        if (Input::get('deny') !== null) {
            $redirectUri = $this->authorizer->authCodeRequestDeniedRedirectUri();
        }

        return Redirect::to($redirectUri);*/
    }



}
