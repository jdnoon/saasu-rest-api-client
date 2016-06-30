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
    public $LastUpdatedId             = '';

    /**
     * The salutation or title of the contact. Valid values: Mr., Mrs., Ms., Dr., Prof.
     * @var string
     */
    public $Salutation                = '';

    /**
     * The first or given name of the contact.
     * @var string
     */
    public $GivenName                 = '';

    /**
     * The middle initials of the contact.
     * @var null
     */
    public $MiddleInitials            = null;

    /**
     * The last name or surname of the contact.
     * @var string
     */
    public $FamilyName                = '';

    /**
     * Indicates whether the contact is active.
     * @var Company
     */
    public $Company                  = null;

    /**
     * Contact's position or role.
     * @var string
     */
    public $PositionTitle             = '';

    /**
     * Url of a website owned by the contact.
     * @var string
     */
    public $WebsiteUrl                = '';

    /**
     * Primary contact number for the contact.
     * @var string
     */
    public $PrimaryPhone              = '';

    /**
     * The contact's mobile phone number.
     * @var string
     */
    public $MobilePhone               = '';

    /**
     * Home contact number for the contact.
     * @var string
     */
    public $HomePhone                 = '';

    /**
     * The contacts fax number.
     * @var string
     */
    public $Fax                       = '';

    /**
     * The contact's email address.
     * @var string
     */
    public $EmailAddress              = '';

    /**
     * Is used as an Account or Contact reference for this person if they are a supplier or customer.
     * This is your reference or their reference depending on how you prefer to use this field.
     * @var string
     */
    public $ContactId                 = '';

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
        parent::set($data);
        if ( isset($data->Company) )
        {
            $this->Company  = new Company($data->Company);
        }
        if ( isset($data->ContactManager) )
        {
            $this->ContactManager = new ContactManager($data->ContactManager);
        }
        if ( isset($data->PostalAddress ) )
        {
            $this->PostalAddress  = new Address($data->PostalAddress);
        }
        return $this;
    }
}
