<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Bank\Entity\Bank;
use Avr\Entity\Location;
use Doctrine\ORM\EntityManager;

class IndexController extends AbstractActionController {

    protected $entityManager;

    public function indexAction() {
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute('zfcuser/login');
        }
    }

    public function loadbanksAction() {
        $output = null;
        if ($this->getRequest()->isPost()) {
            $em = $this->getEntityManager();
            $post = $this->getRequest()->getPost();
            $text = $post->text;
            $csv_lines = str_getcsv($text, "\n");
            foreach ($csv_lines as $line) {
                $csv_array[] = explode(';', $line, 3);
            }
            foreach ($csv_array as $value) {
                $bank = new Bank();
                $bank->setBankCode((strlen($value[0]) < 3) ? str_pad($value[0], 3, '0', STR_PAD_LEFT) : $value[0]);
                $bank->setBankName($value[1]);
                $bank->setBankWebsite($value[2]);
                $em->persist($bank);
                $em->flush();
                $output .= "O banco '" . $bank->getBankName() . "' foi inserido com sucesso!<br>";
            }
        }

        return array(
            'output' => $output,
        );
    }

    public function loadlocationsAction() {
        $output = null;
        if ($this->getRequest()->isPost()) {
            $em = $this->getEntityManager();
            $post = $this->getRequest()->getPost();
            $text = $post->text;
            $lines = str_getcsv($text, "\n");
            foreach ($lines as $line) {
                $array[] = explode(';', $line);
            }
            foreach ($array as $value) {
                $location = new Location();
                $location->setLocationCountryCode($value[0]);
                $location->setLocationPostalCode(str_replace('-', '', $value[1]));
                $location->setLocationPlaceName($value[2]);
                $location->setLocationAdminName1($value[3]);
                $location->setLocationAdminCode1($value[4]);
                $location->setLocationAdminName2($value[5]);
                $location->setLocationAdminCode2($value[6]);
                $location->setLocationAdminName3($value[7]);
                $location->setLocationAdminCode3($value[8]);
                $location->setLocationLatitude($value[9]);
                $location->setLocationLongitude($value[10]);
                $location->setLocationAccuracy($value[11]);
                $em->persist($location);
                $em->flush();
                $output .= "A localidade '" . $location->getLocationPlaceName() . "' foi inserida com sucesso!<br>";
            }
        }

        return array(
            'output' => $output,
        );
    }

    public function migratepersonsAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT 
                p.*,
                lp.legal_person_id, lp.legal_person_cnpj, lp.legal_person_state_subscription, lp.legal_person_site, lp.legal_person_representative_name, lp.legal_person_representative_phone, lp.legal_person_representative_rg,
                ip.individual_person_id, ip.individual_person_cpf, ip.individual_person_rg, ip.individual_person_rg_expedition_date, ip.individual_person_rg_expeditor_organ, ip.individual_person_rg_uf, ip.individual_person_day, ip.individual_person_month, ip.individual_person_year, ip.individual_person_gender, ip.individual_person_father, ip.individual_person_mother, ip.individual_person_birth_place, ip.individual_person_birth_uf, ip.individual_person_nationality, ip.individual_person_status,
                ct.country_name, ct.country_iso_code,
                UPPER(s.state_name) AS state_name, s.state_symbol,
                UPPER(c.city_name) AS city_name
            FROM persons p
            LEFT JOIN legals_persons lp ON lp.person_id = p.person_id
            LEFT JOIN individuals_persons ip ON ip.person_id = p.person_id
            LEFT JOIN countries ct ON ct.country_id = p.country_id
            LEFT JOIN states s ON s.state_id = p.state_id
            LEFT JOIN cities c ON c.city_id = p.city_id
        ');
        $result = $query->fetchAll();
        foreach ($result as $line) {

            $legal = new \Person\Entity\Legal();
            $legal->setLegalId($line['legal_person_id']);
            $legal->setLegalCnpj($line['legal_person_cnpj']);
            $legal->setLegalSubscription($line['legal_person_state_subscription']);
            $legal->setLegalRepresentativeName($line['legal_person_representative_name']);
            $legal->setLegalRepresentativePhone($line['legal_person_representative_phone']);
            $legal->setLegalRepresentativeRg($line['legal_person_representative_rg']);

            $individual = new \Person\Entity\Individual();
            $individual->setIndividualId($line['individual_person_id']);
            $individual->setIndividualCpf($line['individual_person_cpf']);
            $individual->setIndividualRg($line['individual_person_rg']);
            $date = new \DateTime($line['individual_person_rg_expedition_date']);
            $individual->setIndividualRgDate($date);
            $individual->setIndividualRgOrgan($line['individual_person_rg_expeditor_organ']);
            $individual->setIndividualRgUf($line['individual_person_rg_uf']);
            $individual->setIndividualBirthDay((int) $line['individual_person_day']);
            $individual->setIndividualBirthMonth((int) $line['individual_person_month']);
            $individual->setIndividualBirthYear((int) $line['individual_person_year']);
            $individual->setIndividualGender($line['individual_person_gender']);
            $individual->setIndividualFather($line['individual_person_father']);
            $individual->setIndividualMother($line['individual_person_mother']);
            $individual->setIndividualBirthPlace($line['individual_person_birth_place']);
            $individual->setIndividualBirthUf($line['individual_person_birth_uf']);
            $individual->setIndividualNationality($line['individual_person_nationality']);
            $individual->setIndividualStatus($line['individual_person_status']);

            $address = new \Person\Entity\Address();
            $address->setAddressName($line['person_address']);
            $address->setAddressNumber($line['person_number']);
            $address->setAddressComplement($line['person_complement']);
            $address->setAddressQuarter($line['person_quarter']);
            $address->setAddressPostalCode($line['person_postal_code']);
            $address->setAddressCity($line['city_name']);
            $address->setAddressState($line['state_name']);
            $address->setAddressCountry($line['country_iso_code']);

            $contact = new \Person\Entity\Contact();
            $contact->setContactEmail($line['person_email']);
            $contact->setContactWebsite($line['legal_person_site']);
            $contact->setContactPhone($line['person_phone']);
            $contact->setContactCell($line['person_cell']);
            $contact->setContactFax($line['person_fax']);

            $em->persist($legal);
            $em->persist($individual);
            $em->persist($address);
            $em->persist($contact);

            $person = new \Person\Entity\Person();
            $person->setPersonId((int) $line['person_id']);
            $person->setPersonName($line['person_name']);
            $person->setPersonType((int) $line['person_type']);
            $person->setPersonIsActive((int) $line['person_is_active']);
            $person->setPersonDate(new \DateTime($line['person_date']));
            $person->setIndividual($individual);
            $person->setLegal($legal);
            $person->setAddress($address);
            $person->setContact($contact);
            $em->persist($person);

            $em->flush($person);
        }

        \Zend\Debug\Debug::dump('Concluído.');
        exit;
    }

    public function migratecustomersAction() {

        $em = $this->getEntityManager();

        $filter = new \Zend\Filter\StringToUpper(array('encoding' => 'UTF-8'));

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT 
                c.*,
                p.person_is_active, p.person_date
                FROM customers c
                JOIN person p ON p.person_id = c.person_id
                ORDER BY c.customer_id ASC
         ');
        $result = $query->fetchAll();

        foreach ($result as $line) {

            $customer = new \Customer\Entity\Customer();
            $customer->setCustomerId($line['customer_id']);
            $customer->setCustomerStatusId($line['customer_status_id']);
            $customer->setCustomerResidenceTime($filter->filter($line['customer_residence_time']));
            $customer->setCustomerResidenceStatus($filter->filter($line['customer_residence_status']));
            $customer->setCustomerRentValue($line['customer_rent_value']);
            $customer->setCustomerNotes($filter->filter($line['customer_notes']));
            $customer->setCustomerActive((int) $line['person_is_active']);
            $customer->setCustomerTimestamp(new \DateTime($line['person_date']));
            $customer->setCompanyId(1);

            $person = $em->find('\Person\Entity\Person', $line['person_id']);

            if ($person instanceof \Person\Entity\Person) {
                $customer->setPerson($person);
                $em->persist($customer);
                $em->flush();
            }
        }

        \Zend\Debug\Debug::dump("Concluído");
        exit;
    }

    public function migrateemployeesAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT 
            f.*,
            u.user_name, u.user_password, u.user_id,
            p.person_date,p.person_is_active
            FROM functionaries f
            JOIN persons p ON p.person_id = f.person_id
            LEFT JOIN users u ON u.person_id = p.person_id
         ');
        $result = $query->fetchAll();

        foreach ($result as $line) {
            $employee = new \Employee\Entity\Employee();
            $employee->setEmployeeId($line['functionary_id']);

            $date = new \DateTime($line['functionary_admission_date']);
            $employee->setEmployeeAdmissionDate($date);
            $employee->setEmployeeWorkTime($line['functionary_work_time']);
            $employee->setEmployeeCtps($line['functionary_ctps']);
            $employee->setEmployeeCtpsSerie($line['functionary_ctps_serie']);
            $employee->setEmployeePis($line['functionary_pis']);
            $employee->setEmployeePicture($line['functionary_picture']);
            $employee->setEmployeeSalary($line['functionary_salary']);
            $employee->setEmployeeBonus($line['functionary_bonus']);
            $employee->setEmployeeCommission($line['functionary_porcent_commission']);
            $employee->setEmployeeTimestamp(new \DateTime($line['person_date']));
            $employee->setEmployeeActive($line['person_is_active']);
            $employee->setCompanyId(1);

            if ($line['user_id']) {
                $bcrypt = new \Zend\Crypt\Password\Bcrypt();
                $bcrypt->setCost(14);
                $password = $bcrypt->create($line['user_password']);
                $user = new \User\Entity\User();
                $user->setId($line['user_id']);
                $user->setUsername($line['user_name']);
                $user->setPassword($password);
                $user->setState(1);
                $em->persist($user);
                $employee->setUser($user);
            }

            $person = $em->find('\Person\Entity\Person', $line['person_id']);

            if ($person instanceof \Person\Entity\Person) {
                $employee->setPerson($person);
            }

            $employee_status = $em->find('\EmployeeStatus\Entity\EmployeeStatus', $line['functionary_status_id']);
            $employee->setEmployeeStatusId($employee_status);

            $office = $em->find('\Office\Entity\Office', $line['office_id']);
            $employee->setOfficeId($office);

            $em->persist($employee);
            $em->flush();
        }

        \Zend\Debug\Debug::dump("Concluído");
        exit;
    }

    public function migratecustomersaddonsAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT 
                ca.*,
                i.individual_id
            FROM customers_addons ca
            INNER JOIN customer c ON c.customer_id = ca.customer_id
            INNER JOIN person p ON p.person_id = c.person_id
            INNER JOIN individual i ON p.individual_id = i.individual_id
            ORDER BY ca.customer_addon_id ASC
            LIMIT 1614, 6000
         ');
        $result = $query->fetchAll();

        foreach ($result as $line) {

            $professionalAddon = new \ProfessionalAddon\Entity\ProfessionalAddon();
            $professionalAddon->setProfessionalAddonId($line['customer_addon_id']);
            $professionalAddon->setProfessionalAddonPreviousCompany($line['customer_addon_previous_enterprise_name']);
            $professionalAddon->setProfessionalAddonPreviousPhone($line['customer_addon_previous_phone']);
            $dateAd = new \DateTime($line['customer_addon_previous_admission_date']);
            $professionalAddon->setProfessionalAddonPreviousAdmission($dateAd);
            $dateDe = new \DateTime($line['customer_addon_previous_demission_date']);
            $professionalAddon->setProfessionalAddonPreviousDemission($dateDe);
            $professionalAddon->setProfessionalAddonPreviousOffice($line['customer_addon_others_office']);
            $professionalAddon->setProfessionalAddonPreviousSalary($line['customer_addon_others_incomes']);

            $em->persist($professionalAddon);

            $individual = $em->find('Person\Entity\Individual', $line['individual_id']);
            $individual->setProfessionalAddon($professionalAddon);

            \Zend\Debug\Debug::dump($query->rowCount());
//            \Zend\Debug\Debug::dump($individual);exit;
            $em->persist($individual);
            $em->flush();
        }

        \Zend\Debug\Debug::dump("Concluído");
        exit;
    }

    public function migratecustomerpatrimoniesAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT pa.*, c.customer_id
            FROM patrimonies pa
            INNER JOIN person p ON p.person_id = pa.person_id
            INNER JOIN customer c ON p.person_id = c.person_id
            ORDER BY pa.patrimony_id ASC
            LIMIT 0,5000
         ');
        $result = $query->fetchAll();

        $filter = new \Zend\Filter\StringToUpper(array('encoding' => 'UTF-8'));

        foreach ($result as $line) {

            $patrimony = new \Patrimony\Entity\Patrimony();
            $patrimony->setPatrimonyId($line['patrimony_id']);
            $patrimony->setPatrimonyName($filter->filter($line['patrimony_realty']));
            $patrimony->setPatrimonyValue($line['patrimony_value']);
            $patrimony->setPatrimonyDebit($line['patrimony_debit']);

            $customer = $em->find('Customer\Entity\Customer', $line['customer_id']);
            $customer->addCustomerPatrimony($patrimony);

            $em->persist($patrimony);

            $em->flush();
        }

        \Zend\Debug\Debug::dump("Concluído");
        exit;
    }

    public function migrateprofessionalsAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT 
                pr.*,
                i.individual_id
            FROM professionals pr
            INNER JOIN person p ON p.person_id = pr.person_id
            INNER JOIN individual i ON i.individual_id = p.individual_id
            LIMIT 0,5000
        ');
        $result = $query->fetchAll();
        foreach ($result as $line) {

            $filter = new \Zend\Filter\Digits();
            $line['professional_enterprise_cep'] = $filter->filter($line['professional_enterprise_cep']);
            if (($line['professional_enterprise_cep'] == '') || (empty($line['professional_enterprise_cep']))) {
                $line['professional_enterprise_cep'] = '0';
            }
            $json = new \Zend\Json\Json();
            $url = "http://api.geonames.org/postalCodeLookupJSON?postalcode={$line['professional_enterprise_cep']}&country=BR&username=technocenter";
            $result = file_get_contents($url);
            $result_object = $json->decode($result);
//            \Zend\Debug\Debug::dump($result_object);exit;
            $address = new \Person\Entity\Address();

            if ((is_object($result_object)) && (count($result_object->postalcodes) > 0)) {
                $result_data = $result_object->postalcodes[0];
                $filter = new \Zend\Filter\StringToUpper();
                $filter->setEncoding('UTF-8');
                $city = $filter($result_data->placeName);
                $state = $filter($result_data->adminName1);
                $country = $filter($result_data->countryCode);
                $address->setAddressCity($city);
                $address->setAddressState($state);
                $address->setAddressCountry($country);
            }

            $address->setAddressName($line['professional_enterprise_address']);
            $address->setAddressNumber($line['professional_enterprise_number']);
            $address->setAddressComplement($line['professional_enterprise_complement']);
            $address->setAddressQuarter($line['professional_enterprise_quarter']);
            $address->setAddressPostalCode($line['professional_enterprise_cep']);
            $em->persist($address);

            $contact = new \Person\Entity\Contact();
            $contact->setContactPhone($line['professional_enterprise_phone']);
            $em->persist($contact);

            $professional = new \Person\Entity\Professional();
            $professional->setProfessionalId($line['professional_id']);
            $professional->setAddress($address);
            $professional->setContact($contact);
            $professional->setProfessionalAdmissionDate($line['professional_admission_date']);
            $professional->setProfessionalEnterpriseName($line['professional_enterprise_name']);
            $professional->setProfessionalEnterpriseCnpj($line['professional_enterprise_cnpj']);
            $professional->setProfessionalEnterpriseFoundationDate($line['professional_enterprise_foundation_date']);
            $professional->setProfessionalEnterpriseParticipation($line['professional_enterprise_participation_porcent']);
            $professional->setProfessionalEnterprisePartnerCount($line['professional_enterprise_partner_count']);
            $professional->setProfessionalEnterpriseBusiness($line['professional_enterprise_business']);
            $professional->setProfessionalOffice($line['professional_office']);
            $professional->setProfessionalSalary($line['professional_salary']);
            $professional->setProfessionalOtherRevenue($line['professional_others_incomes']);
            $professional->setProfessionalBenefitNumber($line['professional_benefit_number']);
            $professional->setProfessionalNotes($line['professional_notes']);
            $em->persist($professional);

            $individual = $em->find('Person\Entity\Individual', $line['individual_id']);
            $individual->setProfessional($professional);

//            \Zend\Debug\Debug::dump($query->rowCount());
//            \Zend\Debug\Debug::dump($professional);exit;

            $em->flush();
        }

        \Zend\Debug\Debug::dump('Concluído.');
        exit;
    }

    public function migratecustomersaccountsAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT 
                ba.*,
                c.customer_id
            FROM bank_accounts ba
            INNER JOIN person p ON p.person_id = ba.person_id
            INNER JOIN customer c ON c.person_id = p.person_id
            ORDER BY ba.bank_account_id ASC
            LIMIT 0, 6000
         ');
        $result = $query->fetchAll();

        foreach ($result as $line) {

            $filter = new \Zend\Filter\StringToUpper();
            $filter->setEncoding('UTF-8');

            $customer = $em->find('Customer\Entity\Customer', $line['customer_id']);

            $account = new \BankAccount\Entity\BankAccount();
            $account->setBankAccountId($line['bank_account_id']);
            $account->setBankAccountType($filter->filter($line['bank_account_type']));
            $account->setBankAccountBank($filter->filter($line['bank_account_bank']));
            $account->setBankAccountAgency($line['bank_account_agency']);
            $account->setBankAccountAccount($line['bank_account_account']);
            $account->setBankAccountSince($line['bank_account_since']);

            $customer->addCustomerBankAccount($account);

            $em->persist($customer);
//            \Zend\Debug\Debug::dump($account);exit;
//            \Zend\Debug\Debug::dump($query->rowCount());  
            $em->flush();
        }

        \Zend\Debug\Debug::dump("Concluído");
        exit;
    }

    public function migratereferencesAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT 
                cr.*,
                c.customer_id
            FROM comercials_references cr
            INNER JOIN person p ON p.person_id = cr.person_id
            INNER JOIN customer c ON c.person_id = p.person_id
            ORDER BY cr.comercial_reference_id ASC
            LIMIT 0, 4000
         ');
        $result = $query->fetchAll();

        foreach ($result as $line) {

            $filter = new \Zend\Filter\StringToUpper();
            $filter->setEncoding('UTF-8');

            $customer = $em->find('Customer\Entity\Customer', $line['customer_id']);

            $reference = new \Reference\Entity\Reference();
            $reference->setReferenceId($line['comercial_reference_id']);
            $reference->setReferenceType($filter->filter($line['comercial_reference_type']));
            $reference->setReferenceName($filter->filter($line['comercial_reference_name']));
            $reference->setReferencePhone($line['comercial_reference_phone']);

            $customer->addCustomerReference($reference);

            $em->persist($customer);
//            \Zend\Debug\Debug::dump($query->rowCount());  
//            \Zend\Debug\Debug::dump($reference);exit;
            $em->flush();
        }

        \Zend\Debug\Debug::dump("Concluído");
        exit;
    }

    public function migrateshopmanAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT 
                s.*
            FROM shopmen s
            INNER JOIN person p ON p.person_id = s.person_id
         ');
        $result = $query->fetchAll();

        foreach ($result as $line) {

            $person = $em->find('Person\Entity\Person', $line['person_id']);

            $shopman = new \Shopman\Entity\Shopman();
            $shopman->setCompanyId(1)
                    ->setPerson($person)
                    ->setShopmanId($line['shopman_id'])
                    ->setShopmanFixedComission($line['shopman_fixed_commission'])
                    ->setShopmanPorcentComission($line['shopman_porcent_commission'])
                    ->setShopmanIsActive($line['shopman_is_active']);


            $em->persist($shopman);
//            \Zend\Debug\Debug::dump($line);exit;
            $em->flush();
        }
        \Zend\Debug\Debug::dump("Concluído");
        exit;
    }

    public function migratesellerAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT 
                s.*
            FROM sellers s
            INNER JOIN person p ON p.person_id = s.person_id
         ');
        $result = $query->fetchAll();

        foreach ($result as $line) {

            $person = $em->find('Person\Entity\Person', $line['person_id']);

            $seller = new \Seller\Entity\Seller();
            $seller->setPerson($person)
                    ->setSellerId($line['seller_id']);
            $em->persist($seller);

            $shopman = $em->find('Shopman\Entity\Shopman', $line['shopman_id']);
            $shopman->addShopmanSeller($seller);

            $em->persist($shopman);
//            \Zend\Debug\Debug::dump($line);exit;
            $em->flush();
        }
        \Zend\Debug\Debug::dump("Concluído");
        exit;
    }

    public function migrateshopmanproductsAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT
                sp.*,
                pl.product_list_name
            FROM shopmen_products sp
            JOIN products_list pl ON pl.product_list_id = sp.product_list_id
            LIMIT 302,400
         ');
        $result = $query->fetchAll();

        foreach ($result as $line) {

            $product = $em->getRepository('Product\Entity\Product')->findOneBy(array(
                'productName' => $line['product_list_name']
            ));

            $shopman = $em->find('Shopman\Entity\Shopman', $line['shopman_id']);
            $shopman->addShopmanProduct($product);

            $em->persist($shopman);

            $em->flush();
        }
//        \Zend\Debug\Debug::dump("Concluído" . $query->rowCount());
        exit;
    }

    public function migratespousesAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT 
                s.*
            FROM spouses s
            LIMIT 0,200
        ');
        $result = $query->fetchAll();
        foreach ($result as $line) {
            $filter = new \Zend\Filter\StringToUpper();
            $filter->setEncoding('UTF-8');

//            \Zend\Debug\Debug::dump($line);exit;

            $professional = new \Person\Entity\Professional();
            $professional->setAddress(new \Person\Entity\Address());
            $professional->setContact(new \Person\Entity\Contact());
            $professional->setProfessionalEnterpriseName($line['spouse_work']);
            $professional->setProfessionalAdmissionDate($line['spouse_admission']);
            $professional->setProfessionalOffice($line['spouse_office']);
            $professional->setProfessionalSalary($line['spouse_salary']);
            $em->persist($professional);

            $legal = new \Person\Entity\Legal();

            $individual = new \Person\Entity\Individual();
            $individual->setIndividualCpf($line['spouse_cpf']);
            $individual->setIndividualRg($line['spouse_rg']);
            $date = new \DateTime($line['spouse_rg_date']);
            $individual->setIndividualRgDate($date);
            $individual->setIndividualRgOrgan($line['spouse_rg_emitter']);
            $individual->setIndividualRgUf($line['spouse_rg_uf']);
            if (!empty($line['spouse_birthday'])) {
                $birthday = new \DateTime($line['spouse_birthday']);
                $individual->setIndividualBirthDay((int) date('d', $birthday->getTimestamp()));
                $individual->setIndividualBirthMonth((int) date('m', $birthday->getTimestamp()));
                $individual->setIndividualBirthYear((int) date('Y', $birthday->getTimestamp()));
            }
            $individual->setIndividualFather($line['spouse_father']);
            $individual->setIndividualMother($line['spouse_mother']);
            $individual->setIndividualBirthPlace($line['spouse_birth_place']);
            $individual->setIndividualNationality($line['spouse_nationality']);
            $individual->setProfessional($professional);

            $address = new \Person\Entity\Address();
            $address->setAddressName($line['spouse_address']);
            $address->setAddressNumber($line['spouse_number']);
            $address->setAddressComplement($line['spouse_complement']);
            $address->setAddressQuarter($line['spouse_quarter']);
            $address->setAddressCity($line['spouse_city']);
            $address->setAddressState($line['spouse_state']);
            $address->setAddressCountry('BR');

            $contact = new \Person\Entity\Contact();
            $contact->setContactEmail($line['spouse_email']);
            $contact->setContactPhone($line['spouse_phone']);
            $contact->setContactCell($line['spouse_cell']);

            $em->persist($legal);
            $em->persist($individual);
            $em->persist($address);
            $em->persist($contact);

            $person = new \Person\Entity\Person();
            $person->setPersonName($line['spouse_name']);
            $person->setPersonType(0);
            $person->setIndividual($individual);
            $person->setLegal($legal);
            $person->setAddress($address);
            $person->setContact($contact);
            $em->persist($person);

            $bankAccount = new \BankAccount\Entity\BankAccount();
            $bankAccount->setBankAccountType($filter->filter($line['spouse_account_type']));
            $bankAccount->setBankAccountAgency($line['spouse_agency']);
            $bankAccount->setBankAccountAccount($line['spouse_account']);
            $em->persist($bankAccount);

            $reference1 = new \Reference\Entity\Reference();
            $reference1->setReferenceType('PESSOAL');
            $reference1->setReferenceName($line['spouse_reference_1']);
            $reference1->setReferencePhone($line['spouse_reference_phone_1']);
            $em->persist($reference1);

            $reference2 = new \Reference\Entity\Reference();
            $reference2->setReferenceType('PESSOAL');
            $reference2->setReferenceName($line['spouse_reference_2']);
            $reference2->setReferencePhone($line['spouse_reference_phone_2']);
            $em->persist($reference2);

            $reference3 = new \Reference\Entity\Reference();
            $reference3->setReferenceType('PESSOAL');
            $reference3->setReferenceName($line['spouse_reference_3']);
            $reference3->setReferencePhone($line['spouse_reference_phone_3']);
            $em->persist($reference3);

            $sponsor = new \Sponsor\Entity\Sponsor();
            $sponsor->setPerson($person);
            $sponsor->setSponsorId($line['spouse_id']);
            $sponsor->setSponsorResidenceType($line['spouse_residence_type']);
            $sponsor->setSponsorResidenceTime($line['spouse_residence_time']);
            $sponsor->setSponsorResidenceRentValue($line['spouse_residence_rent_value']);
            $sponsor->addReference($reference1);
            $sponsor->addReference($reference2);
            $sponsor->addReference($reference3);
            $sponsor->setBankAccount($bankAccount);
            $em->persist($sponsor);

            $personId = $em->find('Person\Entity\Person', $line['person_id']);
            $customer = $em->getRepository('Customer\Entity\Customer')->findOneBy(array(
                'person' => $personId,
            ));
            $customer->setSponsor($sponsor);
            $em->persist($customer);

//            \Zend\Debug\Debug::dump('');exit;
            $em->flush();
        }

        \Zend\Debug\Debug::dump('Concluído.');
        exit;
    }

    public function migrateproposalsAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT 
                la.*,
                p.*,
                pl.product_list_name
            FROM proposals p
            LEFT JOIN loans_addons la ON la.proposal_id = p.proposal_id
            LEFT JOIN shopmen_products sp ON sp.shopman_product_id = p.shopman_product_id
            LEFT JOIN products_list pl ON pl.product_list_id = sp.product_list_id
            LIMIT 0,4000
         ');
        $result = $query->fetchAll();

        foreach ($result as $line) {

            $bank = $em->find('Bank\Entity\Bank', $line['bank_id']);
            $company = $em->find('Company\Entity\Company', 1);
            $customer = $em->find('Customer\Entity\Customer', $line['customer_id']);
            $shopman = $em->find('Shopman\Entity\Shopman', $line['shopman_id']);
            $employee = $em->find('Employee\Entity\Employee', $line['functionary_id']);
            $baseDate = new \DateTime($line['proposal_base_date']);
            $startDate = new \DateTime($line['proposal_first_expiration']);
            $endDate = new \DateTime($line['proposal_last_expiration']);
            $lastChange = new \DateTime($line['proposal_last_change']);
            $timestamp = new \DateTime($line['proposal_date']);


            $proposal = new \Proposal\Entity\Proposal();
            $proposal->setBank($bank)
                    ->setCompany($company)
                    ->setCustomer($customer)
                    ->setEmployee($employee)
                    ->setProposalNumber($line['proposal_number'])
                    ->setProposalValue((double) $line['proposal_funded_value'])
                    ->setProposalParcelAmount($line['proposal_parcels'])
                    ->setProposalParcelValue($line['proposal_parcels_value'])
                    ->setProposalBaseDate($baseDate)
                    ->setProposalStartDate($startDate)
                    ->setProposalEndDate($endDate)
                    ->setProposalTimestamp($timestamp)
                    ->setProposalNotes($line['proposal_notes'])
                    ->setProposalComission($line['proposal_commission'])
                    ->setProposalIsActive($line['proposal_is_valid'])
                    ->setProposalIsApproved($line['proposal_is_approved'])
                    ->setProposalIsIntegrated($line['proposal_is_integrated'])
                    ->setProposalIsRefused($line['proposal_is_refused'])
                    ->setProposalIsCanceled($line['proposal_is_canceled'])
                    ->setProposalIsChecking($line['proposal_is_checking'])
                    ->setProposalIsAborted($line['proposal_is_aborted'])
                    ->setProposalIsPending($line['proposal_is_pending'])
                    ->setProposalLastChange($lastChange);
            $em->persist($proposal);

            $shopmanProduct = $shopman->getShopmanProduct();

            foreach ($shopmanProduct as $product) {
                if ($product->getProductName() == $line['product_list_name']) {
                    $product = $product;
                }
            }

            if ($line['proposal_is_loan'] == 0) {
                $seller = $em->find('Seller\Entity\Seller', $line['seller_id']);
                $vehicleProposal = new \Proposal\Entity\VehicleProposal();
                $vehicleProposal->setProposal($proposal)
                        ->setVehicleProposalId($line['proposal_id'])
                        ->setSeller($seller)
                        ->setShopman($shopman)
                        ->setVehicleProposalInValue($line['proposal_in_value'])
                        ->setVehicleProposalTotalValue($line['proposal_buy_value'])
                        ->setProduct($product);
                $em->persist($vehicleProposal);
            } else {
                $loan = new \Proposal\Entity\Loan();
                $loan->setLoanId($line['proposal_id'])
                        ->setLoanBenefitNumber($line['loan_addon_beneficiary_id'])
                        ->setLoanBenefitUf($line['loan_addon_beneficiary_uf'])
                        ->setLoanCompulsoryDiscount($line['loan_addon_compulsory_discount'])
                        ->setLoanDebts($line['loan_addon_debits'])
                        ->setLoanOtherLoan($line['loan_addon_others_loans'])
                        ->setLoanEmployeeComission($line['loan_addon_functionary_commission'])
                        ->setLoanIncoming($line['loan_addon_income'])
                        ->setLoanMarginReservation($line['loan_addon_reservation'])
                        ->setLoanMarginValue($line['loan_addon_margin_value'])
                        ->setLoanPartnerComission($line['loan_addon_partner_commission'])
                        ->setLoanIsFlex($line['loan_addon_is_flex'])
                        ->setShopman($shopman)
                        ->setProduct($product)
                        ->setProposal($proposal);
                $em->persist($loan);
            }
            $em->flush();
        }
//        \Zend\Debug\Debug::dump("Concluído " . $query->rowCount());
        exit;
    }

    public function migratebankreportsAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT 
                br.*
            FROM banks_reports br
         ');
        $result = $query->fetchAll();

        foreach ($result as $line) {

            $bank = $em->find('Bank\Entity\Bank', $line['bank_id']);

            $bankReport = new \Proposal\Entity\BankReport();
            $bankReport->setBank($bank)
                    ->setBankReportId($line['bank_report_id'])
                    ->setBankReportIsActive($line['bank_report_is_active']);
            $em->persist($bankReport);

            $vehicleProposal = $em->find('Proposal\Entity\VehicleProposal', $line['proposal_id']);

            if (!empty($vehicleProposal)) {
                $proposalId = $vehicleProposal->getProposal()->getProposalId();
            } else {
                $loan = $em->find('Proposal\Entity\Loan', $line['proposal_id']);
                if (!empty($loan)) {
                    $proposalId = $loan->getProposal()->getProposalId();
                }
            }

            if (!empty($proposalId)) {
                $proposal = $em->find('Proposal\Entity\Proposal', $proposalId);
                $proposal->addBankReport($bankReport);
                $em->persist($proposal);

//                \Zend\Debug\Debug::dump($proposalId);exit;
                $em->flush();
            }
        }
        echo "Concluído " . $query->rowCount();
        exit;
    }

    public function migrateproposallogsAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT 
                pl.*
            FROM proposals_logs pl
            LIMIT 11080,12000
         ');
        $result = $query->fetchAll();

        foreach ($result as $line) {

            $filter = new \Zend\Filter\StringToUpper();
            $filter->setEncoding('UTF-8');

            $bank = $em->find('Bank\Entity\Bank', $line['bank_id']);

            $log = new \Proposal\Entity\Log();
            $log->setLogId($line['proposal_log_id']);
            $log->setLogMessage($filter->filter($line['proposal_log_notes']));
            $log->setLogTimestamp(new \DateTime($line['proposal_log_datetime']));
            $log->setBank($bank);
            $em->persist($log);

            $vehicleProposal = $em->find('Proposal\Entity\VehicleProposal', $line['proposal_id']);

            if (!empty($vehicleProposal)) {
                $proposalId = $vehicleProposal->getProposal()->getProposalId();
            } else {
                $loan = $em->find('Proposal\Entity\Loan', $line['proposal_id']);
                if (!empty($loan)) {
                    $proposalId = $loan->getProposal()->getProposalId();
                }
            }

            if (!empty($proposalId)) {
                $proposal = $em->find('Proposal\Entity\Proposal', $proposalId);
                $proposal->addLog($log);
                $em->persist($proposal);
//                \Zend\Debug\Debug::dump($log);exit;
                $em->flush();
            }
        }
        echo "Concluído " . $query->rowCount();
        exit;
    }

    public function migratevehiclesAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT 
                v.*
            FROM vehicles v
         ');
        $result = $query->fetchAll();

        $hydrator = new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($em);

        foreach ($result as $line) {

            $filter = new \Zend\Filter\StringToUpper();
            $filter->setEncoding('UTF-8');

            $data = array();

            $data['vehicleStatus'] = $filter->filter($line['vehicle_status']);
            $data['vehicleYear'] = $filter->filter($line['vehicle_year']);
            $data['vehicleYearModel'] = $filter->filter($line['vehicle_year_model']);
            $data['vehiclePlate'] = $filter->filter($line['vehicle_plate']);
            $data['vehiclePlateUf'] = $filter->filter($line['vehicle_plate_uf']);
            $data['vehicleColor'] = $filter->filter($line['vehicle_color']);
            $data['vehicleFuel'] = $filter->filter($line['vehicle_fuel']);
            $data['vehicleRenavam'] = $filter->filter($line['vehicle_renavam']);
            $data['vehicleFrame'] = $filter->filter($line['vehicle_frame']);
            $data['vehicleFrameType'] = $filter->filter($line['vehicle_frame_type']);
            $data['vehicleLicenceUf'] = $filter->filter($line['vehicle_licence_uf']);
            $data['vehicleOwnerType'] = $filter->filter($line['vehicle_owner_type']);
            $data['vehicleValue'] = $line['vehicle_buy_price'];
            $data['vehicleNotes'] = $filter->filter($line['vehicle_notes']);
            $data['vehicleBrandId'] = $em->find('Vehicle\Entity\VehicleBrand', $line['brand_id']);
            $data['vehicleTypeId'] = $em->find('Vehicle\Entity\VehicleType', $line['vehicle_type_id']);
            $data['vehicleModelId'] = $em->find('Vehicle\Entity\VehicleModel', $line['model_id']);
            $data['vehicleVersionId'] = $em->find('Vehicle\Entity\VehicleVersion', $line['vehicle_version_id']);

            $vehicle = new \Vehicle\Entity\Vehicle();
            $hydrator->hydrate($data, $vehicle);

            $vehicleProposal = $em->find('Proposal\Entity\VehicleProposal', $line['proposal_id']);

            if ($vehicleProposal) {
                $vehicleProposal->addVehicle($vehicle);
            }

            $em->persist($vehicle);
            $em->flush();
        }
        echo "Concluído " . $query->rowCount();
        exit;
    }

    public function migratecustomervehiclesAction() {

        $em = $this->getEntityManager();

        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT 
                cv.*
            FROM customers_vehicles cv
         ');
        $result = $query->fetchAll();

        $hydrator = new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($em);

        foreach ($result as $line) {
//            \Zend\Debug\Debug::dump($line);exit;
            $filter = new \Zend\Filter\StringToUpper();
            $filter->setEncoding('UTF-8');

            $data = array();

            $data['vehicleYear'] = $filter->filter($line['customer_vehicle_year']);
            $data['vehicleYearModel'] = $filter->filter($line['customer_vehicle_year_model']);
            $data['vehiclePlate'] = $filter->filter($line['customer_vehicle_plate']);
            $data['vehicleValue'] = $line['customer_vehicle_value'];
            $data['vehicleBrandId'] = $em->find('Vehicle\Entity\VehicleBrand', $line['brand_id']);
            $data['vehicleTypeId'] = $em->find('Vehicle\Entity\VehicleType', $line['vehicle_type_id']);
            $data['vehicleModelId'] = $em->find('Vehicle\Entity\VehicleModel', $line['model_id']);
            $data['vehicleVersionId'] = $em->find('Vehicle\Entity\VehicleVersion', $line['vehicle_version_id']);

            $vehicle = new \Vehicle\Entity\Vehicle();
            $hydrator->hydrate($data, $vehicle);

            $customer = $em->find('Customer\Entity\Customer', $line['customer_id']);

            if ($customer) {
                $customer->addCustomerVehicle($vehicle);
            }

            $em->persist($customer);
            $em->flush();
        }
        echo "Concluído " . $query->rowCount();
        exit;
    }
    
    public function migratepaymenttypeAction() {
        $em = $this->getEntityManager();
        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT * 
            FROM payment_conditions
            ORDER BY payment_condition_id
         ');
        $result = $query->fetchAll();

        foreach ($result as $line) {
            $paymentType = new \PaymentType\Entity\PaymentType();
            $paymentType->setCompanyId($this->companyAuth()->getCompanyId());
            $paymentType->setPaymentTypeId($line['payment_condition_id']);
            $paymentType->setPaymentTypeName($line['payment_condition_name']);
            $em->persist($paymentType);
            $em->flush();
//            \Zend\Debug\Debug::dump($vehicleProposal->getProduct()->getProductName());
//            \Zend\Debug\Debug::dump($product->getProductName() . $product->getProductId());exit;
        }
        echo "Concluído " . $query->rowCount();exit;
    }
    
    public function migratecurrentaccountAction() {
        $em = $this->getEntityManager();
        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT * 
            FROM current_accounts
            ORDER BY current_account_id
         ');
        $result = $query->fetchAll();

        $hydrator = new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($em);
        
        foreach ($result as $line) {

            $array = array(
                'bankId' => $line['bank_id'],
                'companyId' => $line['enterprise_id'],
                'currentAccountId' => $line['current_account_id'],
                'currentAccountName' => $line['current_account_name'],
                'currentAccountAgency' => $line['current_account_agency'],
                'currentAccountAccount' => $line['current_account_account'],
                'currentAccountManager' => $line['current_account_manager'],
                'currentAccountManagerPhone' => $line['current_account_manager_phone'],
                'currentAccountManagerEmail' => $line['current_account_email'],
                'currentAccountBankHomePage' => $line['current_account_site'],
                'currentAccountDescription' => $line['current_account_notes'],
                'currentAccountIsActive' => $line['current_account_is_active'],
            );
            
            $currentAccount = new \CurrentAccount\Entity\CurrentAccount();
            $hydrator->hydrate($array, $currentAccount);
            $em->persist($currentAccount);
            $em->flush();
//            \Zend\Debug\Debug::dump($vehicleProposal->getProduct()->getProductName());
//            \Zend\Debug\Debug::dump($product->getProductName() . $product->getProductId());exit;
        }
        echo "Concluído " . $query->rowCount();exit;
    }
    
    public function migrateaccountingitemAction() {
        $em = $this->getEntityManager();
        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT * 
            FROM cash_objects
         ');
        $result = $query->fetchAll();

        $hydrator = new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($em);
        
        foreach ($result as $line) {

            $array = array(
                'companyId' => 1,
                'accountingItemName' => $line['cash_object_name'],
                'accountingItemType' => (bool) $line['cash_object_type'],
            );
            
            $accountingItem = new \AccountingItem\Entity\AccountingItem();
            $hydrator->hydrate($array, $accountingItem);
            $em->persist($accountingItem);
            $em->flush();
//            \Zend\Debug\Debug::dump($vehicleProposal->getProduct()->getProductName());
//            \Zend\Debug\Debug::dump($product->getProductName() . $product->getProductId());exit;
        }
        echo "Concluído " . $query->rowCount();exit;
    }
    
    
    public function updateAction() {
        $em = $this->getEntityManager();
        $conn = $em->getConnection();
        $query = $conn->executeQuery('
            SELECT pe.person_name, p.proposal_id, pl.product_list_name, pl.product_list_id FROM proposals p
JOIN shopmen_products s ON s.shopman_product_id = p.shopman_product_id
JOIN products_list pl ON pl.product_list_id = s.product_list_id
JOIN customers c ON c.customer_id = p.customer_id
JOIN persons pe ON pe.person_id = c.person_id
ORDER BY p.proposal_id
         ');
        $result = $query->fetchAll();

        foreach ($result as $line) {
            
            $product = $em->getRepository('Product\Entity\Product')->findOneBy(array(
                'productName' => $line['product_list_name']
            ));
            
            if (!$product) {
                \Zend\Debug\Debug::dump($line['product_list_name']);exit;
            }
            
            $vehicleProposal = $em->find('Proposal\Entity\VehicleProposal', $line['proposal_id']);
            
            if ($vehicleProposal) {
                $vehicleProposal->setProduct($product);
                $em->persist($vehicleProposal);
                $em->flush();
            } else {
                $loan = $em->find('Proposal\Entity\Loan', $line['proposal_id']);
                if ($loan) {
                    $loan->setProduct($product);
                    $em->persist($loan);
                    $em->flush();
                }
            }
            
//            \Zend\Debug\Debug::dump($vehicleProposal->getProduct()->getProductName());
//            \Zend\Debug\Debug::dump($product->getProductName() . $product->getProductId());exit;
        }
        echo "Concluído " . $query->rowCount();exit;
    }

    /**
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

    /**
     * @param Doctrine\ORM\EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getBankEntity() {
        return $this->bankEntity;
    }

    public function setBankEntity($bankEntity) {
        $this->bankEntity = $bankEntity;
    }

    public function getLocationEntity() {
        return $this->locationEntity;
    }

    public function setLocationEntity($locationEntity) {
        $this->locationEntity = $locationEntity;
    }

}
