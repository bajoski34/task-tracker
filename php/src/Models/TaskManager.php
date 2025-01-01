<?php 

declare(strict_types=1);

namespace Abraham\Task\Models;

final class TaskManager {

    const DEFAULT_FILENAME = 'storage_2025';

    const STORAGE_FOLDER = 'resource';

    private int $length = 0;

    private string $filename;
    
    private static ?TaskManager $instance = null;

    private array $register = [];

    private function __construct(private ?string $jsonFileName = null) {
        $this->filename = $jsonFileName ?? self::STORAGE_FOLDER . DIRECTORY_SEPARATOR . self::DEFAULT_FILENAME; 

        if(!file_exists($this->filename)) {
            //Create file.
            file_put_contents($this->filename, []);
        }
        //read file and update the register if not empty.
        $data = file_get_contents($this->filename);

        if(!empty($data)) {
            $this->register = unserialize(file_get_contents($this->filename));
            $this->length = count($this->register);
        }
    }

    public static function getInstance() {
        if(is_null(static::$instance)) {
            return new self();
        }

        return static::$instance;
    }

    public function save() {

        if(count($this->register) == 0) {
            unlink($this->filename);
        } else {
            file_put_contents($this->filename, serialize($this->register)); 
        }     
    }

    public function printRegister() {
        var_dump($this->register);
    }

    private function get(int $id): Task {  
        if($id >= $this->length || $id < 0) {
            throw new \Exception('Task Not Found');
        }

        return $this->register[$id];
    }

    public function add(Task $task) {
        $this->register[] = $task;
        $this->length++;
        return $this;
    }

    public function update(int $id, string $field, string $value) {
        $task = $this->get($id);

        if($field === 'name') {
            $task->setName($value);
        }

        if($field === 'status') {
            $task->updateStatus();
        }

        $this->register[$id] = $task;
        return $this;
    }

    public function remove(int $id) {
        $task = $this->get($id);
        unset($this->register[$id]);
        $this->register = [...$this->register];
        $this->length--;
        $this->save();
        return $task;
    }
}
