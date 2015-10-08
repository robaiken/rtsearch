<?php
/**
 * Author: Rob Aiken
 * Datetime: 30/08/15 19:12
 */

namespace app\Helpers;


class Podcast extends PodcastTypes {

    private $name;
    private $number;
    private $releaseDate;
    private $topics;
    private $quests;
    private $transcript;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName( $name )
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     * @return $this
     */
    public function setNumber( $number )
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param mixed $releaseDate
     * @return $this
     */
    public function setReleaseDate( $releaseDate )
    {
        $this->releaseDate = $releaseDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * @param mixed $topics
     * @return $this
     */
    public function setTopics( $topics )
    {
        $this->topics = $topics;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuests()
    {
        return $this->quests;
    }

    /**
     * @param mixed $quests
     * @return $this
     */
    public function setQuests( $quests )
    {
        $this->quests = $quests;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTranscript()
    {
        return $this->transcript;
    }

}