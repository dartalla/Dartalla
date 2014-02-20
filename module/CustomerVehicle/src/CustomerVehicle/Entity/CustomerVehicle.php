<?php

namespace CustomerVehicle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer_vehicle")
 */
class CustomerVehicle {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="customer_vehicle_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $customerVehicleId;

    /**
     * @ORM\Column(name="customer_vehicle_year", type="string")
     * @var string
     */
    protected $customerVehicleYear;

    /**
     * @ORM\Column(name="customer_vehicle_year_model", type="string")
     * @var string
     */
    protected $customerVehicleYearModel;

    /**
     * @ORM\Column(name="customer_vehicle_plate", type="string")
     * @var string
     */
    protected $customerVehiclePlate;

    /**
     * @ORM\Column(name="customer_vehicle_color", type="string")
     * @var string
     */
    protected $customerVehicleColor;

    /**
     * @ORM\Column(name="customer_vehicle_value", type="decimal", precision=2)
     */
    protected $customerVehicleValue;
    
    /**
     * @ORM\OneToOne(targetEntity="Customer\Entity\Customer", cascade="persist")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="customer_id")
     */
    protected $customerId;
    
    /**
     * @ORM\OneToOne(targetEntity="Vehicle\Entity\VehicleBrand", cascade="persist")
     * @ORM\JoinColumn(name="vehicle_brand_id", referencedColumnName="vehicle_brand_id")
     */
    protected $vehicleBrandId;
    
    /**
     * @ORM\OneToOne(targetEntity="Vehicle\Entity\VehicleType", cascade="persist")
     * @ORM\JoinColumn(name="vehicle_type_id", referencedColumnName="vehicle_type_id")
     */
    protected $vehicleTypeId;
    
    /**
     * @ORM\OneToOne(targetEntity="Vehicle\Entity\VehicleModel", cascade="persist")
     * @ORM\JoinColumn(name="vehicle_model_id", referencedColumnName="vehicle_model_id")
     */
    protected $vehicleModelId;
    
    /**
     * @ORM\OneToOne(targetEntity="Vehicle\Entity\VehicleVersion", cascade="persist")
     * @ORM\JoinColumn(name="vehicle_version_id", referencedColumnName="vehicle_version_id")
     */
    protected $vehicleVersionId;
    
    
    public function __construct() {
        $this->customerVehicleValue      = 0.00;
    }
    
    public function getCustomerVehicleId() {
        return $this->customerVehicleId;
    }

    public function setCustomerVehicleId($customerVehicleId) {
        $this->customerVehicleId = $customerVehicleId;
        return $this;
    }

    public function getCustomerVehicleName() {
        return $this->customerVehicleName;
    }

    public function setCustomerVehicleName($customerVehicleName) {
        $this->customerVehicleName = $customerVehicleName;
        return $this;
    }

    public function getCustomerVehicleValue() {
        return $this->customerVehicleValue;
    }

    public function setCustomerVehicleValue($customerVehicleValue) {
        $this->customerVehicleValue = $customerVehicleValue;
        return $this;
    }
    
    public function getCustomerId() {
        return $this->customerId;
    }

    public function setCustomerId($customerId) {
        $this->customerId = $customerId;
        return $this;
    }
    
    public function getCustomerVehicleYear() {
        return $this->customerVehicleYear;
    }

    public function setCustomerVehicleYear($customerVehicleYear) {
        $this->customerVehicleYear = $customerVehicleYear;
        return $this;
    }

    public function getCustomerVehicleYearModel() {
        return $this->customerVehicleYearModel;
    }

    public function setCustomerVehicleYearModel($customerVehicleYearModel) {
        $this->customerVehicleYearModel = $customerVehicleYearModel;
        return $this;
    }

    public function getCustomerVehiclePlate() {
        return $this->customerVehiclePlate;
    }

    public function setCustomerVehiclePlate($customerVehiclePlate) {
        $this->customerVehiclePlate = $customerVehiclePlate;
        return $this;
    }

    public function getCustomerVehicleColor() {
        return $this->customerVehicleColor;
    }

    public function setCustomerVehicleColor($customerVehicleColor) {
        $this->customerVehicleColor = $customerVehicleColor;
        return $this;
    }

    public function getVehicleBrandId() {
        return $this->vehicleBrandId;
    }

    public function setVehicleBrandId($vehicleBrandId) {
        $this->vehicleBrandId = $vehicleBrandId;
        return $this;
    }

    public function getVehicleTypeId() {
        return $this->vehicleTypeId;
    }

    public function setVehicleTypeId($vehicleTypeId) {
        $this->vehicleTypeId = $vehicleTypeId;
        return $this;
    }

    public function getVehicleModelId() {
        return $this->vehicleModelId;
    }

    public function setVehicleModelId($vehicleModelId) {
        $this->vehicleModelId = $vehicleModelId;
        return $this;
    }

    public function getVehicleVersionId() {
        return $this->vehicleVersionId;
    }

    public function setVehicleVersionId($vehicleVersionId) {
        $this->vehicleVersionId = $vehicleVersionId;
        return $this;
    }
}
