<?php
declare(strict_types=1);



require_once __DIR__ . '/../src/validate.php';

// TODO: implement the form handling here.
$name =''; $email= '';
$message='';
$errors=[]; if($_SERVER['REQUEST_METHOD'] ==='POST') 
    {$name=is_string($_POST['name']?? null) ?$_POST['name']: '';
    $email= is_string($_POST['email'] ??null) ? $_POST['email'] : '';
  $message =is_string($_POST['message']?? null)? $_POST['message']:'';

    if(!validate_required($name)){$errors['name']= 'Name is required';
    } elseif (!validate_length(trim($name),2,60))
    {$errors['name']='Name must be between 2 and 60 characters.';}
    if (!validate_email(trim($email))) {$errors['email']='Invalid email address';}
     if (!validate_required($message)){$errors['message'] ='Message is required.';} elseif (!validate_length(trim($message), 10, 1000)) {
        $errors['message']= 'Message must be between 10 and 1000 characters';}
 if (empty($errors)) 
        {header('Location: success.php', true, 303);
        exit;}}?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Contact Us</title>
</head>
<body>
  <h1>Contact Us</h1>
  <form method="post" action="index.php" novalidate>
    <label>
      Name<input type="text" name="name" value="<?=htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
    </label>
    <span> <?= htmlspecialchars($errors['name'] ??'', ENT_QUOTES| ENT_SUBSTITUTE,'UTF-8')?></span>
      <br>
    <label>Email <input type="email" name="email" value="<?= htmlspecialchars($email, ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8') ?>">
    </label>
    <span>
      <?= htmlspecialchars($errors['email']??'',ENT_QUOTES |ENT_SUBSTITUTE, 'UTF-8') ?>
    </span>
    <br>
    <label>Message
      <textarea name="message"><?= htmlspecialchars($message,ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8')?></textarea> 
    </label>
    <span><?= htmlspecialchars($errors['message']??'',ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8')?></span>
    <br>
    <button type="submit">Send</button>
  </form>
</body>
</html>
