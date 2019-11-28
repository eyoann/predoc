<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * appDevDebugProjectContainerUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = array(
        '_wdt' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:toolbarAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    1 =>     array (      0 => 'text',      1 => '/_wdt',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_home' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:homeAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_search' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:searchAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/search',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_search_bar' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:searchBarAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/search_bar',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_info' => array (  0 =>   array (    0 => 'about',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:infoAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'about',    ),    1 =>     array (      0 => 'text',      1 => '/_profiler/info',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_phpinfo' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/phpinfo',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_search_results' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:searchResultsAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/search/results',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    2 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_open_file' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:openAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/open',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:panelAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    1 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_router' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.router:panelAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/router',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    2 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_exception' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.exception:showAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/exception',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    2 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_exception_css' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.exception:cssAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/exception.css',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    2 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_twig_error_test' => array (  0 =>   array (    0 => 'code',    1 => '_format',  ),  1 =>   array (    '_controller' => 'twig.controller.preview_error:previewErrorPageAction',    '_format' => 'html',  ),  2 =>   array (    'code' => '\\d+',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '.',      2 => '[^/]++',      3 => '_format',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '\\d+',      3 => 'code',    ),    2 =>     array (      0 => 'text',      1 => '/_error',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'affichermsg' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Administrator\\ContactController::AfficherMsgAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/affichermsg/',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-administrator.localhost',    ),  ),  5 =>   array (  ),),
        'adduser' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Administrator\\HomeController::AjouterAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/adduser',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-administrator.localhost',    ),  ),  5 =>   array (  ),),
        'list_questionnaire' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Administrator\\QuestionnaireController::listAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/questionnaire/',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-administrator.localhost',    ),  ),  5 =>   array (  ),),
        'public' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Administrator\\QuestionnaireController::publicAction',  ),  2 =>   array (    'id' => '\\d+',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '\\d+',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/questionnaire/public',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-administrator.localhost',    ),  ),  5 =>   array (  ),),
        'list_user' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Administrator\\UserController::listAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/user/',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-administrator.localhost',    ),  ),  5 =>   array (  ),),
        'edit_user' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Administrator\\UserController::editAction',  ),  2 =>   array (    'id' => '\\d+',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '\\d+',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/user/edit',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-administrator.localhost',    ),  ),  5 =>   array (  ),),
        'add_user' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Administrator\\UserController::ajouterAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/user/add',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-administrator.localhost',    ),  ),  5 =>   array (  ),),
        'admin_homepage' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Administrator\\HomeController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-administrator.localhost',    ),  ),  5 =>   array (  ),),
        'admin_login' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Administrator\\SecurityController::loginAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/login',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-administrator.localhost',    ),  ),  5 =>   array (  ),),
        'help' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Doctor\\HomeController::helpAction',  ),  2 =>   array (    'id' => '\\d+',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '\\d+',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/contact',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-doctor.localhost',    ),  ),  5 =>   array (  ),),
        'doctor_questionnaire' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/questionnaire/',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-doctor.localhost',    ),  ),  5 =>   array (  ),),
        'new_doctor_questionnaire' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::newAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/questionnaire/new',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-doctor.localhost',    ),  ),  5 =>   array (  ),),
        'save_questionnaire' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::saveAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/questionnaire/save-questionnaire',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-doctor.localhost',    ),  ),  5 =>   array (  ),),
        'edit_doctor_questionnaire' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::editAction',  ),  2 =>   array (    'id' => '\\d+',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '\\d+',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/questionnaire/edit',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-doctor.localhost',    ),  ),  5 =>   array (  ),),
        'save_edit_questionnaire' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::saveEditAction',  ),  2 =>   array (    'id' => '\\d+',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '\\d+',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/questionnaire/save-edit',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-doctor.localhost',    ),  ),  5 =>   array (  ),),
        'up' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::up',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/questionnaire/up',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-doctor.localhost',    ),  ),  5 =>   array (  ),),
        'down' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::down',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/questionnaire/down',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-doctor.localhost',    ),  ),  5 =>   array (  ),),
        'statistique' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Doctor\\QuestionnaireController::statistiqueAction',  ),  2 =>   array (    'id' => '\\d+',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '\\d+',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/questionnaire/statistique',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-doctor.localhost',    ),  ),  5 =>   array (  ),),
        'doctor_user' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Doctor\\UserController::editAction',  ),  2 =>   array (    'id' => '\\d+',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '\\d+',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/user/edit',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-doctor.localhost',    ),  ),  5 =>   array (  ),),
        'doctor_homepage' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Doctor\\HomeController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-doctor.localhost',    ),  ),  5 =>   array (  ),),
        'doctor_contact_register' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Doctor\\RegistrationController::registerAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/register',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-doctor.localhost',    ),  ),  5 =>   array (  ),),
        'doctor_login' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Doctor\\SecurityController::loginAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/login',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc-doctor.localhost',    ),  ),  5 =>   array (  ),),
        'patient_connectpage' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Patient\\HomeController::connectAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/connecter',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc.localhost',    ),  ),  5 =>   array (  ),),
        'aboutpage' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Patient\\HomeController::aboutAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/about',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc.localhost',    ),  ),  5 =>   array (  ),),
        'contactpage' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Patient\\HomeController::contactAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/contact',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc.localhost',    ),  ),  5 =>   array (  ),),
        'questionnaire' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Patient\\QuestionnaireController::questionnaireAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/questionnaire/',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc.localhost',    ),  ),  5 =>   array (  ),),
        'question' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Patient\\QuestionnaireController::nextQuestionAction',  ),  2 =>   array (    'id' => '\\d+',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '\\d+',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/questionnaire/question',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc.localhost',    ),  ),  5 =>   array (  ),),
        'recapitulatif' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Patient\\SummaryController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/recapitulatif/',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc.localhost',    ),  ),  5 =>   array (  ),),
        'recapitulatif_mail' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Patient\\SummaryController::mailAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/recapitulatif/mail',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc.localhost',    ),  ),  5 =>   array (  ),),
        'recapitulatif_pdf' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Patient\\SummaryController::generatePDFAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/recapitulatif/pdf',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc.localhost',    ),  ),  5 =>   array (  ),),
        'save_pdf' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Patient\\SummaryController::savePDFAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/recapitulatif/save/pdf',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc.localhost',    ),  ),  5 =>   array (  ),),
        'patient_homepage' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'AppBundle\\Controller\\Patient\\HomeController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => 'predoc.localhost',    ),  ),  5 =>   array (  ),),
        'fos_user_security_login' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/login',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'fos_user_security_check' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/login_check',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'fos_user_security_logout' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/logout',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'fos_user_resetting_request' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/resetting/request',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'fos_user_resetting_send_email' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/resetting/send-email',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'fos_user_resetting_check_email' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/resetting/check-email',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'fos_user_resetting_reset' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    1 =>     array (      0 => 'text',      1 => '/resetting/reset',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'fos_user_change_password' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/profile/change-password',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
    );
        }
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}