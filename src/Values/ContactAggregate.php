<?php
/**
 * Created by PhpStorm.
 * User: terrycullen
 * Date: 30/06/2016
 * Time: 11:03 PM
 */

namespace Terah\Saasu\Values;


class ContactAggregate extends RestableValue
{
    /**
     * Contact's Id in Saasu system.
     * @var int
     */
    public $Id                        = null;

    /**
     * Identifier used for concurrency checking. Required for update.
     * @var string
     */
    public $LastUpdatedId             = null;

    /**
     * The salutation or title of the contact. Valid values: Mr., Mrs., Ms., Dr., Prof.
     * @var string
     */
    public $Salutation                = null;

    /**
     * The first or given name of the contact.
     * @var string
     */
    public $GivenName                 = null;

    /**
     * The middle initials of the contact.
     * @var null
     */
    public $MiddleInitials            = null;

    /**
     * The last name or surname of the contact.
     * @var string
     */
    public $FamilyName                = null;

    /**
     * Indicates whether the contact is active.
     * @var Company
     */
    public $Company                  = null;

    /**
     * Contact's position or role.
     * @var string
     */
    public $PositionTitle             = null;

    /**
     * Primary contact number for the contact.
     * @var string
     */
    public $PrimaryPhone              = null;

    /**
     * The contact's mobile phone number.
     * @var string
     */
    public $MobilePhone               = null;

    /**
     * Home contact number for the contact.
     * @var string
     */
    public $HomePhone                 = null;

    /**
     * The contacts fax number.
     * @var string
     */
    public $Fax                       = null;

    /**
     * The contact's email address.
     * @var string
     */
    public $EmailAddress              = null;

    /**
     * Is used as an Account or Contact reference for this person if they are a supplier or customer.
     * This is your reference or their reference depending on how you prefer to use this field.
     * @var string
     */
    public $ContactId                 = null;

    /**
     * This is another Contact record in Saasu and is used to represent the
     * Account Manager, Salesperson or similar for this Contact record.
     * @var ContactManager
     */
    public $ContactManager              = null;

    /**
     * Indicates if the contact is a partner.
     * @var bool
     */
    public $IsPartner                 = false;

    /**
     * Indicates if the contact is a customer.
     * @var bool
     */
    public $IsCustomer                = false;

    /**
     * Indicates if the contact is a supplier.
     * @var bool
     */
    public $IsSupplier                = false;

    /**
     * Indicates if the contact is a contractor. This is important if you need to use the taxable payment reporting feature.
     * @var bool
     */
    public $IsContractor              = false;

    /**
     * The postal or mailing address for the contact.
     * @var Address
     */
    public $PostalAddress             = null;

    /**
     * Hypermedia links.
     * Contains contextual links to possible next actions related to this resource.
     * Only present in responses. This data is not to be sent to the server.
     * Collection ofLink
     * @var array
     */
    public $_links                    = [];

    /**
     * @param \stdClass $data
     * @return $this
     */
    public function set(\stdClass $data)
    {
        if ( isset($data->InsertedContactId) )
        {
            $this->setId($data->InsertedContactId);
            unset($data->InsertedContactId);
        }
        if ( isset($data->Company) )
        {
            $this->Company  = new Company($data->Company);
            unset($data->Company);
        }
        if ( isset($data->ContactManager) )
        {
            $this->ContactManager = new ContactManager($data->ContactManager);
            unset($data->ContactManager);
        }
        if ( isset($data->PostalAddress ) )
        {
            $this->PostalAddress  = new Address($data->PostalAddress);
            unset($data->PostalAddress);
        }
        return parent::set($data);
    }
}
