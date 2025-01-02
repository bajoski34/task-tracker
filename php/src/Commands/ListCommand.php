<?php 

declare(strict_types=1);

namespace Abraham\Task\Commands;
use Abraham\Task\Contracts\CommandInterface;

class ListCommand extends BaseCommand implements CommandInterface {

    public static ?string $next = null; 
    
    public function __construct(public string $filter = "*") {}

    public static function fromArray(array $inputArray = []): ListCommand
    {
        $filter = $inputArray ?: "*";
        return new self(
            $filter
        );
    } 
}