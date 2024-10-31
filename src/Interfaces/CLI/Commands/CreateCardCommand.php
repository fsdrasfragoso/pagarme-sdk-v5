<?php

namespace App\Interfaces\CLI\Commands;

use App\Application\Services\CardService;
use App\Application\DTO\CardDTO;
use App\Application\DTO\AddressDTO;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCardCommand extends Command
{
    protected static $defaultName = 'card:create';

    private $cardService;

    public function __construct(CardService $cardService)
    {
        parent::__construct();
        $this->cardService = $cardService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Cria um novo cartão para um cliente na API Pagar.me')
            ->addArgument('customerId', InputArgument::REQUIRED, 'ID do cliente')
            ->addArgument('line1', InputArgument::REQUIRED, 'Endereço linha 1')
            ->addArgument('line2', InputArgument::OPTIONAL, 'Endereço linha 2')
            ->addArgument('zipCode', InputArgument::REQUIRED, 'CEP do endereço')
            ->addArgument('city', InputArgument::REQUIRED, 'Cidade do endereço')
            ->addArgument('state', InputArgument::REQUIRED, 'Estado do endereço')
            ->addArgument('country', InputArgument::REQUIRED, 'País do endereço')
            ->addArgument('number', InputArgument::REQUIRED, 'Número do cartão')
            ->addArgument('holderName', InputArgument::REQUIRED, 'Nome do titular do cartão')
            ->addArgument('holderDocument', InputArgument::REQUIRED, 'Documento do titular')
            ->addArgument('expMonth', InputArgument::REQUIRED, 'Mês de expiração')
            ->addArgument('expYear', InputArgument::REQUIRED, 'Ano de expiração')
            ->addArgument('cvv', InputArgument::REQUIRED, 'Código de segurança (CVV)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $address = new AddressDTO(
            $input->getArgument('country'),
            $input->getArgument('state'),
            $input->getArgument('city'),
            $input->getArgument('zipCode'),
            $input->getArgument('line1'),
            $input->getArgument('line2')
        );

        $cardDTO = new CardDTO(
            $address,
            $input->getArgument('number'),
            $input->getArgument('holderName'),
            $input->getArgument('holderDocument'),
            $input->getArgument('expMonth'),
            $input->getArgument('expYear'),
            $input->getArgument('cvv')
        );

        try {
            $customerId = $input->getArgument('customerId');
            $response = $this->cardService->createCard($customerId, $cardDTO);
            $output->writeln("<info>Cartão criado com sucesso! ID: {$response['id']}</info>");
        } catch (\Exception $e) {
            $output->writeln("<error>Erro ao criar cartão: {$e->getMessage()}</error>");
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
