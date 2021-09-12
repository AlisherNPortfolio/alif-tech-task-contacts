<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Models\User;
use App\Repositories\Base\BaseRepository;
use App\Repositories\BaseContracts\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function all(): Collection
    {
        return $this->model->get();
    }

    public function withPagination()
    {
        $request = request()->all();
        return $this->model->with(['contacts'])->paginate(10, '*', 'page', $request['page']);
    }

    public function saveContacts(User $user, array $contactsArray)
    {
        $contactsBag = [];
        foreach ($contactsArray as $contactItem) {
            $contactItem['type'] = $contactItem['type'] === 'phone' ?
                ContactRepository::TYPE_PHONE :
                ContactRepository::TYPE_EMAIL;

            array_push($contactsBag, new Contact($contactItem));
        }

        $user->contacts()->saveMany($contactsBag);
    }
}
