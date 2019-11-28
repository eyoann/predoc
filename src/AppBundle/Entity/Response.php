<?php

namespace AppBundle\Entity;

/**
 * Response
 */
class Response
{
    private $id;
    private $text;
    private $image;
    private $nextQuestion;
    private $previousQuestion;
    private $participations;

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
     * @return Response
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
     * Set image
     *
     * @param string $image
     *
     * @return Response
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set nextQuestion
     *
     * @param \AppBundle\Entity\Question $nextQuestion
     *
     * @return Response
     */
    public function setNextQuestion(\AppBundle\Entity\Question $nextQuestion = null)
    {
        $this->nextQuestion = $nextQuestion;

        return $this;
    }

    /**
     * Get nextQuestion
     *
     * @return \AppBundle\Entity\Question
     */
    public function getNextQuestion()
    {
        return $this->nextQuestion;
    }

    /**
     * Set previousQuestion
     *
     * @param \AppBundle\Entity\Question $previousQuestion
     *
     * @return Response
     */
    public function setPreviousQuestion(\AppBundle\Entity\Question $previousQuestion = null)
    {
        $this->previousQuestion = $previousQuestion;

        return $this;
    }

    /**
     * Get previousQuestion
     *
     * @return \AppBundle\Entity\Question
     */
    public function getPreviousQuestion()
    {
        return $this->previousQuestion;
    }

    /**
     * Add participation
     *
     * @param \AppBundle\Entity\Participation $participation
     *
     * @return Response
     */
    public function addParticipation(\AppBundle\Entity\Participation $participation)
    {
        $this->participations[] = $participation;

        return $this;
    }

    /**
     * Remove participation
     *
     * @param \AppBundle\Entity\Participation $participation
     */
    public function removeParticipation(\AppBundle\Entity\Participation $participation)
    {
        $this->participations->removeElement($participation);
    }

    /**
     * Get participations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipations()
    {
        return $this->participations;
    }
}
