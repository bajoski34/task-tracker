<?php 

declare(strict_types=1);

namespace Abraham\Task\Models;

final class Task {

    private static array $updateable = [
        'name',
        'status'
    ];

    public function __construct(private string $name, private bool $status = false) {}

    public function getName() {
        return $this->name;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function updateStatus() {
        $this->status = !($this->status);
    }
}