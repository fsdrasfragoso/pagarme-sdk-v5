<?php
namespace FragosoSoftware\PagarmeSdk\Application\Services;

use FragosoSoftware\PagarmeSdk\Application\DTO\RecipientDTO;
use FragosoSoftware\PagarmeSdk\Domain\Repositories\RecipientRepositoryInterface;

class RecipientService
{
    protected $recipientRepository;

    public function __construct(RecipientRepositoryInterface $recipientRepository)
    {
        $this->recipientRepository = $recipientRepository;
    }

    /**
     * Cria um novo recebedor.
     */
    public function createRecipient(RecipientDTO $recipientData)
    {
        $recipientArray = $this->convertToRepositoryArray($recipientData);
        return $this->recipientRepository->create($recipientArray);
    }

    /**
     * Atualiza as informações de um recebedor existente.
     */
    public function updateRecipient($recipientId, RecipientDTO $recipientData)
    {
        $recipientArray = $this->convertToRepositoryArray($recipientData);
        return $this->recipientRepository->update($recipientId, $recipientArray);
    }

    /**
     * Cria um link de Prova de Vida (KYC) para o recebedor.
     */
    public function createKycLink($recipientId)
    {
        return $this->recipientRepository->createKycLink($recipientId);
    }

    /**
     * Obtém os dados de um recebedor específico.
     */
    public function getRecipient($recipientId)
    {
        return $this->recipientRepository->getRecipient($recipientId);
    }

     /**
     * Lista todos os recebedores com suporte para paginação.
     */
    public function listRecipients($page = 1, $size = 10)
    {
        return $this->recipientRepository->listRecipients($page, $size);
    }

     /**
     * Atualiza o código de um recebedor específico.
     */
    public function updateRecipientCode($recipientId, $code)
    {
        return $this->recipientRepository->updateRecipientCode($recipientId, $code);
    }

    /**
     * Obtém o saldo de um recebedor específico.
     *
     * @param string $recipientId
     * @return mixed
     */
    public function getBalance($recipientId)
    {
        return $this->recipientRepository->getBalance($recipientId);
    }

    /**
     * Obtém o histórico das operações do saldo.
     *
     * @param array $filters
     * @return mixed
     */
    public function getBalanceOperations(array $filters = [])
    {
        return $this->recipientRepository->getBalanceOperations($filters);
    }

    /**
     * Obtém uma operação específica de saldo.
     *
     * @param string $operationId
     * @return mixed
     */
    public function getBalanceOperation($operationId)
    {
        return $this->recipientRepository->getBalanceOperation($operationId);
    }



    /**
     * Converte o RecipientDTO em um array formatado para o repositório.
     */
    private function convertToRepositoryArray(RecipientDTO $recipientData)
    {
        return [
            'code' => $recipientData->code,
            'register_information' => [
                'main_address' => [
                    'street' => $recipientData->registerInformation->mainAddress->street,
                    'complementary' => $recipientData->registerInformation->mainAddress->complementary,
                    'street_number' => $recipientData->registerInformation->mainAddress->streetNumber,
                    'neighborhood' => $recipientData->registerInformation->mainAddress->neighborhood,
                    'city' => $recipientData->registerInformation->mainAddress->city,
                    'state' => $recipientData->registerInformation->mainAddress->state,
                    'zip_code' => $recipientData->registerInformation->mainAddress->zipCode,
                    'reference_point' => $recipientData->registerInformation->mainAddress->referencePoint,
                ],
                'email' => $recipientData->registerInformation->email,
                'document' => $recipientData->registerInformation->document,
                'type' => $recipientData->registerInformation->type,
                'company_name' => $recipientData->registerInformation->companyName,
                'trading_name' => $recipientData->registerInformation->tradingName,
                'annual_revenue' => $recipientData->registerInformation->annualRevenue,
                'corporation_type' => $recipientData->registerInformation->corporationType,
                'founding_date' => $recipientData->registerInformation->foundingDate,
                'managing_partners' => array_map(function($partner) {
                    return [
                        'self_declared_legal_representative' => $partner->selfDeclaredRepresentative,
                        'address' => [
                            'street' => $partner->address->street,
                            'complementary' => $partner->address->complementary,
                            'street_number' => $partner->address->streetNumber,
                            'neighborhood' => $partner->address->neighborhood,
                            'city' => $partner->address->city,
                            'state' => $partner->address->state,
                            'zip_code' => $partner->address->zipCode,
                            'reference_point' => $partner->address->referencePoint,
                        ],
                        'name' => $partner->name,
                        'email' => $partner->email,
                        'document' => $partner->document,
                        'type' => $partner->type,
                        'mother_name' => $partner->motherName,
                        'birthdate' => $partner->birthdate,
                        'monthly_income' => $partner->monthlyIncome,
                        'professional_occupation' => $partner->professionalOccupation,
                        'phone_numbers' => array_map(function($phone) {
                            return [
                                'ddd' => $phone->ddd,
                                'number' => $phone->number,
                                'type' => $phone->type,
                            ];
                        }, $partner->phoneNumbers),
                    ];
                }, $recipientData->registerInformation->managingPartners),
                'phone_numbers' => array_map(function($phone) {
                    return [
                        'ddd' => $phone->ddd,
                        'number' => $phone->number,
                        'type' => $phone->type,
                    ];
                }, $recipientData->registerInformation->phoneNumbers),
            ],
            'default_bank_account' => [
                'holder_name' => $recipientData->defaultBankAccount->holderName,
                'holder_type' => $recipientData->defaultBankAccount->holderType,
                'holder_document' => $recipientData->defaultBankAccount->holderDocument,
                'bank' => $recipientData->defaultBankAccount->bank,
                'branch_number' => $recipientData->defaultBankAccount->branchNumber,
                'account_number' => $recipientData->defaultBankAccount->accountNumber,
                'account_check_digit' => $recipientData->defaultBankAccount->accountCheckDigit,
                'type' => $recipientData->defaultBankAccount->type,
            ]
        ];
    }
}
