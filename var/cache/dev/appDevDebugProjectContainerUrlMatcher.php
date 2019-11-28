<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevDebugProjectContainerUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler_open_file
                if ($pathinfo === '/_profiler/open') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:openAction',  '_route' => '_profiler_open_file',);
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        $host = $this->context->getHost();

        if (preg_match('#^predoc\\-administrator\\.localhost$#si', $host, $hostMatches)) {
            if (0 === strpos($pathinfo, '/a')) {
                // affichermsg
                if (rtrim($pathinfo, '/') === '/affichermsg') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'affichermsg');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Administrator\\ContactController::AfficherMsgAction',  '_route' => 'affichermsg',);
                }

                // adduser
                if ($pathinfo === '/adduser') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Administrator\\HomeController::AjouterAction',  '_route' => 'adduser',);
                }

            }

            if (0 === strpos($pathinfo, '/questionnaire')) {
                // list_questionnaire
                if (rtrim($pathinfo, '/') === '/questionnaire') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'list_questionnaire');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Administrator\\QuestionnaireController::listAction',  '_route' => 'list_questionnaire',);
                }

                // public
                if (0 === strpos($pathinfo, '/questionnaire/public') && preg_match('#^/questionnaire/public/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'public')), array (  '_controller' => 'AppBundle\\Controller\\Administrator\\QuestionnaireController::publicAction',));
                }

            }

            if (0 === strpos($pathinfo, '/user')) {
                // list_user
                if (rtrim($pathinfo, '/') === '/user') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'list_user');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Administrator\\UserController::listAction',  '_route' => 'list_user',);
                }

                // edit_user
                if (0 === strpos($pathinfo, '/user/edit') && preg_match('#^/user/edit/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'edit_user')), array (  '_controller' => 'AppBundle\\Controller\\Administrator\\UserController::editAction',));
                }

                // add_user
                if ($pathinfo === '/user/add') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Administrator\\UserController::ajouterAction',  '_route' => 'add_user',);
                }

            }

            // admin_homepage
            if (rtrim($pathinfo, '/') === '') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_homepage');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\Administrator\\HomeController::indexAction',  '_route' => 'admin_homepage',);
            }

            // admin_login
            if ($pathinfo === '/login') {
                return array (  '_controller' => 'AppBundle\\Controller\\Administrator\\SecurityController::loginAction',  '_route' => 'admin_login',);
            }

        }

        if (preg_match('#^predoc\\-doctor\\.localhost$#si', $host, $hostMatches)) {
            // help
            if (0 === strpos($pathinfo, '/contact') && preg_match('#^/contact/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'help')), array (  '_controller' => 'AppBundle\\Controller\\Doctor\\HomeController::helpAction',));
            }

            if (0 === strpos($pathinfo, '/questionnaire')) {
                // doctor_questionnaire
                if (rtrim($pathinfo, '/') === '/questionnaire') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'doctor_questionnaire');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::indexAction',  '_route' => 'doctor_questionnaire',);
                }

                // new_doctor_questionnaire
                if ($pathinfo === '/questionnaire/new') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::newAction',  '_route' => 'new_doctor_questionnaire',);
                }

                // save_questionnaire
                if ($pathinfo === '/questionnaire/save-questionnaire') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::saveAction',  '_route' => 'save_questionnaire',);
                }

                // edit_doctor_questionnaire
                if (0 === strpos($pathinfo, '/questionnaire/edit') && preg_match('#^/questionnaire/edit/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'edit_doctor_questionnaire')), array (  '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::editAction',));
                }

                // save_edit_questionnaire
                if (0 === strpos($pathinfo, '/questionnaire/save-edit') && preg_match('#^/questionnaire/save\\-edit/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'save_edit_questionnaire')), array (  '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::saveEditAction',));
                }

                // up
                if ($pathinfo === '/questionnaire/up') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::up',  '_route' => 'up',);
                }

                // down
                if ($pathinfo === '/questionnaire/down') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::down',  '_route' => 'down',);
                }

                // statistique
                if (0 === strpos($pathinfo, '/questionnaire/statistique') && preg_match('#^/questionnaire/statistique/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'statistique')), array (  '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::statistiqueAction',));
                }

            }

            // doctor_user
            if (0 === strpos($pathinfo, '/user/edit') && preg_match('#^/user/edit/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'doctor_user')), array (  '_controller' => 'AppBundle\\Controller\\Doctor\\UserController::editAction',));
            }

            // doctor_homepage
            if (rtrim($pathinfo, '/') === '') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'doctor_homepage');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\Doctor\\HomeController::indexAction',  '_route' => 'doctor_homepage',);
            }

            // doctor_contact_register
            if ($pathinfo === '/register') {
                return array (  '_controller' => 'AppBundle\\Controller\\Doctor\\RegistrationController::registerAction',  '_route' => 'doctor_contact_register',);
            }

            // doctor_login
            if ($pathinfo === '/login') {
                return array (  '_controller' => 'AppBundle\\Controller\\Doctor\\SecurityController::loginAction',  '_route' => 'doctor_login',);
            }

        }

        if (preg_match('#^predoc\\.localhost$#si', $host, $hostMatches)) {
            // patient_connectpage
            if ($pathinfo === '/connecter') {
                return array (  '_controller' => 'AppBundle\\Controller\\Patient\\HomeController::connectAction',  '_route' => 'patient_connectpage',);
            }

            // aboutpage
            if ($pathinfo === '/about') {
                return array (  '_controller' => 'AppBundle\\Controller\\Patient\\HomeController::aboutAction',  '_route' => 'aboutpage',);
            }

            // contactpage
            if ($pathinfo === '/contact') {
                return array (  '_controller' => 'AppBundle\\Controller\\Patient\\HomeController::contactAction',  '_route' => 'contactpage',);
            }

            if (0 === strpos($pathinfo, '/questionnaire')) {
                // questionnaire
                if (rtrim($pathinfo, '/') === '/questionnaire') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'questionnaire');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Patient\\QuestionnaireController::questionnaireAction',  '_route' => 'questionnaire',);
                }

                // question
                if (0 === strpos($pathinfo, '/questionnaire/question') && preg_match('#^/questionnaire/question/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'question')), array (  '_controller' => 'AppBundle\\Controller\\Patient\\QuestionnaireController::nextQuestionAction',));
                }

            }

            if (0 === strpos($pathinfo, '/recapitulatif')) {
                // recapitulatif
                if (rtrim($pathinfo, '/') === '/recapitulatif') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'recapitulatif');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Patient\\SummaryController::indexAction',  '_route' => 'recapitulatif',);
                }

                // recapitulatif_mail
                if ($pathinfo === '/recapitulatif/mail') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Patient\\SummaryController::mailAction',  '_route' => 'recapitulatif_mail',);
                }

                // recapitulatif_pdf
                if ($pathinfo === '/recapitulatif/pdf') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Patient\\SummaryController::generatePDFAction',  '_route' => 'recapitulatif_pdf',);
                }

                // save_pdf
                if ($pathinfo === '/recapitulatif/save/pdf') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Patient\\SummaryController::savePDFAction',  '_route' => 'save_pdf',);
                }

            }

            // patient_homepage
            if (rtrim($pathinfo, '/') === '') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'patient_homepage');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\Patient\\HomeController::indexAction',  '_route' => 'patient_homepage',);
            }

        }

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // fos_user_security_login
                if ($pathinfo === '/login') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_security_login;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'fos_user_security_login',);
                }
                not_fos_user_security_login:

                // fos_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_security_check;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_route' => 'fos_user_security_check',);
                }
                not_fos_user_security_check:

            }

            // fos_user_security_logout
            if ($pathinfo === '/logout') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_fos_user_security_logout;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_route' => 'fos_user_security_logout',);
            }
            not_fos_user_security_logout:

        }

        if (0 === strpos($pathinfo, '/resetting')) {
            // fos_user_resetting_request
            if ($pathinfo === '/resetting/request') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_request;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_route' => 'fos_user_resetting_request',);
            }
            not_fos_user_resetting_request:

            // fos_user_resetting_send_email
            if ($pathinfo === '/resetting/send-email') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fos_user_resetting_send_email;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
            }
            not_fos_user_resetting_send_email:

            // fos_user_resetting_check_email
            if ($pathinfo === '/resetting/check-email') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_check_email;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
            }
            not_fos_user_resetting_check_email:

            // fos_user_resetting_reset
            if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_fos_user_resetting_reset;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',));
            }
            not_fos_user_resetting_reset:

        }

        // fos_user_change_password
        if ($pathinfo === '/profile/change-password') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_user_change_password;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_route' => 'fos_user_change_password',);
        }
        not_fos_user_change_password:

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
