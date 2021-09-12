<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Models\User;
use App\Repositories\Base\BaseRepository;
use App\Repositories\BaseContracts\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    private User $user;

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

    public function saveContacts(User $user, array $userData)
    {
        $this->user = $user;
        $this->deleteRemovedContacts($userData);

        $this->user->contacts()->updateOrCreate(
            $this->normalizeContactsArray($userData),
            ['user_id', 'type', 'contact']
        );
    }

    private function normalizeContactsArray($userData)
    {
        $contactsBag = [];

        foreach ($userData['contacts'] as $contactItem) {
            $contactItem['user_id'] = $this->user->id;

            array_push($contactsBag, $contactItem);
        }

        return $contactsBag;
    }

    private function getContactType($contactType)
    {
        return $contactType === 'phone' ?
            ContactRepository::TYPE_PHONE :
            ContactRepository::TYPE_EMAIL;
    }

    private function deleteRemovedContacts($userData)
    {
        if (isset($userData['id'])) {
            $contacts = collect($userData['contacts']);

            $this->user->contacts()
                ->whereNotIn('id', $contacts->pluck('id'))
                ->delete();
        }
    }
}
