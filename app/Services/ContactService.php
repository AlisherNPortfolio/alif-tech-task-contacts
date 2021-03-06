<?php

namespace App\Services;

use App\Repositories\ContactRepository;

class ContactService extends BaseService
{
    protected $contactService;

    public function __construct(ContactRepository $contactService)
    {
        $this->contactService = $contactService;
    }
}
