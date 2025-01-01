<?php 

declare(strict_types=1);

namespace Abraham\Task\Actions;

use Abraham\Task\Task;
use Abraham\Task\TaskManager;

final class AddTask {
    public function __construct(
        protected TaskManager $manager,
        protected string $name,
        protected bool $status = false // in_progress by default.
        ) {

    }

    public function __invoke() {
        $task = new Task($this->name, $this->status);
        $this->manager->add($task);
    }
}