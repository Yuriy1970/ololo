<?php

namespace Bundles\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerAware;

class InstagramController extends Controller
{
    public function loginButtonAction()
    {
        $loginUrl = $this->generateUrl('bundles_user_instagram_auth');
        return $this->render('BundlesUserBundle:Instagram:buttonAuth.html.twig', array('loginUrl' => $loginUrl));
    }
    
    public function authLoginAction()
    {
        $auth_config = array(
            'client_id'         => 'd7cca0c6d2304270b776d2b0f52c7d00',
            'client_secret'     => 'b16b2e2db4ec4a28ab941ca03d2b96b7',
            'redirect_uri'      => 'http://www.yourtastiness.com/',
            'scope'             => array( 'likes', 'comments', 'relationships' )
        );
        
        $auth = new \Instagram\Auth( $auth_config );
        
        
        if(isset($_GET['code'])){
            $tokkken = $auth->getAccessToken( $_GET['code'] );
            var_dump($tokkken);
            return $this->render('BundlesUserBundle:Instagram:buttonAuth.html.twig', array('loginUrl' => $loginUrl));
        }
        
        $auth->authorize();
        return $this->render('BundlesUserBundle:Instagram:buttonAuth.html.twig', array('loginUrl' => $loginUrl));
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
