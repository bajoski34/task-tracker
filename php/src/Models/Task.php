<?php 

declare(strict_types=1);

namespace Abraham\Task\Models;

final class Task {

    private static array $updateable = [
        'name',
        'status'
    ];

    private ?DateTime $created_at = null;
    private ?DateTime $updated_at = null;

    public function __construct(
        private string $name, 
        private Status $status = Status::PENDING,
        private string $description = "",
        ) {
            $date = date("YYYY-mm-d");
            $this->update_at = $date;
            $this->update_at = $date;
        }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
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