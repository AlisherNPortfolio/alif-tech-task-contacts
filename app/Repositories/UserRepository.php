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

    public function createUser(array $data)
    {
        $data = collect($data);

        $user = $this->create(
            $data->only(['first_name', 'last_name', 'unique_name'])
                ->toArray()
        );

        $this->createContacts(
            $data->only('contacts')
                ->toArray(),
            $user
        );
    }

    private function createContacts(array $contactContainer, User $user)
    {
        $contactBag = [];
        foreach ($contactContainer['contacts'] as $contact) {
            array_push($contactBag, new Contact($contact));
        }

        $user->contacts()->saveMany($contactBag);
    }

    public function updateUser(array $data, $id)
    {
        $data = collect($data);

        $user = $this->getUserById($id);

        $user->fill(
            $data->only(['first_name', 'last_name', 'unique_name'])
                ->toArray()
        )->save();

        $this->updateContacts($data->only('contacts'), $user);
    }

    public function updateContacts(Collection $contactContainer, User $user)
    {
        $contacts = collect($contactContainer['contacts']);

        $this->deleteRemovedContacts($contacts, $user);

        foreach ($contacts as $contact) {
            if (isset($contact['id'])) {
                $user->contacts()
                    ->whereId($contact['id'])
                    ->update(
                        collect($contact)
                            ->except('id')
                            ->toArray()
                    );
            } else {
                $user->contacts()->save(new Contact($contact));
            }
        }
    }

    private function getUserById($id)
    {
        $user = $this->find($id);
        if (!$user) {
            abort(404, 'User not found!');
        }

        return $user;
    }

    private function deleteRemovedContacts(Collection $contacts, $user)
    {
        $contactIds = $contacts->pluck('id');
        $contactIds = $contactIds->filter(function ($value) {
            return !is_null($value);
        });

        if (count($contactIds) > 0) {
            $user->contacts()
                ->whereNotIn('id', $contactIds)
                ->delete();
        } else {
            $user->contacts()->delete();
        }
    }
}
