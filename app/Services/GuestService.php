<?php

namespace App\Services;
use App\Http\Requests\GuestsStoreRequest;
use App\Http\Requests\GuestsUpdateRequest;
use App\Interfaces\GuestRepositoryInterface;
use Propaganistas\LaravelPhone\PhoneNumber;

class GuestService
{

    private GuestRepositoryInterface $guestRepositoryInterface;

    public function __construct(GuestRepositoryInterface $guestRepositoryInterface)
    {
        $this->guestRepositoryInterface = $guestRepositoryInterface;
    }

    /**
     * @return object
     */
    public function index() : object
    {
        return $this->guestRepositoryInterface->index();
    }

    /**
     * тут конечно лучше использовать прослойку, типа DTO
     * @param GuestsStoreRequest $request
     * @return void
     */
    public function store(GuestsStoreRequest $request): void
    {
        $country = $request['country'];
        if (!$country) {
            $country = $this->getCountry($request['phone']);
        }
        $this->guestRepositoryInterface->store($this->prepareFields($request, $country));
    }

    /**
     * @param int $id
     * @return object
     */
    public function getGuestById(int $id): object
    {
        return $this->guestRepositoryInterface->getById($id);
    }

    /**
     * @param GuestsUpdateRequest $request
     * @return void
     */
    public function update(GuestsUpdateRequest $request): void
    {
        $country = $request['country'];
        if (!$country) {
            $country = $this->getCountry($request['phone']);
        }

        $this->guestRepositoryInterface->update($request['id'], $this->prepareFields($request, $country));
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->guestRepositoryInterface->destroy($id);
    }

    /**
     * @param object $fields
     * @param string $country
     * @return array
     */
    private function prepareFields(object $fields, string $country) : array
    {
        return [
            'name' => $fields['name'],
            'surname' => $fields['surname'],
            'phone' => $fields['phone'],
            'email' => $fields['email'],
            'country' => $country,
        ];
    }

    /**
     * @param $phone
     * @return string
     */
    private function getCountry($phone): string
    {
        $phone = new PhoneNumber($phone);
        return $phone->getCountry();
    }
}
