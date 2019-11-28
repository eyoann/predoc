<?php

namespace AppBundle\Controller\Doctor;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use AppBundle\Entity\Question;
use AppBundle\Entity\Response;
use AppBundle\Entity\Questionnaire;

use Symfony\Component\HttpFoundation\Response as Reponse;

/**
 * @Route("/questionnaire")
 * @Security("has_role('ROLE_DOCTOR')")
 */
class QuestionnaireController extends Controller
{
	/**
     * @Route("/", name="doctor_questionnaire")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->get('repository.questionnaire');

    	$questionnaires = $this->getUser()->getContact()->getQuestionnaires();

        $childrens = array();

        foreach ($questionnaires as $questionnaire) {
            $id = $repository->findByParent($questionnaire->getId());
            if ($id) {
                $childrens [$questionnaire->getId()] = $id;
            }
        }

        foreach ($questionnaires as $key => $questionnaire) {
            if ($questionnaire->getParent()) {
                unset($questionnaires[$key]);
            }
        }

        return $this->render('doctor/questionnaire/index.html.twig', [ 'questionnaires' => $questionnaires, 'childrens' => $childrens]);
    }

	/**
     * @Route("/new", name="new_doctor_questionnaire")
     */
    public function newAction(Request $request)
    {
        return $this->render('doctor/questionnaire/questionnaire.html.twig');
    }

    /**
     * @Route("/save-questionnaire", name="save_questionnaire")
     */
    public function saveAction(Request $request)
    {
    	//POST
    	$questionnaireTitle = $request->request->get('questionnaire');
    	$questions = $request->request->get('question');
    	$responses = $request->request->get('response');

    	//MANAGERS

    	$emQuestion = $this->get('manager.question');
    	$emResponse = $this->get('manager.response');
    	$emQuestionnaire = $this->get('manager.questionnaire');
    	$emContact = $this->get('manager.contact');

        $repository = $this->get('repository.questionnaire');

    	$contact = $this->getUser()->getContact();
        $parent = null;
    	$questionnaire = new Questionnaire();
    	$questionnaire->addContact($contact);
    	$questionnaire->setHidden(false);
    	$questionnaire->setPublic(false);
        if ($request->request->get('save')) {
            $parent = $repository->find($request->request->get('save'));
            $questionnaire->setParent($parent);
            $questionnaire->setLvl(1);
        } else {
            $questionnaire->setLvl(0);
        }
    	$questionnaire->setTitle($questionnaireTitle);
        $questionnaire->setCreated(new \DateTime());
        $questionnaire->setUpdated(new \DateTime());
    	$i = 0;
    	$responsesPrec = array();
    	foreach ($questions as $questionTitle) {
    		$question = new Question();
    		$question->setText($questionTitle);
    		$question->setQuestionnaire($questionnaire);
    		if ($responsesPrec) {
    			foreach ($responsesPrec as $response) {
    				$response->setNextQuestion($question);
    				$emResponse->persist($response);
    			}
    			$responsesPrec = array();
    		} else {
                $questionnaire->setQuestion($question);

                if ($parent) {
                    foreach ($parent->getLastResponses() as $response) {
                        $response->setNextQuestion($question);
                        $emResponse->persist($response);
                    }
                }
    		}
    		foreach ($responses[$i] as $responseTitle) {
    			$response = new Response();
    			$response->setPreviousQuestion($question);
    			$response->setText($responseTitle);
    			$response->setImage('');
    			$responsesPrec [] = $response;
    		}
    		$i++;
    		$emQuestion->persist($question);
    	}

    	foreach ($responsesPrec as $response) {
    		$emResponse->persist($response);
    	}
    	$emQuestionnaire->persist($questionnaire);
    	$contact->addQuestionnaire($questionnaire);
    	$emContact->persist($contact);

    	//FLUSH
    	$emQuestionnaire->flush();
    	$emQuestion->flush();
    	$emResponse->flush();
    	$emContact->flush();

        if($parent) {
            return $this->redirectToRoute('edit_doctor_questionnaire', ['id' => $parent->getId()]);
        }

        if($request->request->get('add')) {
            return $this->render('doctor/questionnaire/questionnaire.html.twig', ['questionnaire' => $questionnaire]);
        } else {
            return $this->render('doctor/index.html.twig');
        }
    }

    /**
     * @Route("/edit/{id}", name="edit_doctor_questionnaire", requirements={"id": "\d+"})
     */
    public function editAction(Request $request, Questionnaire $questionnaire = null)
    {
    	if ($questionnaire) {
	    	$question = $questionnaire->getQuestion();

	    	$responses = array();
	    	$questions = array();

	    	while($question) {
	    		$questions [] = $question;
	    		$responses [] = $question->getResponses();
	    		$question = $question->getResponses()[0]->getNextQuestion();
	    	}

            $repository = $this->get('repository.questionnaire');

            $questionnaires = $repository->findByParent($questionnaire);

	        return $this->render('doctor/questionnaire/edit.html.twig', ['questionnaire' => $questionnaire, "responses" => $responses, "questions" => $questions, 'questionnaires' => $questionnaires]);
       } else {
       		return $this->render('doctor/questionnaire/edit.html.twig');
       }
    }

    /**
     * @Route("/save-edit/{id}", name="save_edit_questionnaire", requirements={"id": "\d+"})
     */
    public function saveEditAction(Request $request, Questionnaire $questionnaire)
    {
    	$emQuestionnaire = $this->get('manager.questionnaire');
    	$emQuestion = $this->get('manager.question');
    	$emResponse = $this->get('manager.response');

    	$questions = $request->request->get('question');
    	$responses = $request->request->get('response');
    	$questionnaireTitle = $request->request->get('questionnaire');

    	$questionnaire->setTitle($questionnaireTitle);
        $questionnaire->setUpdated(new \DateTime());
    	$emQuestionnaire->persist($questionnaire);
    	$question = $questionnaire->getQuestion();
    	$i = 0;
    	$j = 0;

        $parent = $questionnaire->getParent();

        if (!$parent) {
        	while ($question) {
        		$question->setText($questions[$i]);
        		foreach ($question->getResponses() as $response) {
        			$response->setText($responses[$i][$j]);
        			$emResponse->persist($response);
        			$j++;
        		}
        		$responsesPrec = $question->getResponses();
        		if (count($question->getResponses()) != count($responses[$i])) {
        			dump($question);
        			for ($g=$j; $g<count($responses[$i]) ; $g++) {
        				$response = new Response();
        				$response->setPreviousQuestion($question);
        				$response->setText($responses[$i][$g]);
        				$response->setImage('');
        				$responsesPrec [] = $response;
        				$emResponse->persist($response);
        			}
        		}
        		$j = 0;
        		$emQuestion->persist($question);
        		$question = $question->getResponses()[0]->getNextQuestion();
        		$i++;
        	}

        	if (count($questions) != $i) {
        		for ($g=$i; $g<count($questions) ; $g++) {
        			$question = new Question();
        			$question->setText($questions[$g]);
        			$question->setQuestionnaire($questionnaire);
        			if ($responsesPrec) {
        				foreach ($responsesPrec as $response) {
        					$response->setNextQuestion($question);
        					$emResponse->persist($response);
        				}
        				$responsesPrec = array();
        			}
    	    		foreach ($responses[$g] as $responseTitle) {
    	    			$response = new Response();
    	    			$response->setPreviousQuestion($question);
    	    			$response->setText($responseTitle);
    	    			$response->setImage('');
    	    			$responsesPrec [] = $response;
    	    		}
    	    		$emQuestion->persist($question);
        		}
        		foreach ($responsesPrec as $response) {
        			$emResponse->persist($response);
        		}
        	}
        } else {
            while ($question && $question->getQuestionnaire() == $questionnaire) {
                dump($question);
                $question->setText($questions[$i]);
                foreach ($question->getResponses() as $response) {
                    $response->setText($responses[$i][$j]);
                    $emResponse->persist($response);
                    $j++;
                }
                $responsesPrec = $question->getResponses();
                if (count($question->getResponses()) != count($responses[$i])) {
                    dump($question);
                    for ($g=$j; $g<count($responses[$i]) ; $g++) {
                        $response = new Response();
                        $response->setPreviousQuestion($question);
                        $response->setText($responses[$i][$g]);
                        $response->setImage('');
                        $responsesPrec [] = $response;
                        $emResponse->persist($response);
                    }
                }
                $j = 0;
                $emQuestion->persist($question);
                $question = $question->getResponses()[0]->getNextQuestion();
                $i++;
            }
            $nextQuestion = $question;
            if (count($questions) != $i) {
                for ($g=$i; $g<count($questions) ; $g++) {
                    $question = new Question();
                    $question->setText($questions[$g]);
                    $question->setQuestionnaire($questionnaire);
                    if ($responsesPrec) {
                        foreach ($responsesPrec as $response) {
                            $response->setNextQuestion($question);
                            $emResponse->persist($response);
                        }
                        $responsesPrec = array();
                    }
                    foreach ($responses[$g] as $responseTitle) {
                        $response = new Response();
                        $response->setPreviousQuestion($question);
                        $response->setText($responseTitle);
                        $response->setImage('');
                        $responsesPrec [] = $response;
                    }
                    $emQuestion->persist($question);
                }
                foreach ($responsesPrec as $response) {
                    $response->setNextQuestion($nextQuestion);
                    $emResponse->persist($response);
                }
            }
        }

		$emQuestion->flush();
		$emResponse->flush();
		$emQuestionnaire->flush();

        if($request->request->get('add')) {
            return $this->render('doctor/questionnaire/questionnaire.html.twig', ['questionnaire' => $questionnaire]);
        } else {
            return $this->render('doctor/index.html.twig');
        }
    }

    /**
     * @Route("/up", name="up")
     */
    public function up(Request $request) {
        $emQuestionnaire = $this->get('manager.questionnaire');
        $emQuestion = $this->get('manager.question');
        $emResponse = $this->get('manager.response');

        $question = $request->request->get('question');
        $prevQuestion = $request->request->get('prevQuestion');
        $prev2Question = $request->request->get('prev2Question');

        $repositoryQuestionnaire = $this->get('repository.questionnaire');
        $repositoryQuestion = $this->get('repository.question');

        if($question == $prev2Question) {
            if($question == $prevQuestion) {
                return new Reponse($request);
            } else {

                $question = $repositoryQuestion->find($question);
                $questionnaire = $question->getQuestionnaire();
                $prevQuestion = $repositoryQuestion->find($prevQuestion);
                $questionnaire = $question->getQuestionnaire();
                $prevQuestionnaire = $prevQuestion->getQuestionnaire();
                if ($questionnaire != $prevQuestionnaire) {
                    $prevQuestionnaire->setQuestion($question);
                    $questionnaire->setQuestion($prevQuestion);
                    $emQuestionnaire->persist($prevQuestionnaire);
                    $emQuestionnaire->persist($questionnaire);
                } else {
                    $parent = $questionnaire->getParent();
                    if($parent) {
                        $prev2Question = null;
                        $nextQuestionParent = $parent->getQuestion();
                        while($prevQuestion != $nextQuestionParent) {
                           $prev2Question = $nextQuestionParent;
                           $nextQuestionParent = $nextQuestionParent->getResponses()[0]->getNextQuestion();
                        }
                        foreach ($prev2Question->getResponses() as $response) {
                            $response->setNextQuestion($question);
                            $emResponse->persist($response);
                        }
                    }
                    $questionnaire->setQuestion($question);
                    $emQuestionnaire->persist($questionnaire);
                }



                $nextQuestion = $question->getResponses()[0]->getNextQuestion();

                foreach ($question->getResponses() as $response) {
                    $response->setNextQuestion($prevQuestion);
                    $emResponse->persist($response);
                }
                foreach ($prevQuestion->getResponses() as $response) {
                    $response->setNextQuestion($nextQuestion);
                    $emResponse->persist($response);
                }
            }
        } else {
            $question = $repositoryQuestion->find($question);
            $prevQuestion = $repositoryQuestion->find($prevQuestion);
            $prev2Question = $repositoryQuestion->find($prev2Question);
            $nextQuestion = $question->getResponses()[0]->getNextQuestion();
            $questionnaire = $question->getQuestionnaire();
            $prevQuestionnaire = $prevQuestion->getQuestionnaire();

            if ($questionnaire != $prevQuestionnaire) {
                if (!$prevQuestionnaire->getParent()) {
                    $questionnaire->setQuestion($prevQuestion);
                    $emQuestionnaire->persist($questionnaire);
                }
                $prevQuestion->setQuestionnaire($questionnaire);
                $question->setQuestionnaire($prevQuestionnaire);
                $emQuestion->persist($prevQuestion);
                $emQuestion->persist($question);
                $emQuestion->flush();
            } else {
                if ($prevQuestionnaire->getParent() && $prevQuestionnaire->getQuestion() == $prevQuestion) {
                    $questionnaire->setQuestion($question);
                    $emQuestionnaire->persist($questionnaire);
                }
            }

            foreach ($prev2Question->getResponses() as $response) {
                $response->setNextQuestion($question);
                $emResponse->persist($response);
            }
            foreach ($question->getResponses() as $response) {
                $response->setNextQuestion($prevQuestion);
                $emResponse->persist($response);
            }
            foreach ($prevQuestion->getResponses() as $response) {
                $response->setNextQuestion($nextQuestion);
                $emResponse->persist($response);
            }
        }
        $emResponse->flush();
        $emQuestionnaire->flush();
        return new Reponse();
    }

    /**
     * @Route("/down", name="down")
     */
    public function down(Request $request) {
        $emQuestionnaire = $this->get('manager.questionnaire');
        $emResponse = $this->get('manager.response');

        $question = $request->request->get('question');
        $prevQuestion = $request->request->get('prevQuestion');

        $repositoryQuestionnaire = $this->get('repository.questionnaire');
        $repositoryQuestion = $this->get('repository.question');

        if($question == $prevQuestion) {

                $question = $repositoryQuestion->find($question);
                $questionnaire = $question->getQuestionnaire();

                $nextQuestion = $question->getResponses()[0]->getNextQuestion();
                $questionnaire->setQuestion($nextQuestion);
                $emQuestionnaire->persist($questionnaire);
                $next2Question = $nextQuestion->getResponses()[0]->getNextQuestion();

                foreach ($question->getResponses() as $response) {
                    $response->setNextQuestion($next2Question);
                    $emResponse->persist($response);
                }
                foreach ($nextQuestion->getResponses() as $response) {
                    $response->setNextQuestion($question);
                    $emResponse->persist($response);
                }
        } else {

            $question = $repositoryQuestion->find($question);
            if ($question->getResponses()[0]->getNextQuestion()) {

                $prevQuestion = $repositoryQuestion->find($prevQuestion);
                $nextQuestion = $question->getResponses()[0]->getNextQuestion();
                $next2Question = $nextQuestion->getResponses()[0]->getNextQuestion();

                $questionnaire = $question->getQuestionnaire();
                $nextQuestionnaire = $nextQuestion->getQuestionnaire();

                if ($questionnaire->getQuestion() == $question) {
                    $questionnaire->setQuestion($nextQuestion);
                    $emQuestionnaire->persist($questionnaire);
                }
                $nextQuestion->setQuestionnaire($questionnaire);

                if ($nextQuestionnaire->getQuestion() == $nextQuestion) {
                    $nextQuestionnaire->setQuestion($question);
                    $emQuestionnaire->persist($nextQuestionnaire);
                }
                $question->setQuestionnaire($nextQuestionnaire);


                foreach ($prevQuestion->getResponses() as $response) {
                    $response->setNextQuestion($nextQuestion);
                    $emResponse->persist($response);
                }
                foreach ($nextQuestion->getResponses() as $response) {
                    $response->setNextQuestion($question);
                    $emResponse->persist($response);
                }
                foreach ($question->getResponses() as $response) {
                    $response->setNextQuestion($next2Question);
                    $emResponse->persist($response);
                }
            }
        }
        $emResponse->flush();
        $emQuestionnaire->flush();
        return new Reponse();
    }

    /**
     * @Route("/statistique/{id}", name="statistique", requirements={"id": "\d+"})
     */
    public function statistiqueAction(Request $request, Questionnaire $questionnaire)
    {
        $questions = array();

        $question = $questionnaire->getQuestion();

        while ($question) {
            $questions [] = $question;
            $question = $question->getResponses()[0]->getNextQuestion();
        }

        return $this->render("doctor/statistique.html.twig", array('questionnaire' => $questionnaire, 'questions' => $questions));
    }
}


