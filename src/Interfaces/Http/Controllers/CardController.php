
<?php

namespace FragosoSoftware\PagarmeSdk\Interfaces\Http\Controllers;

use FragosoSoftware\PagarmeSdk\Application\Services\CardService;
use FragosoSoftware\PagarmeSdk\Application\DTO\CardDTO;
use FragosoSoftware\PagarmeSdk\Application\DTO\AddressDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CardController
{
    protected $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    public function create(Request $request, $customerId)
    {
        $data = $request->request->all();
        extract($data, EXTR_OVERWRITE);

        $address = new AddressDTO(
            $country ?? '',
            $state ?? '',
            $city ?? '',
            $zip_code ?? '',
            $line_1 ?? '',
            $line_2 ?? ''
        );

        $cardDTO = new CardDTO(
            $address,
            $number ?? '',
            $holder_name ?? '',
            $holder_document ?? '',
            $exp_month ?? '',
            $exp_year ?? '',
            $cvv ?? ''
        );

        $response = $this->cardService->createCard($customerId, $cardDTO);

        return new JsonResponse($response, 201);
    }


    public function getById($customerId, $cardId)
    {
        $response = $this->cardService->getCard($customerId, $cardId);

        return new JsonResponse($response);
    }

    public function list($customerId)
    {
        $response = $this->cardService->listCards($customerId);

        return new JsonResponse($response);
    }

    public function update(Request $request, $customerId, $cardId)
    {
        $data = $request->request->all();
        extract($data, EXTR_OVERWRITE);

        $address = new AddressDTO(
            $country ?? '',
            $state ?? '',
            $city ?? '',
            $zip_code ?? '',
            $line_1 ?? '',
            $line_2 ?? ''
        );

        $cardDTO = new CardDTO(
            $address,
            $number ?? '',
            $holder_name ?? '',
            $holder_document ?? '',
            $exp_month ?? '',
            $exp_year ?? '',
            $cvv ?? ''
        );

        $response = $this->cardService->updateCard($customerId, $cardId, $cardDTO);

        return new JsonResponse($response);
    }


    public function delete($customerId, $cardId)
    {
        $this->cardService->deleteCard($customerId, $cardId);

        return new JsonResponse(['message' => 'Cartão excluído com sucesso.'], 204);
    }

    public function renew($customerId, $cardId)
    {
        $response = $this->cardService->renewCard($customerId, $cardId);

        return new JsonResponse($response);
    }
}
