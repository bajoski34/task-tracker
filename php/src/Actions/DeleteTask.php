<?php 

declare(strict_types=1);

namespace Abraham\Task\Actions;

use Abraham\Task\Task;
use Abraham\Task\TaskManager;

final class DeleteTask {
    public function __construct(
        protected TaskManager $manager,
        protected int $id) {

    }

    public function __invoke(): Task {
        return $this->manager->remove($this->id);
    }
}

// Usage:

// $delTen = new DeleteTask(10);

// $deletedTask = $delTen();