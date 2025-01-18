<?php
namespace api\TaskApi;

class Task
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;

    }

    public function getAllTask()
    {
        $query  = "select * from tasks";
        $data   = $this->conn->query($query);
        $result = $data->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getTask($id)
    {
        $id     = intval($id);
        $query  = "select * from tasks where id=$id";
        $result = $this->conn->query($query);
        $data   = $result->fetch_assoc();
        return $data;
    }

    public function createTask($data)
    {
        $title        = $data['title'];
        $description  = $data['description'] ?? "";
        $priority     = $data['priority'] ?? "low";
        $is_completed = $data['is_completed'] ?? 0;
        $query        = "insert into tasks(title , description , priority, is_completed)  values('$title','$description','$priority','$is_completed')";
        $result       = $this->conn->query($query);
        if($result){
            http_response_code(201);
            return ["message" => "Task created successfully."];
        }

        return ["error" => "Failed to create a task."];

    }

    public function updateTask($id, $data)
    {
        $id    = intval($id);
        $query = "select * from tasks where id=$id";
        $res   = $this->conn->query($query);
        if ($res->num_rows === 0) {
            http_response_code(404);
            return ["error" => " Task Not found"];
        }

        $existingTask = $res->fetch_assoc();
        $title        = isset($data['title']) ? $data['title'] : $existingTask['title'];
        $description  = isset($data['description']) ? $data['description'] : $existingTask['description'];
        $priority = isset($data['priority']) ? $data['priority'] : $existingTask['priority'];
        $is_completed = isset($data['is_completed']) ? $data['is_completed'] : $existingTask['is_completed'];
        $que          = "update tasks set title='$title',description='$description',priority='$priority',is_completed='$is_completed' where id=$id";
        if ($this->conn->query($que)) {
            return json_encode(["message" => "Task Updated Successfully."]);
        }
        return json_encode(["error" => "Failed to update task."]);
    }

    public function DeleteTask($id)
    {
        $id    = intval($id);
        $query = "delete from tasks where id=$id";
        if ($this->conn->query($query)) {
            return json_encode(["Message" => "Task Deleted"]);
        }
        return json_encode(["error" => "Failed to delete task"]);
    }
}
