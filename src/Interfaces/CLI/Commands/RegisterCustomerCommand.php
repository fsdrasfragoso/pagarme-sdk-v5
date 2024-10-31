<?php

namespace App\Interfaces\CLI\Commands;

use App\Application\Services\CustomerService;
use App\Application\DTO\CustomerDTO;
use App\Application\DTO\AddressDTO;
use App\Application\DTO\PhoneDTO;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RegisterCustomerCommand extends Command
{
    protected static $defaultName = 'customer:register';

    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        parent::__construct();
        $this->customerService = $customerService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Registra um novo cliente na API Pagar.me')
            ->addArgument('name', InputArgument::REQUIRED, 'Nome do cliente')
            ->addArgument('email', InputArgument::REQUIRED, 'E-mail do cliente')
            ->addArgument('document', InputArgument::REQUIRED, 'Documento do cliente (CPF ou CNPJ)')
            ->addArgument('documentType', InputArgument::REQUIRED, 'Tipo de documento (CPF ou CNPJ)')
            ->addArgument('type', InputArgument::REQUIRED, 'Tipo de cliente (individual ou company)')
            ->addArgument('gender', InputArgument::OPTIONAL, 'Sexo do cliente')
            ->addArgument('country', InputArgument::REQUIRED, 'País do endereço')
            ->addArgument('state', InputArgument::REQUIRED, 'Estado do endereço')
            ->addArgument('city', InputArgument::REQUIRED, 'Cidade do endereço')
            ->addArgument('zipCode', InputArgument::REQUIRED, 'CEP do endereço')
            ->addArgument('line1', InputArgument::REQUIRED, 'Endereço linha 1')
            ->addArgument('line2', InputArgument::OPTIONAL, 'Endereço linha 2')
            ->addArgument('phoneCountryCode', InputArgument::REQUIRED, 'Código do país do telefone')
            ->addArgument('phoneAreaCode', InputArgument::REQUIRED, 'Código da área do telefone')
            ->addArgument('phoneNumber', InputArgument::REQUIRED, 'Número do telefone');
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

        $phone = new PhoneDTO(
            $input->getArgument('phoneCountryCode'),
            $input->getArgument('phoneAreaCode'),
            $input->getArgument('phoneNumber')
        );

        $customerDTO = new CustomerDTO(
            $input->getArgument('name'),
            $input->getArgument('email'),
            null, // Código, se necessário
            $input->getArgument('document'),
            $input->getArgument('documentType'),
            $input->getArgument('type'),
            $input->getArgument('gender'),
            $address,
            $phone
        );

        try {
            $response = $this->customerService->createCustomer($customerDTO);
            $output->writeln("<info>Cliente registrado com sucesso! ID: {$response['id']}</info>");
        } catch (\Exception $e) {
            $output->writeln("<error>Erro ao registrar cliente: {$e->getMessage()}</error>");
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
