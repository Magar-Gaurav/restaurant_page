<?php
require_once 'connect.php';
session_start();
$errors=[];

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signUp'])){
    $email=filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
    $name =$_POST['name'];
    $password=$_POST['password'];
    $confirm_password =$_POST['confirm_password'];
}
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors['email']='Invalid email format';
}
if(empty($name)){
    $errors['name']='Name is required';
}
if(strlen($password)<8){
    $errors['password']='password must be 8 characters long';
}
if($password !== $confirm_password){
    $errors['confirm_password']='Password doesnot match';
}
$stmt =$pdo->prepare('SELECT * FROM signup WHERE email =:email');
$stmt->execute(['email'=>$email]);
if($stmt->fetch()){
    $errors['user_exist']='Email is already registered';
}
if(!empty($errors)){
    $_SESSION['errors']=$errors;
    header('Location:signup.php');
    exit();
}

$hashedPassword=password_hash($password,PASSWORD_BCRYPT);
$stmt=$pdo->prepare('INSERT INTO signup (email,password,name) VALUES(:email,:password,:name)');
$stmt->execute([
    'email'=>$email,
    'password'=>$hashedPassword,
    'name'=>$name
]);
header('Location: login.php');
exit();


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signin'])){
    $email=filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
    $password =$_POST['password'];

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors['email'] ='Invalid email format';
    }
    if(empty($password)){
        $errors['password'] ='password section cannot be empty';
    }
    if(!empty($errors)){
        $_SESSION['errors']=$errors;
        header('location: payment.php');
        exit();
    }
    $stmt=$pdo->prepare("SELECT * FROM signindata WHERE email =:email");
    $stmt->execute(['email'=>$email]);
    $user =$stmt->fetch();

    if($user && password_verify($password,$user['password'])){
        $_SESSION['user']=[
            'id'=>$user['id'],
            'email'=>$user['email'],
            'name'=>$user['name']
        ];
        header('Location: payment.php');
        exit();
    }
    else{
        $errors['login']='Invalid username or password';
        $_SESSION['errors']=$errors;
        header('Location: signup.php');
        exit();
    }
}