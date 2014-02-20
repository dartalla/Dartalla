<?php

namespace Avr\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="location")
 */
class Location {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="location_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $locationId;
    
    /**
     * @ORM\Column(name="location_country_code", type="string")
     */
    protected $locationCountryCode;
    
    /**
     * @ORM\Column(name="location_postal_code", type="string")
     */
    protected $locationPostalCode;
    
    /**
     * @ORM\Column(name="location_place_name", type="string")
     */
    protected $locationPlaceName;
    
    /**
     * @ORM\Column(name="location_admin_name1", type="string")
     */
    protected $locationAdminName1;
    
    /**
     * @ORM\Column(name="location_admin_code1", type="string")
     */
    protected $locationAdminCode1;
    
    /**
     * @ORM\Column(name="location_admin_name2", type="string")
     */
    protected $locationAdminName2;
    
    /**
     * @ORM\Column(name="location_admin_code2", type="string")
     */
    protected $locationAdminCode2;
    
    /**
     * @ORM\Column(name="location_admin_name3", type="string")
     */
    protected $locationAdminName3;
    
    /**
     * @ORM\Column(name="location_admin_code3", type="string")
     */
    protected $locationAdminCode3;
    
    /**
     * @ORM\Column(name="location_latitude", type="string")
     */
    protected $locationLatitude;
    
    /**
     * @ORM\Column(name="location_longitude", type="string")
     */
    protected $locationLongitude;
    
    /**
     * @ORM\Column(name="location_accuracy", type="string")
     */
    protected $locationAccuracy;
    
    public function getLocationId() {
        return $this->locationId;
    }

    public function setLocationId($locationId) {
        $this->locationId = $locationId;
    }

    public function getLocationCountryCode() {
        return $this->locationCountryCode;
    }

    public function setLocationCountryCode($locationCountryCode) {
        $this->locationCountryCode = $locationCountryCode;
    }

    public function getLocationPostalCode() {
        return $this->locationPostalCode;
    }

    public function setLocationPostalCode($locationPostalCode) {
        $this->locationPostalCode = $locationPostalCode;
    }

    public function getLocationPlaceName() {
        return $this->locationPlaceName;
    }

    public function setLocationPlaceName($locationPlaceName) {
        $this->locationPlaceName = $locationPlaceName;
    }

    public function getLocationAdminName1() {
        return $this->locationAdminName1;
    }

    public function setLocationAdminName1($locationAdminName1) {
        $this->locationAdminName1 = $locationAdminName1;
    }

    public function getLocationAdminCode1() {
        return $this->locationAdminCode1;
    }

    public function setLocationAdminCode1($locationAdminCode1) {
        $this->locationAdminCode1 = $locationAdminCode1;
    }

    public function getLocationAdminName2() {
        return $this->locationAdminName2;
    }

    public function setLocationAdminName2($locationAdminName2) {
        $this->locationAdminName2 = $locationAdminName2;
    }

    public function getLocationAdminCode2() {
        return $this->locationAdminCode2;
    }

    public function setLocationAdminCode2($locationAdminCode2) {
        $this->locationAdminCode2 = $locationAdminCode2;
    }

    public function getLocationAdminName3() {
        return $this->locationAdminName3;
    }

    public function setLocationAdminName3($locationAdminName3) {
        $this->locationAdminName3 = $locationAdminName3;
    }

    public function getLocationAdminCode3() {
        return $this->locationAdminCode3;
    }

    public function setLocationAdminCode3($locationAdminCode3) {
        $this->locationAdminCode3 = $locationAdminCode3;
    }

    public function getLocationLatitude() {
        return $this->locationLatitude;
    }

    public function setLocationLatitude($locationLatitude) {
        $this->locationLatitude = (double) $locationLatitude;
    }

    public function getLocationLongitude() {
        return $this->locationLongitude;
    }

    public function setLocationLongitude($locationLongitude) {
        $this->locationLongitude = (double) $locationLongitude;
    }

    public function getLocationAccuracy() {
        return $this->locationAccuracy;
    }

    public function setLocationAccuracy($locationAccuracy) {
        $this->locationAccuracy = (double) $locationAccuracy;
    }
}
