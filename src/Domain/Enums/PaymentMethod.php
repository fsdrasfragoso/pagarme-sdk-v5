<?php

namespace App\Domain\Enums;

enum PaymentMethod: string
{
    case CREDIT_CARD = 'credit_card';
    case BOLETO = 'boleto';
    case PIX = 'pix';    
}