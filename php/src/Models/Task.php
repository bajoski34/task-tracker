<?php 

declare(strict_types=1);

namespace Abraham\Task\Models;

final class Task {

    private static array $updateable = [
        'name',
        'status'
    ];

    public function __construct(private string $name, private Status $status = Status::PENDING) {}

    public function getName() {
        return $this->name;
    }

    public function getStatus() {
        return $this->status;
    }

    public static function canUpdate(string $fieldName) {
        return in_array($fieldName, self::$updateable);
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function updateStatus(Status $status) {
        $this->status = $status;
    }
}