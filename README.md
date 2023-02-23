# Form-Validator

## Usage
```php

// Create a sample form and get the form data as an array.
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';
$data = compact('name', 'email', 'password', 'confirmPassword');

// Create the form validation class and add the field validation rules.
$validator = new FormValidator();
$validator->addRule('name', 'Name', '^[a-zA-Z ]{2,}$', ':field is invalid.');
$validator->addRule('email', 'Email', '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$', ':field is invalid.');
$validator->addRule('password', 'Password', '^.{8,}$', ':field is too short.');
$validator->addRule('confirmPassword', 'Confirm Password', '^.{8,}$', ':field is too short.');

// Validate the form data.
$isValid = $validator->validate($data);

// View error messages.
if (!$isValid) {
    $nameErrors = $validator->getErrors('name');
    $emailErrors = $validator->getErrors('email');
    $passwordErrors = $validator->getErrors('password');
    $confirmPasswordErrors = $validator->getErrors('confirmPassword');
    
    // process of displaying error messages
}
```

## License
This project is licensed under the **MIT License** - see the **LICENSE.md** file for details.
