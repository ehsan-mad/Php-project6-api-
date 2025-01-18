<?php
namespace api\TaskApi;

class Router
{

    private $task;
    public function __construct($task)
    {
        $this->task = $task;
        return;
    }

    public function handleRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path   = isset($_GET['id']) ? intval($_GET['id']) : null;

        switch ($method) {
            case "GET":
                $this->handleGetRequest($path);
                break;
            case "POST":
                $this->handlePostRequest();
                break;
            case "PUT":
                $this->handlePutRequest($path);
                break;
            case "DELETE":
                $this->handleDeleteRequest($path);
                break;
            default:
                http_response_code(405);
                echo json_encode(["error" => "Method not allowed."]);
                break;
        }

    }
    private function handleGetRequest($id)
    {
        if ($id) {
            $task = $this->task->getTask($id);
            if ($task) {
                echo json_encode($task);
            } else {
                http_response_code(404);
                echo json_encode(["error" => "The task cannot be found."]);
            }
        } else {
            $task = $this->task->getAllTask();
            if (empty($task)) {
                http_response_code(404);
                echo json_encode(["error" => "The task wasn't found."]);
            } else {
                echo json_encode($task);
            }
        }
    }

    private function handlePostRequest()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        // Validate Title
        if (! isset($data['title']) || trim($data['title']) === "") {
            http_response_code(400);
            echo json_encode(["error" => "Title is required."]);
            return;
        }

        // Priority Validation
        $validPriorities = ["low", "medium", "high"];
        if (isset($data['priority']) && ! in_array($data['priority'], $validPriorities)) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid priority. Valid priorities are: low, medium, high."]);
            return;
        }
        // Create Task
        $response = $this->task->createTask($data);
        echo json_encode($response);
    }
    public function handlePutRequest($id)
    {
        if (! $id) {
            http_response_code(404);
            echo json_encode(["error" => "Task id is required."]);
            return;
        }
        $data     = json_decode(file_get_contents("php://input"), true);
        $response = $this->task->updateTask($id, $data);
        echo json_encode($response);
    }

    public function handleDeleteRequest($id)
    {
        if (! $id) {
            http_response_code(404);
            echo json_encode(["error" => "Task id is required."]);
        }

        echo json_encode($this->task->deleteTask($id));
    }
}
