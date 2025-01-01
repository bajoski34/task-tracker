<?php 

declare(strict_types=1);

namespace Abraham\Task\Actions;

use Abraham\Task\Task;
use Abraham\Task\TaskManager;

final class ListTask {
    
    public function __construct(
        protected TaskManager $manager,
        protected string $filter = '*' ) {

    }

    public function __invoke(): Task {

        switch

        return $this->manager->remove($this->id);
    }
}

// Usage:

// $delTen = new DeleteTask(10);

// $deletedTask = $delTen();