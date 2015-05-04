<?php

namespace Bundles\UserBundle\Controller;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\DependencyInjection\ContainerAware;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;

class FacebookController extends Controller
{
    public function loginButtonAction()
    {    
        $session = $this->get('session');
        $session->start();   
        FacebookSession::setDefaultApplication('475866559233728', '8e53b056abdf3a0a63ba8bd60ecde993'); 
        $helper = new FacebookRedirectLoginHelper('http://www.yourtastiness.com/facebook_auth');  
        $loginUrl = $helper->getLoginUrl();
        return $this->render('BundlesUserBundle:Facebook:buttonAuth.html.twig', array('loginUrl' => $loginUrl));
    }
    
    public function authLoginAction()
    {
        $sess = $this->get('session');
        $sess->start();   
        FacebookSession::setDefaultApplication('475866559233728', '8e53b056abdf3a0a63ba8bd60ecde993'); 
        $helper = new FacebookRedirectLoginHelper('http://www.yourtastiness.com/facebook_auth');  
        try {
          $session = $helper->getSessionFromRedirect();
        } catch(FacebookRequestException $ex) {
        } catch(AccountStatusException $ex) { }
        if ($session) {
         
            try {
                $user_profile = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
                } catch(FacebookRequestException $e) {
                echo "Exception occured, code: " . $e->getCode();
                echo " with message: " . $e->getMessage();
                } 
                
            try {
                $albums = (new FacebookRequest($session, 'GET', '/'.$user_profile->getId().'/albums'))->execute()->getGraphObject();
                } catch(FacebookRequestException $e) {
                echo "Exception occured, code: " . $e->getCode();
                echo " with message: " . $e->getMessage();
                }     
                
                die(var_dump($albums));
        }

        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('facebookUid' => $user_profile->getId()));
        
        try {
            $this->container->get('fos_user.security.login_manager')->loginUser(
                'main',
                $user,
                new Response);
        } catch (AccountStatusException $ex) { }
        
        return new RedirectResponse($this->generateUrl('main_homepage'));
    }

    public function checkAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
}
