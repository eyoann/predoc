<?php

namespace AppBundle\Entity;

/**
 * Question
 */
class Question
{
    private $id;
    private $text;
    private $questionRoot;
    private $keywords;
    private $questionnaire;
    private $responses;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->keywords = new \Doctrine\Common\Collections\ArrayCollection();
        $this->responses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Question
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set questionnaire
     *
     * @param \AppBundle\Entity\questionnaire $questionnaire
     *
     * @return Question
     */
    public function setQuestionnaire(\AppBundle\Entity\questionnaire $questionnaire = null)
    {
        $this->questionnaire = $questionnaire;

        return $this;
    }

    /**
     * Get questionnaire
     *
     * @return \AppBundle\Entity\questionnaire
     */
    public function getQuestionnaire()
    {
        return $this->questionnaire;
    }

    /**
     * Set questionRoot
     *
     * @param \AppBundle\Entity\Question $questionRoot
     *
     * @return Question
     */
    public function setQuestionRoot(\AppBundle\Entity\Question $questionRoot = null)
    {
        $this->questionRoot = $questionRoot;

        return $this;
    }

    /**
     * Get questionRoot
     *
     * @return \AppBundle\Entity\Question
     */
    public function getQuestionRoot()
    {
        return $this->questionRoot;
    }

    /**
     * Add keyword
     *
     * @param \AppBundle\Entity\Keyword $keyword
     *
     * @return Question
     */
    public function addKeyword(\AppBundle\Entity\Keyword $keyword)
    {
        $this->keywords[] = $keyword;

        return $this;
    }

    /**
     * Remove keyword
     *
     * @param \AppBundle\Entity\Keyword $keyword
     */
    public function removeKeyword(\AppBundle\Entity\Keyword $keyword)
    {
        $this->keywords->removeElement($keyword);
    }

    /**
     * Get keywords
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Add response
     *
     * @param \AppBundle\Entity\Response $response
     *
     * @return Question
     */
    public function addResponse(\AppBundle\Entity\Response $response)
    {
        $this->responses[] = $response;

        return $this;
    }

    /**
     * Remove response
     *
     * @param \AppBundle\Entity\Response $response
     */
    public function removeResponse(\AppBundle\Entity\Response $response)
    {
        $this->responses->removeElement($response);
    }

    /**
     * Get responses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResponses()
    {
        return $this->responses;
    }
}
