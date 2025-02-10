<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = ["status" => "error", "message" => "Invalid data."];

    // Sanitize input data
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $zip = filter_input(INPUT_POST, "zip", FILTER_SANITIZE_STRING);

    // Validation
    if (empty($name) || !preg_match("/^[A-Za-z ]{3,}$/", $name)) {
        $response["message"] = "Invalid name.";
    } elseif (empty($phone) || !preg_match("/^\d{10}$/", $phone)) {
        $response["message"] = "Invalid phone number.";
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["message"] = "Invalid email.";
    } elseif (empty($zip) || !preg_match("/^\d{5,6}$/", $zip)) {
        $response["message"] = "Invalid zip code.";
    } else {
        $response = ["status" => "success", "message" => "Form submitted successfully!"];
    }

    // Return JSON response
    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
}
?>
