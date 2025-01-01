<?php 

declare(strict_types=1);

namespace Abraham\Task\Actions;

use Abraham\Task\Task;
use Abraham\Task\TaskManager;

final class UpdateTask {

    public function __construct(
        protected TaskManager $manager,
        protected int $id,
        public array $arguments) {

    }

    public function __invoke() {

        //update field only if the field is updateable.
        foreach (Task::$updateable as $field) {
            if(isset($this->arguments[$field])) {
                $this->manager->update($this->id, $field, $this->arguments[$field]);
            }
        }
    }
}

// Usage:

// $delTen = new UpdateTask(10, );

// $delTen();