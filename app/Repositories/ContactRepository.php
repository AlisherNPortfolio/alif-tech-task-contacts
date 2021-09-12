<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\Base\BaseRepository;
use App\Repositories\BaseContracts\ContactRepositoryInterface;
use Illuminate\Support\Collection;

class ContactRepository extends BaseRepository implements ContactRepositoryInterface
{
    public const TYPE_PHONE = "1";
    public const TYPE_EMAIL = "2";

    public function __construct(Contact $contact)
    {
        parent::__construct($contact);
    }

    public function all(): Collection
    {
        return $this->model->get();
    }

    public function phones(): Collection
    {
        return $this->model->where('type', self::TYPE_PHONE)->get();
    }

    public function emails(): Collection
    {
        return $this->model->where('type', self::TYPE_EMAIL)->get();
    }
}
