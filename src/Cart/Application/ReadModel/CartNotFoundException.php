<?php
declare(strict_types=1);

namespace App\Cart\Application\ReadModel;

use App\Common\Application\NotFoundException;
use RuntimeException;

final class CartNotFoundException extends RuntimeException implements NotFoundException
{

}
