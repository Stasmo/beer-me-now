<?php

namespace Stasmo\Example\SampleApiBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Bar
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $name;

    /**
     * @MongoDB\Float
     */
    protected $latitude;

    /**
     * @MongoDB\Float
     */
    protected $longtitude;

    /**
     * @MongoDB\int
     */
    protected $price;

    /**
     * @MongoDB\int
     */
    protected $sketchiness;

    /**
     * @MongoDB\String
     */
    protected $cover;

    /**
     * @MongoDB\String
     */
    protected $hours;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return self
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * Get latitude
     *
     * @return float $latitude
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longtitude
     *
     * @param float $longtitude
     * @return self
     */
    public function setLongtitude($longtitude)
    {
        $this->longtitude = $longtitude;
        return $this;
    }

    /**
     * Get longtitude
     *
     * @return float $longtitude
     */
    public function getLongtitude()
    {
        return $this->longtitude;
    }

    /**
     * Set price
     *
     * @param int $price
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @return int $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set sketchiness
     *
     * @param int $sketchiness
     * @return self
     */
    public function setSketchiness($sketchiness)
    {
        $this->sketchiness = $sketchiness;
        return $this;
    }

    /**
     * Get sketchiness
     *
     * @return int $sketchiness
     */
    public function getSketchiness()
    {
        return $this->sketchiness;
    }

    /**
     * Set cover
     *
     * @param string $cover
     * @return self
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * Get cover
     *
     * @return string $cover
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set hours
     *
     * @param string $hours
     * @return self
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
        return $this;
    }

    /**
     * Get hours
     *
     * @return string $hours
     */
    public function getHours()
    {
        return $this->hours;
    }
}
