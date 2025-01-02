<?php 

declare(strict_types=1);
namespace Abraham\Task\Models;

enum Status: int {
    case PENDING = 0;
    case DONE = 1;
}